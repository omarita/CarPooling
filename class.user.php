<?php

require_once 'dbconfig.php';

class USER
{
	public $userID;
	public $userName;
	public $userEmail;
	public $userPass;
	public $phoneNo;
	public $paypalAccount;
	public $userStatus;
	public $tokenCode;
	public $accountLocked = "N";

	private $conn;
	public $database;

	public function __construct()
	{

		$this->database = Database::getInstance();
		$this->conn = $this->database->conn;
  }

	private function fillData($row)
	{
		$this->userID = $row[0]['userID'];
		$this->userName = $row[0]['userName'];
		$this->userEmail = $row[0]['userEmail'];
		$this->userPass = $row[0]['userPass'];
		$this->phoneNo = $row[0]['phoneNo'];
		$this->paypalAccount = $row[0]['paypalAccount'];
		$this->userStatus = $row[0]['userStatus'];
		$this->tokenCode = $row[0]['tokenCode'];
		$this->accountLocked = $row[0]['accountLocked'];
	}

	public function update()
	{
		$stmt = $this->database->prepare("UPDATE users SET
				userPass=:userPass,
				phoneNo=:phoneNo,
				paypalAccount=:paypalAccount,
				userStatus=:userStatus,
				tokenCode=:tokenCode,
				accountLocked=:accountLocked
				WHERE userID=:uID");
		$stmt->bindparam(":userPass",$this->userPass);
		$stmt->bindparam(":phoneNo",$this->phoneNo);
		$stmt->bindparam(":paypalAccount",$this->paypalAccount);
		$stmt->bindparam(":userStatus",$this->userStatus);
		$stmt->bindparam(":tokenCode",$this->tokenCode);
		$stmt->bindparam(":accountLocked",$this->accountLocked);
		$stmt->bindparam(":uID",$this->userID);
		$stmt->execute();
	}

	public function getUserById($userId)
	{
		$rowCount = $this->database->fetch("SELECT * FROM users WHERE userID=:uid", array(":uid"=>$userId), $rows);
		if ($rowCount > 0)
			$this->fillData($rows);
		return $rowCount;
	}

	public function getUserByEmail($email)
	{
		$rowCount = $this->database->fetch("SELECT * FROM users WHERE userEmail=:email_id",array(":email_id"=>$email), $rows);
		if ($rowCount > 0)
				$this->fillData($rows);
		return $rowCount;
	}

	public function register($uname,$email,$upass,$code)
	{
		try
		{
			$password = md5($upass);
			$stmt = $this->database->conn->prepare("INSERT INTO users(userName,userEmail,userPass,tokenCode)
			                                             VALUES(:user_name, :user_mail, :user_pass, :active_code)");
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->execute();
			//
			$this->userID=$this->database->lastID();
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function login($email,$upass)
	{
		try
		{
			$count=$this->getUserByEmail($email);
			if($count == 1)
			{
				if($this->userStatus=="Y")
				{
					if($this->userPass==md5($upass))
					{
						$_SESSION['userSession'] = $this->userID;
						return true;
					}
					else
					{
						header("Location: index.php?error");
						exit;
					}
				}
				else
				{
					header("Location: index.php?inactive");
					exit;
				}
			}
			else
			{
				header("Location: index.php?error");
				exit;
			}
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}


	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}

	function send_mail($email,$message,$subject)
	{
		include("config.php");
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug  = 1;
		$mail->SMTPAuth   = true;
		//$mail->SMTPSecure = "";
		$mail->Host       = $config['mailhost'];
		$mail->Port       = $config['mailport'];
		$mail->AddAddress($config['mailaddress']);
		$mail->Username   = $config['mailuser'];
		$mail->Password   = $config['mailpass'];
		$mail->SetFrom($config['mailaddress'],$config['mailfrom']);
		$mail->AddReplyTo($config['mailaddress'],$config['mailfrom']);
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}
}

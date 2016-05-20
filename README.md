# CarPooling
Il sito permette agli utenti di registrarsi ed offrire un passaggio specificando partenza, destinazione, giorno, ora, costo. Altri utenti
possono aderire pagando il corrispettivo tramite paypal.
Per configurare il progetto:

- config.php: inserire l'indirizzo del sito web (per il ritorno dopo il pagamento paypal e per i link email);
- dbconfig.php: contiene i dati di autenticazione del db
- class.user.php: contiene i dati di autenticazione smtp per le email.
- createdb.sql contiene lo script per creare utente, db e tabelle (mysql).

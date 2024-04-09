<?php
    class Database {
        private static $host = "localhost";
        private static $username = "root";
        private static $password = "";
        private static $database = "Convention";
        private static $connection;
    
        // Metodo per la connessione al database
        public static function connect() {
            self::$connection = new mysqli(self::$host, self::$username, self::$password, self::$database);
            if (self::$connection->connect_error) {
                die("Connessione fallita: " . self::$connection->connect_error);
                return false;
            }
            #Connessione al database riuscita
            return true;
        }
    
        // Metodo per eseguire query
        public static function executeQuery($query) {
            $result = self::$connection->query($query);
            if (!$result) {
                echo "Errore nella query: " . self::$connection->error;
            }
            return $result;
        }
        // Metodo per disconnettersi dal database
        public static function disconnect() {
            self::$connection->close();
        }
    }
?>
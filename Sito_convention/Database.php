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
            }
            #Connessione al database riuscita
            return true;
        }
    
        // Metodo per eseguire query
        public static function executeQueryNormal($query) {
            $result = self::$connection->query($query);
            if (!$result) {
                echo "Errore nella query: " . self::$connection->error;
            }
            return $result;
        }
        public static function executeQuery($query,$parametri,$flag) {
            //questo flag è settato a true se la query è una select a false se è una insert, questo perchè
            //il metodo get_result() ritorna true solo se è una select questo implica
            //che quando voglio fare una insert devo in qualche modo controllare che sia andata a buon fine
            //con solo l'execute
            //flag per sapere se la request è una select o una insert || se select=true se insert=false ||
            $stmt = self::$connection->prepare($query);
		    $stmt->bind_param(...$parametri);
            $result2=$stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if (!$result2) {
                echo "Errore nella query: " . self::$connection->error;
            }
            if ($flag){
                return $result;
            }else{
                return $result2;
            }
        }
        // Metodo per disconnettersi dal database
        public static function disconnect() {
            self::$connection->close();
        }
    }
?>
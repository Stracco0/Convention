<?php
include "./Database.php";
include "./utilitis.php";
session_start();
Controllo_Cookie(false);
Controllo_Utente_admin();
if(Controllo_Utente() && $_SESSION["mail_user"]=="admin@admin.com"){
    RefreshTempo();
}
if(isset($_POST['entity'])) {
    $entity=$_POST["entity"];
    switch($entity) {
        case 'user':
                if (Database::connect()){
                    #controllo se l'email data è già presente nel db
                    $queryTab= "SELECT Mail FROM User WHERE Mail = ?";
                    $parametri=["s",$_POST['email_user']];
                    if(Database::executeQuery($queryTab,$parametri,true)){
                        $risultato=Database::executeQuery($queryTab,$parametri,true);
                        if ($risultato->num_rows == 0){
                                $queryTab= "INSERT INTO User (Mail, Password_user) VALUES (?, ?)";
                                $password = hash("sha256", $_POST["psw_user"]);
                                $parametri=["ss",$_POST['email_user'],$password,];
                                if(Database::executeQuery($queryTab,$parametri,false)){
                                    Database::disconnect();
                                    $par = 'RegisterSuccesfull';
                                    Header("Location: adduser.php?message=Succesfull");
                                }
                                else{
                                    echo "Registrazione fallita 2/2";
                                    Database::disconnect();
                                    #rimanda indietro
                                }      
                        }else{
                            #email già esistente
                            Database::disconnect();
                            Header("Location: adduser.php?message=AlreadyExists");
                        }
                    }
                    else{
                        echo "Registrazione fallita 0/2";
                        Database::disconnect();
                    }
                }              
            break;
        case 'relatore':
                echo $_POST["nomeRel"]." ".$_POST["cognomeRel"]." ".$_POST["idUser"]." azienda  ".$_POST["idAzienda"];
                $queryTab= "INSERT INTO Relatore (NomeRel, CognomeRel, RSAzienda_fk) VALUES (?, ?, ?)";
                $parametri=["sss",$_POST['nomeRel'],$_POST["cognomeRel"],$_POST["idAzienda"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    $queryTab= "SELECT LAST_INSERT_ID() AS IDRel";
                    $risultato=Database::executeQueryNormal($queryTab);
                    $rowRis=$risultato->fetch_assoc();
                    $idRel = $rowRis["IDRel"];
                    $queryTab= "UPDATE User SET IDRel_fk = ? WHERE id_user = ?";
                    $parametri=["ii",$idRel,$_POST["idUser"]];
                    if(Database::executeQuery($queryTab,$parametri,false)){
                        Database::disconnect();
                        Header("Location: admin.php?confirmer=addedRel");
                    }
                }
                else{
                    echo "Registrazione fallita 0/2";
                    Database::disconnect();
                }
                              
            break;
        case 'azienda':
            echo $_POST["Nome"]." ".$_POST["Indirizzo"]." ".$_POST["telefonoAzienda"]."  ".$_POST["RSA"];
            $queryTab= "INSERT INTO Azienda (Nome, IndirizzoAzienda, TelefonoAzienda ,RagioneSocialeAzienda) VALUES (?,?,?,?)";
                $parametri=["ssss",$_POST['Nome'],$_POST["Indirizzo"],$_POST["telefonoAzienda"],$_POST["RSA"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    Database::disconnect();
                    Header("Location: admin.php?confirmer=addedAzienda");
                }
                else{
                    echo "Registrazione fallita 0/2";
                    Database::disconnect();
                }
            break;
        case 'partecipante':
                echo $_POST["nome"]." ".$_POST["cognome"]." ".$_POST["tipo"]." azienda  ".$_POST["idUser"];
                $queryTab= "INSERT INTO Partecipante (NomePart, CognomePart, TipologiaPart) VALUES (?, ?, ?)";
                $parametri=["sss",$_POST["nome"],$_POST["cognome"],$_POST["tipo"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    $queryTab= "SELECT LAST_INSERT_ID() AS IDPart";
                    $risultato=Database::executeQueryNormal($queryTab);
                    $rowRis=$risultato->fetch_assoc();
                    $idPart = $rowRis["IDPart"];
                    $queryTab= "UPDATE User SET IDPart_fk = ? WHERE id_user = ?";
                    $parametri=["ii",$idPart,$_POST["idUser"]];
                    if(Database::executeQuery($queryTab,$parametri,false)){
                        Database::disconnect();
                        Header("Location: admin.php?confirmer=addedPart");
                    }
                }
                else{
                    echo "Registrazione fallita 0/2";
                    Database::disconnect();
                }
            break;
        case 'speech':
            echo $_POST["Titolo"]." ".$_POST["Argomento"];
                $queryTab= "INSERT INTO Speech (Titolo, Argomento) VALUES (?, ?)";
                $parametri=["ss",$_POST["Titolo"],$_POST["Argomento"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    Database::disconnect();
                    Header("Location: admin.php?confirmer=addedSpeech");
                }
                else{
                    echo "Registrazione fallita 0/2";
                    Database::disconnect();
                }
            break;
        case 'programma':
            echo $_POST["orar"]." ".$_POST["idSpeech"]." ".$_POST["idSala"];
            $sql_fasce_orarie = "SELECT FasciaOraria FROM Programma WHERE NomeSala_fk = ?";
            $parametri=["s",$_POST["idSala"]];
            if(Database::executeQuery($sql_fasce_orarie,$parametri,true)){
                $result=Database::executeQuery($sql_fasce_orarie,$parametri,true);
                $overlap = false;
                while ($row = $result->fetch_assoc()) {
                    $existingTime = $row['FasciaOraria'];
                    $newTime = strtotime($_POST["orar"]);
                    $existingTime = strtotime($existingTime);
                    // Verifica se le fasce orarie si sovrappongono
                    if (abs($newTime - $existingTime) < 1800) { // 1800 secondi = 30 minuti
                        $overlap = true;
                        break;
                    }
                }
                if (!$overlap) {
                    // Nessuna sovrapposizione, procedi con l'inserimento
                    $queryTab = "INSERT INTO Programma (FasciaOraria, IDSpeech_fk, NomeSala_fk) VALUES (?,?,?)";
                    $parametri=["sis",$_POST["orar"],$_POST["idSpeech"],$_POST["idSala"]];
                    if(Database::executeQuery($queryTab,$parametri,false)){
                        Database::disconnect();
                        Header("Location: admin.php?confirmer=addedProgramma");
                    }
                    else{
                        echo "Registrazione fallita 0/2";
                        Database::disconnect();
                    }
                }else{
                    Header("Location: admin.php?confirmer=erroraddprogramma");
                }
            }
            break;
        default:
            echo 'Entità non valida.';
    }
} else {
    echo 'Parametro "entity" mancante.';
}
?>
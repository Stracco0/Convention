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
                    $queryTab= "UPDATE User SET Mail = ?, Password_user = ? WHERE Id_user = ?";
                    $password = hash("sha256", $_POST["psw_user"]);
                    $parametri=["ssi",$_POST['email_user'],$password,$_POST["idUser"]];
                    if(Database::executeQuery($queryTab,$parametri,false)){
                        Database::disconnect();
                        Header("Location: adduser.php?message=ModifySuccesfull&returnto=modify&idUser=".$_POST["idUser"]);
                    }
                    else{
                        echo "Registrazione fallita 2/2";
                        Database::disconnect();
                        #rimanda indietro
                    }
                }
                else{
                    echo "Registrazione fallita 0/2";
                    Database::disconnect();
                }              
            break;
        case 'relatore':
            echo $_POST["nomeRel"]." ".$_POST["cognomeRel"]." ".$_POST["idRel"]." azienda  ".$_POST["idAzienda"];
            if (Database::connect()){
                $queryTab= "UPDATE Relatore SET Relatore.NomeRel = ?, Relatore.CognomeRel = ?, Relatore.RSAzienda_fk = ? WHERE Relatore.IDRel = ?";
                $parametri=["sssi",$_POST["nomeRel"],$_POST["cognomeRel"],$_POST["idAzienda"],$_POST["idRel"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    Database::disconnect();
                    Header("Location: admin.php?confirmer=modifiedRel");
                }
                else{
                    echo "Registrazione fallita 2/2";
                    Database::disconnect();
                    #rimanda indietro
                }
            }
            else{
                echo "Registrazione fallita 0/2";
                Database::disconnect();
            }
            break;
        case 'azienda':
            echo $_POST["Nome"]." ".$_POST["Indirizzo"]." ".$_POST["telefonoAzienda"]." azienda  ".$_POST["RSA"];
            if (Database::connect()){
                $queryTab= "UPDATE Azienda SET Nome = ?, IndirizzoAzienda = ?, TelefonoAzienda = ? WHERE RagioneSocialeAzienda = ?";
                $parametri=["ssss",$_POST["Nome"],$_POST["IndirizzoAzienda"],$_POST["TelefonoAzienda"],$_POST["RSA"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    Database::disconnect();
                    Header("Location: admin.php?confirmer=modifiedAzienda");
                }
                else{
                    echo "Registrazione fallita 2/2";
                    Database::disconnect();
                    #rimanda indietro
                }
            }
            else{
                echo "Registrazione fallita 0/2";
                Database::disconnect();
            }
            break;
        case 'partecipante':
            echo $_POST["nome"]." ".$_POST["cognome"]." ".$_POST["tipo"]." azienda  ".$_POST["idPart"];
            if (Database::connect()){
                $queryTab= "UPDATE Partecipante SET NomePart = ?, CognomePart = ?, TipologiaPart = ? WHERE IDPart = ?";
                $parametri=["sssi",$_POST["nome"],$_POST["cognome"],$_POST["tipo"],$_POST["idPart"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    Database::disconnect();
                    Header("Location: admin.php?confirmer=modifiedPart");
                }
                else{
                    echo "Registrazione fallita 2/2";
                    Database::disconnect();
                    #rimanda indietro
                }
            }
            else{
                echo "Registrazione fallita 0/2";
                Database::disconnect();
            }
            break;
        case 'speech':
            echo $_POST["Titolo"]." ".$_POST["Argomento"]." ",$_POST["idSpeech"];
            $queryTab= "UPDATE Speech SET Titolo = ?, Argomento = ? WHERE idSpeech = ?";
                $parametri=["ssi",$_POST["Titolo"],$_POST["Argomento"],$_POST["idSpeech"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    Database::disconnect();
                    Header("Location: admin.php?confirmer=modifiedSpeech");
                }
                else{
                    echo "Registrazione fallita 2/2";
                    Database::disconnect();
                    #rimanda indietro
                }
            break;
        case 'programma':
            echo $_POST["entitySala"]." ".$_POST["entitySpeech"]." ".$_POST["idProgramma"]." ".$_POST["orar"];
            $sql_fasce_orarie = "SELECT FasciaOraria FROM Programma WHERE NomeSala_fk = ?";
            $parametri=["s",$_POST["entitySala"]];
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
                    // Nessuna sovrapposizione, procedi con la modifica
                    $queryTab = "UPDATE Programma SET FasciaOraria = ?, IDSpeech_fk = ?, NomeSala_fk = ? WHERE IDProgramma = ?";
                    $parametri=["sisi",$_POST["orar"],$_POST["entitySpeech"],$_POST["entitySala"],$_POST["idProgramma"]];
                    if(Database::executeQuery($queryTab,$parametri,false)){
                        Database::disconnect();
                        Header("Location: admin.php?confirmer=modifyProgramma");
                    }
                    else{
                        echo "Registrazione fallita 0/2";
                        Database::disconnect();
                    }
                }else{
                    Header("Location: admin.php?confirmer=errormodprogramma");
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
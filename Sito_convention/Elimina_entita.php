<?php
include "./Database.php";
include "./utilitis.php";
session_start();
Controllo_Utente_admin();
Controllo_Cookie(false);
if(Controllo_Utente() && $_SESSION["mail_user"]=="admin@admin.com"){
    RefreshTempo();
}
if(isset($_POST['whoelim'])) {
    $entity=$_POST["whoelim"];
    switch($entity) {
        case 'user':
            if (Database::connect()){
                $queryTab= "DELETE FROM User WHERE Id_user = ?";
                $parametri=["i",$_POST["entity"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    Database::disconnect();
                    Header("Location: choose.php?message=ElimSuccesfull&who=user&action=delete");
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
        case 'rel':
            if (Database::connect()){
                $queryTab= "DELETE FROM Relatore WHERE IDRel = ?";
                $parametri=["i",$_POST["entity"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    Database::disconnect();
                    Header("Location: admin.php?confirmer=delRel");
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
            if (Database::connect()){
                $queryTab= "DELETE FROM Azienda WHERE RagioneSocialeAzienda = ?";
                $parametri=["s",$_POST["entity"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    Database::disconnect();
                    Header("Location: admin.php?confirmer=delAzienda");
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
        case 'part':
            if (Database::connect()){
                $queryTab= "DELETE FROM Partecipante WHERE IDPart = ?";
                $parametri=["i",$_POST["entity"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    Database::disconnect();
                    Header("Location: admin.php?confirmer=delPart");
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
        case 'programma':
            $queryTab= "DELETE FROM Programma WHERE IDProgramma = ?";
                $parametri=["i",$_POST["entity"]];
                if(Database::executeQuery($queryTab,$parametri,false)){
                    Database::disconnect();
                    Header("Location: admin.php?confirmer=delProgramma");
                }
                else{
                    echo "Registrazione fallita 2/2";
                    Database::disconnect();
                    #rimanda indietro
                }
            break;
        default:
            echo 'Entità non valida.';
    }
} else {
    echo 'Parametro "entity" mancante.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convention</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
        include 'Database.php';
        if ($_POST["ArrivoDa"]=="Registrazione"){
            # Gestisco registrazione
            if (Database::connect()){
                #controllo se l'email data è già presente nel db
                $queryTab= "SELECT Mail FROM User WHERE Mail = '{$_POST['email']}'";
                if(Database::executeQuery($queryTab)){
                    $risultato=Database::executeQuery($queryTab);
                    if ($risultato->num_rows == 0){
                        $queryTab= "INSERT INTO Partecipante (NomePart, CognomePart, TipologiaPart) VALUES ('{$_POST['Nome']}','{$_POST['Cognome']}','{$_POST['Tipo']}')";
                        if(Database::executeQuery($queryTab)){
                            # Inserimento nella tabella partecipanti effettuato correttemente
                            $queryTab="SELECT MAX(IDPart) FROM Partecipante WHERE NomePart = '{$_POST['Nome']}' AND CognomePart = '{$_POST['Cognome']}' AND TipologiaPart = '{$_POST['Tipo']}'";
                            $risultato=Database::executeQuery($queryTab);
                            $rowRis=$risultato->fetch_assoc();
                            $idPart = $rowRis["MAX(IDPart)"]; # Ottengo l'id del partecipante appena inserito per aggiungerlo come chiave esterna alla tabella user
                            $queryTab= "INSERT INTO User (Mail, Password_user, IDPart_fk) VALUES ('{$_POST['email']}', '{$_POST['psw']}', $idPart)";
                            if(Database::executeQuery($queryTab)){
                                Database::disconnect();
                                $par = 'RegisterSuccesfull';
                                Header("Location: login.php?user=".$par);
                            }
                            else{
                                echo "Registrazione fallita 2/2";
                                Database::disconnect();
                                #rimanda indietro
                            }      
                        }
                        else{
                            echo "Registrazione fallita 1/2";
                            Database::disconnect();
                        }
                    }else{
                        #email già esistente
                        Database::disconnect();
                        $par = 'AlreadyExists';
                        Header("Location: login.php?user=".$par);
                    }
                }
                else{
                    echo "Registrazione fallita 0/2";
                        Database::disconnect();
                }              
            }
        }
        elseif ($_POST["ArrivoDa"]=="Login") {
            # Gestisco login
            if (Database::connect()){
                $queryTab= "SELECT id_user,Password_user,Mail,IDPart_fk,IDRel_fk FROM User WHERE Mail = '{$_POST['email_user']}'";
                if(Database::executeQuery($queryTab)){
                    $risultatoUser = Database::executeQuery($queryTab);
                    if (!($risultatoUser->num_rows == 0)){
                        #controllo se la password è la stessa
                        $rowRisUser=$risultatoUser->fetch_assoc();
                        if ($_POST['psw_user'] == $rowRisUser["Password_user"]){
                            Database::disconnect();
                            $time = time()+1200;
			                $timeMemo = (string)$time;
                            setcookie("Tempo_Sessione",$timeMemo,$time); //mezz'ora di tempo
                            session_start();
                            $_SESSION["mail_user"]=$rowRisUser["Mail"];
                            $_SESSION["idUser"]=$rowRisUser["id_user"];
                            #accesso effettuato
                            #session e cookie per salvare le credenziali per tot tempo,
                            #reindirizza verso home.php con session e cookie
                            if ($rowRisUser["IDRel_fk"]!=null){
                                $_SESSION["RelAnche"]=true;
                            }
                            header("Location: home.php");
                        }
                        else{
                            #password non corretta
                            Database::disconnect();
                            $par = 'PswErr';
                            Header("Location: login.php?user=".$par);
                            exit;
                        }
                    }
                    else{
                        echo "non esiste";
                        Database::disconnect();
                        $par = 'NotFound';
                        Header("Location: login.php?user=".$par);
                    }
                    if(Database::executeQuery($queryTab)){
                        #Registrazione correttamente effetuata
                        Database::disconnect();
                    }
                    else{
                        echo "Login fallito 2/2";
                    }      
                }
                else{
                    echo "Login fallito 1/2";
                }                
            }
        }
        else{
            echo "Non provieni da nessun form!";
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

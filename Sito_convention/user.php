<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Utente</title>
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>
    <?php
        include "./Database.php";
        include "./utilitis.php";
        $returnto1="./admin.php";
        $returnto2="./admin.php";
        $where="Admin";
        include_once("./navbar.php");
        Controllo_Cookie(false);
        if(Controllo_Utente() && $_SESSION["mail_user"]=="admin@admin.com"){
            RefreshTempo();
        }
    ?>
    <div class="container-fluid p-3">
        <a href="admin.php"><button class='btn btn-primary mb-2'><i class='fas fa-arrow-left'></i></button></a>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-primary text-white">
                        <h3 class="mb-0">Aggiungi Utente</h3>
                    </div>
                    <div class="card-body">
                        <form action="Aggiungi_entita.php" method="post">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="Nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="cognome" class="form-label">Cognome</label>
                                <input type="text" class="form-control" id="cognome" name="Cognome" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email_user" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="psw_user" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipologia" class="form-label">Tipologia</label>
                                <input type="text" class="form-control" id="tipologia" name="Tipologia" required>
                            </div>
                            <input type="hidden" name="entity" value="user">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Aggiungi Utente</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <a href="./admin.php">Torna indietro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

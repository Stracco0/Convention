<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Speech</title>
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
                    <div class="card-header text-center ">
                        <h3 class="mb-0">Aggiungi Speech</h3>
                    </div>
                    <div class="card-body">
                        <form action="Aggiungi_entita.php" method="post">
                            <div class="mb-3">
                                <label for="Titolo" class="form-label">Titolo</label>
                                <input type="text" class="form-control" id="Titolo" name="Titolo" required>
                            </div>
                            <div class="mb-3">
                                <label for="Argomento" class="form-label">Argomento</label>
                                <textarea maxlength="200" class="form-control" id="Argomento" name="Argomento" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="entity" value="speech">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Aggiungi Speech</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

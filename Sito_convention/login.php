<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="mb-0">Benvenuto</h3>
                        <p class="mb-0">Effettua l'accesso al tuo account</p>
                    </div>
                    <div class="card-body">
                        <?php
                            if($_REQUEST["user"]=="NotFound"){
                                echo "<div class='alert alert-danger' role='alert'>Utente non trovato!</div>";
                            }
                            if($_REQUEST["user"]=="PswErr"){
                                echo "<div class='alert alert-danger' role='alert'>Password Errata!</div>";
                            }
                            if($_REQUEST["user"]=="AlreadyExists"){
                                echo "<div class='alert alert-danger' role='alert'>Email già registrata, Accedi!</div>";
                            }
                            if($_REQUEST["user"]=="RegisterSuccesfull"){
                                echo "<div class='alert alert-success' role='alert'>Registrazione effettuata, Accedi!</div>";
                            }
                        ?>
                        <form action="check.php" method="post">
                            <input type="hidden" name="ArrivoDa" value="Login" />
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email_user" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="psw_user" required>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">Accedi</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        Non hai un account? <a href="register.php">Iscriviti</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

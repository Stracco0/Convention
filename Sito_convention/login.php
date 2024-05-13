<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <?php
    include_once("dependences.php");
    ?>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
            <a class="navbar-brand" href="index.php">Convention</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="true">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navb" class="navbar-collapse collapse hide">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                </ul>
            </div>
    </nav>
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
                            <div class="row">
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary btn-block">Accedi</button>
                                </div>
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

</body>
</html>

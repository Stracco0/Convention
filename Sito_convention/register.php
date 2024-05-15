<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" href="./css/register.css">
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
                    <a class="nav-link" href="login.php">Register</a>
                </li>
                </ul>
            </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="mb-0">Registrati</h3>
                        <p class="mb-0">Crea il tuo account</p>
                    </div>
                    <div class="card-body">
                        <form action="check.php" method="post">
                            <input type="hidden" name="ArrivoDa" value="Registrazione" />
                            <div class="mb-3">
                                <label for="nome" class="form-label"><b>Nome</b></label>
                                <input type="text" class="form-control" placeholder="Inserisci il tuo Nome" name="Nome" id="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="cognome" class="form-label"><b>Cognome</b></label>
                                <input type="text" class="form-control" placeholder="Inserisci il tuo Cognome" name="Cognome" id="cognome" required>
                            </div>
                            <div class="mb-3">
                                <label for="Tipo" class="form-label"><b>Tipologia</b></label>
                                <input type="text" class="form-control" placeholder="Inserisci Tipologia" name="Tipo" id="Tipo" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label"><b>Email</b></label>
                                <input type="email" class="form-control" placeholder="Inserisci l'email" name="email" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="psw" class="form-label"><b>Password</b></label>
                                <input type="password" class="form-control" placeholder="Inserisci la Password" name="psw" id="psw" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Registrati</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        Hai già un account? <a href="login.php">Accedi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

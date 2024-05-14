<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<body>
    <?php 
        $where="Login";
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
    <form action="check.php" method="post">
    <div class="container">
        <h1>Registrati</h1>
        <hr>
        <label><b>Nome</b></label>
        <input type="text" placeholder="Inserisci il tuo Nome" name="Nome" id="nome" required>
        <label><b>Cognome</b></label>
        <input type="text" placeholder="Inserisci il tuo Cognome" name="Cognome" id="cognome" required>
        <label><b>Email</b></label>
        <input type="email" placeholder="Inserisci l'email" name="email" id="email" required>
        <label><b>Tipologia</b></label>
        <input type="text" placeholder="Inserisci Tipologia" name="Tipo" id="Tipo" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
        <button type="submit" class="registerbtn">Registrati</button>
    </div>
    
    <div class="container signin">
        <p>Hai già un Account? <a href="login.php?user=''">Accedi</a>.</p>
    </div>
    <input type="hidden" name="ArrivoDa" value="Registrazione" />
    </form>
</body>
</html>

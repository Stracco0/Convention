<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
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
        <p>Hai già un Account? <a href="login.php">Accedi</a>.</p>
    </div>
    <input type="hidden" name="ArrivoDa" value="Registrazione" />
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

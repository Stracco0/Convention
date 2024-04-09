<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
        if($_REQUEST["user"]=="NotFound"){
            alert("Utente non trovato!");
        }
        if($_REQUEST["user"]=="PswErr"){
            alert("Password Errata!");
        }
        if($_REQUEST["user"]=="AlreadyExists"){
            alert("Email già registrata, Accedi!");
        }
        if($_REQUEST["user"]=="RegisterSuccesfull"){
            alert("Registrazione effettuata, Accedi!");
        }
        function alert($msg) {
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    ?>
    <form action="check.php" method="post">
        <div class="container">
            <label for="uname"><b>Email</b></label>
            <input type="email" placeholder="Inserisci Email" name="email_user" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Inserisci Password" name="psw_user" required>
                
            <button type="submit">Login</button>
        </div>
        <input type="hidden" name="ArrivoDa" value="Login" />
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

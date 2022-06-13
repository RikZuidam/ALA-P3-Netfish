<?php
    if(isset($_POST['btnSubmit'])) {
        if($_POST['password'] !== $_POST['password2']) {
            $usermessage = "Het wachtwoord moet hetzelfde zijn.";
        } else {
            echo "<pre>".print_r($_POST, true)."</pre>";

            foreach($_POST as $key => $value )
                $$key = $value;

            include "pdo.php";

            $sql = " INSERT INTO user (username, email, password)
                    VALUES (:username, :email, :password )";

            $stmt = $database->prepare($sql);
            $stmt->execute([
                ":username"        => $username,
                ":email"           => $email,
                ":password"        => $password
            ]);

            $database = null;

            header("location: ./inloggen.php");
        }
        
    }
?>
<!DOCTYPE html>  
<html>  
<head>
    <link rel="stylesheet" href="style.css" />
    <style>
    html {
        background-image: url(./img/registratie-background.jpg);
        height: 100%;

        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>
    <title>NETFISH | Registreren</title>
</head>  
<body id="registreren">  
    <?php include "header.php"?>
    <div id="main" style="margin-top: 10%;">
        <br />  
        <?php  
        if(isset($usermessage)) {  
            echo '<label class="text-danger" style="color:red">'.$usermessage.'</label>';  
        }  
        ?>
        <form method="post" id="form_register">  
            <label>Naam: </label>  
            <input type="text" name="name" class="options" required/>  
            <br />  
            <label>Gebruikersnaam: </label>  
            <input type="text" name="username" class="options" required/>  
            <br /> 
            <label>Email: </label>  
            <input type="email" name="email" class="options" required/>  
            <br />  
            <label>Wachtwoord: </label>  
            <input type="password" name="password" class="options" required/>  
            <br />
            <label>Wachtwoord ter controle: </label>  
            <input type="password" name="password2" class="options" required/>  
            <br />
            <input type="submit" name="btnSubmit" id="btn_register" value="Registreren">  
        </form> 
    </div> 
</body>
</html>
<?php  
 session_start();  
 $host = "localhost";  
 $username = "root";  
 $password = "root";  
 $database = "netfish";  
 $message = "";  
 try  
 {  
      $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label style="color:red">Alle velden moeten ingevuld zijn</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM user WHERE username = :username AND password = :password";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["username"] = $_POST["username"];  
                     header("location:main.php");  
                }  
                else  
                {  
                     $message = '<label style="color:red">Vul een geldig account in</label>';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
    <head>
        <link rel="stylesheet" href="style.css" />
        <title>NETFISH | Inloggen</title>
    </head>  
    <body>  
        <?php include "header.php"?>
        <div id="main" style="margin-top: 10%;">
           <br />  
            <?php  
            if(isset($message)) {  
                echo '<label style="display:inline-block;" class="text-danger">'.$message.'</label>';  
            }  
            ?>
            <form method="post" id="form_login">  
               <label>Username</label>  
               <input type="text" name="username" class="options"/>  
               <br />  
               <label>Password</label>  
               <input type="password" name="password" class="options"/>  
               <br />
               <input type="submit" name="login" id="btn_login" value="Login">  
            </form> 
        </div> 
      </body>  
 </html>
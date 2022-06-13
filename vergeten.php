<?php
if(isset($_POST["btnSubmit"])) {


    $url = 'https://api.sendgrid.com/';
    $user = 'apikey';
    $pass = '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';
   
    $params = array(
         'api_user' => $user,
         'api_key' => $pass,
         'to' => '$_POST["name"]',
         'subject' => 'testing from curl',
         'html' => 'testing body',
         'text' => 'testing body',
         'from' => 'rhj.zuidam@gmail.com',
      );
   
    $request = $url.'api/mail.send.json';
   
    // Generate curl request
    $session = curl_init($request);
   
    // Tell curl to use HTTP POST
    curl_setopt ($session, CURLOPT_POST, true);
   
    // Tell curl that this is the body of the POST
    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
   
    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
   
    // obtain response
    $response = curl_exec($session);
    curl_close($session);
   
    // print everything out
    print_r($response);
  
    $to_email = $_POST["name"];
    $subject = 'Wachtwoord opnieuw aanvragen';
    $message = '
    Geachte heer/mevrouw,
    
    U heeft verzocht uw wachtwoord te wijzigen, dit kan via de volgende url:
    http://xxxxx/reset.php?user_id=xxx&hash=xxxxxxxxxxxxxxxxxxxxxxxxxx
    Met vriendelijke groet,

    NETFISH';
    $headers = 'From: rhj.zuidam@gmail.com';
    mail($to_email,$subject,$message,$headers);

    header("location: ./vergeten.php");
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
    <title>NETFISH | Wachtwoord vergeten</title>
</head>  
<body>  
    <?php include "header.php"?>
    <div id="main_vergeten">
        <br />  
        <form method="post" id="form_vergeten">  
            <label>Gebruikersnaam of e-mail adres: </label>  
            <input type="text" name="name" class="form" required/>
            <br><br>
            <input type="submit" name="btnSubmit" id="btn_vergeten" value="Registreren">  
        </form> 
        <br><br>
    </div> 
</body>
</html>
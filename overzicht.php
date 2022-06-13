<?php
    include "pdo.php";

    if(isset($_GET['id'])) {
        //echo "<pre>".print_r($_GET, true)."</pre>";

        $stmt = $database->prepare("DELETE FROM movie WHERE id = :mid");
        $stmt->execute([":mid"=> $_GET['id']]);
        header("Location: overzicht.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NETFISH | Overzicht</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div id="container">
        <?php include_once "header2.php";?>
        <?php
           

            
            $sql = "SELECT id, year, title 
                    FROM `movie`";

            $videos = $database->prepare($sql);

            $videos->execute(); // data hose = brandslang met gegevens

            
            $str = "<form id='form_overzicht' action='' method='post'>";

            $str .= "<table width='70%'>";
            $str .= "<tr><th>Jaar</th><th>Titel</th><th>Actie</th></tr>";

            while($row = $videos->fetch(PDO::FETCH_OBJ)) {
                $sub = "<a href='?id={$row->id}'>Verwijderen</a>";
                $str .= "<tr><td>{$row->year}</td><td>{$row->title}</td><td>$sub</td></tr>";
            }
            $str .= "</table>";
            $str .= "</form>";

            echo $str;
        ?>



    </div>



</body>
</html>
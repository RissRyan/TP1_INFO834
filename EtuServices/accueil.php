<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mei you gongchandang</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
<?php
session_start();



try {
    $db = new PDO('mysql:host=localhost;dbname=etuservices', 'root', '');
    //echo 'FRIED CHICKEN';
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

if(isset($_POST['user_mail']) and isset($_POST['user_pass']))
{
    $mail = $_POST['user_mail'];
    $pass = $_POST['user_pass'];
    $query = "SELECT * FROM users WHERE email = \"$mail\" and password = \"$pass\"";

    foreach($db->query($query) as $row) {
        //print_r($row);
        $_SESSION['username'] = $row['prenom'];
        $_SESSION['ID'] = $row['ID'];

    }
}

if(isset($_SESSION['ID']) and isset($_SESSION['username']))
{
    echo 'Bonjour ' . $_SESSION['username'];
    echo '<a href="logout.php">LOGUE OUTE</a>'; 
    $name = $_SESSION['username'];
    $output = shell_exec("python .\main.py");

    echo $output;
}
else
{
    include('login.php');
}



?>
</body>
</html>
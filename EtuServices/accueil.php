<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>TP1</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
<?php
session_start();

# On se connecte à la BDD

try {
    $db = new PDO('mysql:host=localhost;dbname=etuservices', 'root', '');
    //echo 'FRIED CHICKEN';
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

# Si un utilisateur a essayé de se connecter on vérifie que son compte existe et si oui on crée la variable de session
# et on devrait normalement executer shell_exec() pour le script python (ne marche pas chez moi).
if(isset($_POST['user_mail']) and isset($_POST['user_pass']))
{
    $mail = $_POST['user_mail'];
    $pass = $_POST['user_pass'];
    $query = "SELECT * FROM users WHERE email = \"$mail\" and password = \"$pass\"";

    foreach($db->query($query) as $row) {
        $_SESSION['username'] = $row['prenom'];
        $_SESSION['ID'] = $row['ID'];

        $name = $_SESSION['username'];
        $output = shell_exec("python ../main.py $name 2>&1");
        var_dump($output);
    }
}

#Si l'utilisateur est connecté on crée un message d'accueil + pour se déconnecter. Sinon on affiche le formulaire de connexion.

if(isset($_SESSION['ID']) and isset($_SESSION['username']))
{
    echo 'Bonjour ' . $_SESSION['username'];
    echo '<br/><a href="logout.php">LOGUE OUTE</a>'; 
}
else
{
    include('login.php');
}

?>
</body>
</html>
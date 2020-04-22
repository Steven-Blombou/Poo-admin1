<?php

// include ('connectBDD.php');
require_once('models/class/class_user.php');
require_once('models/class/class_database.php');
  $connexion = new Database('db5000303628.hosting-data.io', 'dbs296615', 'dbu526524', 'jXd)G9)8');
  $bdd = $connexion->PDOConnexion();

        $pseudo_user = $_POST['email'];
        $password_user = $_POST['pass'];



        $user1 = new User($pseudo_user, $password_user);
        $req = $user1->login($bdd);



?>

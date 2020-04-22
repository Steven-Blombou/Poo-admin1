<?php

class User {
  // Nos variables
  // protected $_id_user;
  protected $_pseudo_user;
  // protected $_nom_user;
  // protected $_prenom_user;
  protected $_password_user;
  // protected $_mail_username;
  // protected $_confirmation_token;

  // Creation du constructeur
  public function __construct( $_pseudo_user, $_password_user){
    // $this->_id_user = $_id_user;
    $this->_pseudo_user = $_pseudo_user;
    // $this->_nom_user = $_nom_user;
    // $this->_prenom_user = $_prenom_user;
    $this->_password_user = $_password_user;
    // $this->_mail_username = $_mail_username;
    // $this->_confirmation_token = $confirmation_token;
  }

  // Getters
  // public function getid_user(){
  //   return $this->_id_user;
  // }

    public function getpseudo_user(){
      return $this->_pseudo_user;
    }

    public function getpassword_user(){
      return $this->_username;
    }

    // public function getmail_username(){
    //   return $this->_mail_username;
    // }

    // public function getconfirmation_token(){
    //   return $this->_confirmation_token;
    // }

    // Fonction login user
    public function login($bdd){
      $req = $bdd->prepare("SELECT * FROM User WHERE pseudo_user = :pseudo_user AND password_user = :password_user ");
      $req->execute(array(
                  ':pseudo_user' => $this->_pseudo_user,
                  ':password_user' => $this->_password_user
      ));



      $count = $req->rowCount();
      if($count > 0)
      {
          session_start();
          $_SESSION['pseudo_user'] = $this->_pseudo_user;
          $_SESSION['password_user'] = $this->_password_user;
          header("location:tab-admin/index.php");
      }
      else
      {
        //Mauvais identifiant
        header("location:index.php");
      }

    }

    public function register($bdd){
            if((!empty($this->_pseudo_user)) && (!empty($this->_password_user))){
                $req=$bdd->prepare("SELECT * FROM User WHERE mail_username = ?");
                $req->execute([$this->_pseudo_user]);
                $count= $req->rowCount();
                if ($count==0){
                    $req=$bdd->prepare("INSERT INTO User SET mail_username = ?, password_user = ?, id_type_user = 1");
                    $req->execute([$this->_pseudo_user,$this->_password_user]);
                    echo "Inscription reussie";
                    echo '<a href="index.php">conectez vous</a>';
                }else{
                    echo "mail deja pris";
                    echo '<a href="inscription.php">Réésayez</a>';
                }

            }else{
                echo "erreur";
            }
        }
}

 ?>

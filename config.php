<?php
session_start();
if(!isset($_SESSION['login'])) {
header('Location: connect.php');
  exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title><?php include('titre.txt') ?></title>
    <meta http-equiv="Cache-Control" content="no-cache" /> 
    <style type="text/css" media="all">@import "./css/css.css"; </style>
    <script type="text/javascript" src="java/xdir.js"></script>
  </head>
  <body>
  <?php include('menu.html'); ?>
  <br />
  <br /><center>
Votre pseudo actuelle est : <?php echo $_SESSION['login']; ?> (<a href ="modifpseudo.php">Modifier</a>)<br />
Votre mot de passe actuelle est :   <?php require("connecting.php");
                                          $login = $_SESSION['login'];
                                          $sql = "select * from membres_tbl where login='".$login."'";
                                          $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
                                          $data = mysql_fetch_assoc($req);
                                          mysql_close();
                                          echo $data['PASSWORD'];
                                     ?> (<a href ="modifmdp.php">Modifier</a>)<br />
Votre mail actuelle est : <?php echo $data['mail']; ?>
</center>
  </body>
</html>
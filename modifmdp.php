<?php
session_start();
if(!isset($_SESSION['login'])) {
header('Location: connect.php');
  exit;
}
      if(isset($_POST) && !empty($_POST['newpass'])) 
      {
      include("connecting.php");
        $newpass = mysql_real_escape_string(htmlspecialchars($_POST['newpass']));
        $vieupass = mysql_real_escape_string(htmlspecialchars($_POST['vieupass']));
        $sql = "select * from membres_tbl where PASSWORD='".$vieupass."'";
        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
        $data = mysql_fetch_assoc($req);
        $id = $data['id'];
        $modifpass = "UPDATE membres_tbl SET PASSWORD='".$newpass."' WHERE id='".$id."'";
        $modif = mysql_query($modifpass) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
        if($modif == true)
        {
          echo "Votre mot de passe &agrave; &eacute;t&eacute; modifi&eacute;";
          $_SESSION = array();
          session_destroy();
        }
        else
        {
          echo "Une erreur s'est produite";
        }
        mysql_close();
      }else{
                                          include("connecting.php");
                                          $login = $_SESSION['login'];
                                          $sql = "select password from membres_tbl where login='".$login."'";
                                          $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
                                          $data = mysql_fetch_assoc($req);
                                          mysql_close();
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
  <br />
    <center>
    Remplacer mot de passe actuelle : <b><?php echo $data['password'] ?></b> par : <br /><br />
      <form action="" method="post">
        <input type="text" name="newpass" size="30" />
        <input type="hidden" name="vieupass" value="<?php echo $data['password'] ?>">
        <input type="submit" value="Envoyer" />
      </form>
    </center>
  </body>
</html>
<?php } ?>
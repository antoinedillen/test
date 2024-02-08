<?php
session_start();
if(!isset($_SESSION['login'])) {
header('Location: connect.php');
  exit;
}
      if(isset($_POST) && !empty($_POST['pseudo'])) 
      {
      include("connecting.php");
        $newpseudo = mysql_real_escape_string(htmlspecialchars($_POST['pseudo']));
        $vieupseudo = mysql_real_escape_string(htmlspecialchars($_POST['vieupseudo']));
        $sql = "select * from membres_tbl where login='".$vieupseudo."'";
        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
        $data = mysql_fetch_assoc($req);
        $id = $data['id'];
        $modifpseudo = "UPDATE membres_tbl SET login='".$newpseudo."' WHERE id='".$id."'";
        $modif = mysql_query($modifpseudo) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
        if($modif == true)
        {
          $_SESSION = array();
          session_destroy();
          header('Location: connect.php');
           exit;
        }
        else
        {
          echo "Une erreur s'est produite";
        }
        mysql_close();
      }else{
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
    Remplacer pseudo actuelle : <b><?php echo $_SESSION['login']; ?></b> par : <br /><br />
      <form action="" method="post">
        <input type="text" name="pseudo" size="30" />
        <input type="hidden" name="vieupseudo" value="<?php echo $_SESSION['login']; ?>">
        <input type="submit" value="Envoyer" />
      </form>
    </center>
  </body>
</html>
<?php } ?>
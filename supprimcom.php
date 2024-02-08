<?php
session_start();
if(!isset($_SESSION['login'])) {
header('Location: connect.php');
  exit;
}
if(isset($_GET['id']) && isset($_GET['article']))
{
$article = $_GET['article'];
$id = $_GET['id'];
  include('connecting.php');
  $sql = 'DELETE FROM commentaire WHERE id_com='.$_GET['id'];
  $req = mysql_query($sql) or die(mysql_error()); 
  mysql_close();
  if($req == true) 
    {
      header("Location: voircom.php?id=" .$article);
      exit;
    }
  else
    {
      echo 'Erreur lors de la suppression !';
    }
}
else
{
echo "Merci de choisir un commentaire &agrave; supprimer";
}
?>

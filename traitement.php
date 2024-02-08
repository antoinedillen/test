<?php
session_start();
if(!isset($_SESSION['login'])) {
header('Location: connect.php');
  exit;
}
if( isset($_POST['upload']) ) // si formulaire soumis
{
  if( isset($_GET['id']) ) 
  {
  $id = $_GET['id'];
  $content_dir = 'upload/'; // dossier où sera déplacé le fichier
  $tmp_file = $_FILES['fichier']['tmp_name'];
  if( is_uploaded_file($tmp_file) )
  {
    $type_file = $_FILES['fichier']['type'];
    $allowed_types = array("image/bmp", "image/gif", "image/jpeg", "image/jpg",);
    if(in_array($type_file, $allowed_types))
    {
      $size = $_FILES['fichier']['size'];
      if($size < 50000)
      {
      // on copie le fichier dans le dossier de destination
      $name_file = $_FILES['fichier']['name'];
      $extension_image = strrchr(strtolower($name_file), '.');
      $name_filefin = $id.$extension_image;
        if( move_uploaded_file($tmp_file, $content_dir . $name_filefin) )
        {
        $chmod = chmod($content_dir . $name_filefin, 605);
        if ($chmod == true)
        {
        header('Location: index.php');
        exit;       
        }
        else
        {
          echo "Erreur";
        }
        }else{echo "Impossible de copier le fichier"; }
      }else{echo "Votre image est sup&eacute;rieure &agrave; la taille maximale de 30 000 octets";}
    }else{echo "Le fichier n'est pas une image"; }
  }else{echo "Le fichier est introuvable"; }
}else{echo "Aucun n'article n'a &eacute;t&eacute; trouv&eacute;"; }
}else{
if(isset($_GET['id'])){
$id = $_GET['id'];
	define('DIR', 'upload/');
	$filename = $id;
	switch(true)
	{
		case file_exists(DIR.$filename.'.jpg'):
			$action = 1;
			break;

		case file_exists(DIR.$filename.'.jpeg'):
			$action = 1;
			break;

		case file_exists(DIR.$filename.'.bmp'):
			$action = 1;
			break;

		case file_exists(DIR.$filename.'.gif'):
			$action = 1;
			break;

		default:
			$action = 0;
	}
if ($action == 1) { echo 'Une image existe d&eacute;j&agrave; pour cette article';
}
else 
{
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
<?php include('menu.html') ?>
<br /><br /><center>
	<h1>Envoyer une image</h1>
<br />
<img src="img/condition.jpg" alt="condition" />
<form method="post" enctype="multipart/form-data" action="">
		<p>			
			Image : <input type="file" name="fichier" /><input type="submit" name="upload" value="Uploader">
		</p>
	</form>
</center>
</body>
</html>
<?php
}
}
else
{echo "Aucun n'article n'a &eacute;t&eacute; s&eacute;lectionn&eacute;";}
}
?>
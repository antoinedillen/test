<?php
session_start();
if(!isset($_SESSION['login'])) {
header('Location: connect.php');
  exit;
}
if( isset($_POST['upload']) ) // si formulaire soumis
{
  if( isset($_GET['id_img']) ) 
  {
	define('DIR', 'upload/');
	$filename = $_GET['id_img'];
	switch(true)
	{
		case file_exists(DIR.$filename.'.jpg'):
                        $var = unlink(DIR.$filename.'.jpg');
			break;

		case file_exists(DIR.$filename.'.jpeg'):
                        $var = unlink(DIR.$filename.'.jpeg');
			break;

		case file_exists(DIR.$filename.'.bmp'):
                        $var = unlink(DIR.$filename.'.bmp');
			break;

		case file_exists(DIR.$filename.'.gif'):
                        $var = unlink(DIR.$filename.'.gif');
			break;

		default:
			$var = false;
	}
    if($var == true) 
    {
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
              $name_filefin = $filename.$extension_image;
              if( move_uploaded_file($tmp_file, DIR . $name_filefin) )
                {
                  header('Location: index.php');
                  exit;
                }else{echo "Impossible de copier le fichier"; }
            }else{echo "Votre image est sup&eacute;rieure &agrave; la taille maximale de 30 000 octets";}
          }else{echo "Le fichier n'est pas une image"; }
        }else{echo "Le fichier est introuvable"; }
      }else{ echo 'Erreur'; }
    }else{ echo 'Erreur'; }
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
<?php 
include('menu.html');
echo "<center>";
if(isset($_GET['id_img']))
  {
?>
    <h1>Modifier l'image</h1>
    <br />
    <img src="img/condition.jpg" alt="condition" />
    <br /><br />
    Image actuelle : 
<?php
	define('DIR', 'upload/');
	$filename = $_GET['id_img'];

	switch(true)
	{
		case file_exists(DIR.$filename.'.jpg'):
			echo '<img src="'.DIR.$filename.'.jpg'.'" alt=""/>';
			break;

		case file_exists(DIR.$filename.'.jpeg'):
			echo '<img src="'.DIR.$filename.'.jpeg'.'" alt=""/>';
			break;

		case file_exists(DIR.$filename.'.bmp'):
			echo '<img src="'.DIR.$filename.'.bmp'.'" alt=""/>';
			break;

		case file_exists(DIR.$filename.'.gif'):
			echo '<img src="'.DIR.$filename.'.gif'.'" alt=""/>';
			break;

		default:
			echo 'Une erreur s\'est produite';
	}
    ?>
<br /><br />
<form method="post" enctype="multipart/form-data" action="modifierimage.php?id_img=<?php echo $_GET['id_img']; ?>">
		<p>
			
			Image : <input type="file" name="fichier" /><input type="submit" name="upload" value="Uploader">
		</p>
	</form>
<?php
  }
else
  {
    echo "<br /><br />Une erreur s'est produite";
  }
?>
</center>
</body>
</html>
<?php } ?>
<?php
session_start();
if(!isset($_SESSION['login'])) {
header('Location: connect.php');
  exit;
}
if(isset($_GET['id_img']))
  {
	define('DIR', 'upload/');
	$filename = $_GET['id_img'];
	switch(true)
	{
		case file_exists(DIR.$filename.'.jpg'):
                        $var = unlink(DIR.$filename.'.jpg');
                        if ($var == true){
                        header('Location: index.php');
                        exit;
                        }else{echo 'Une erreur s\'est produite';}
			break;

		case file_exists(DIR.$filename.'.jpeg'):
                        $var = unlink(DIR.$filename.'.jpeg');
                        if ($var == true){
                        header('Location: index.php');
                        exit;
                        }else{echo 'Une erreur s\'est produite';}
			break;

		case file_exists(DIR.$filename.'.bmp'):
                        $var = unlink(DIR.$filename.'.bmp');
                        if ($var == true){
                        header('Location: index.php');
                        exit;
                        }else{echo 'Une erreur s\'est produite';}
			break;

		case file_exists(DIR.$filename.'.gif'):
                        $var = unlink(DIR.$filename.'.gif');
                        if ($var == true){
                        header('Location: index.php');
                        exit;
                        }else{echo 'Une erreur s\'est produite';}
			break;

		default:
			echo 'Une erreur s\'est produite';
	}
  }
else
  {
    echo 'Une erreur s\'est produite';
  }
?>
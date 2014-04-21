<?php
session_start();
 /*
 if (!isset ($_COOKIE[ini_get('session.name')])) {
    session_start();
  }
  */
// Comprobamos que el valor de la sesion logeado es igual a SI.

/*
	if($_SESSION['user']!='administrador' && ($_SESSION['logeado']=="" || $_SESSION['des_caja']=="" )){
	
		 // Escapamos para que no muestre ms nada.
		 echo "<script>alert('Su sesin ha caducado');window.parent.location.href = 'index.php';
</script>";
		 //header ('Location: terminar_sesion.php');
		 exit();
	}

*/
$tempSesion=$_SESSION['logeado']; 
//echo "<input name='xx' type='hidden'  value='".$tempSesion."'/>";
 //echo $tempSesion; 
if($tempSesion != "SI")
	{
	///echo "dfd";
	 // Si el valor en logeado es distinto a SI
	 // Redigimos a login.php para que vuelva a entrar.
	 if(file_exists("index.php")){
	 header ('Location: index.php');
	 }else{
	 header ('Location: ../index.php');
	 }
	 // Escapamos para que no muestre ms nada.
	 exit();
	}
// Si llegamos aqu es por realmente el valor de la sesin logeado es SI 

// Imprimimos el valor de la sesin que contiene el nombre del usuario.

//echo 'Hola ' . $_SESSION['usuario'];

?>

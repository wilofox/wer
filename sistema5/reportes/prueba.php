<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>

<table>
<?php

include('conex_inicial.php');
 $tienda = "101";
	 $strSQL2="select cod_prod, nom_prod, nombre, sum( if( tipo ='".$formato."', cantidad, 0 ) ) as cant from det_mov,unidades where id=unidad and  tienda in ('".$tienda."') group by cod_prod " ;
	 
	 echo $strSQL2;
	 $resultado2=mysql_query($strSQL2,$cn);
	 while($row2=mysql_fetch_array($resultado2)){

		  $codigo=$row2['cod_prod'];
		  $nom_prod = $row['nom_prod'];
		  $und=$row['nombre'];
		  
			  	 ?>  
	                   
     <tr>
        <td align="center"><?php echo $codigo?></td>
        <td><?php echo $nom_prod?></td>
        <td align="center"><?php echo $und?></td>
        <td align="center"><?php echo $tot?></td>
        <td width="351">&nbsp;</td>
     </tr>
     
     
      <?php 
	  }
	  ?>
      
      
    </table>

</body>
</html>

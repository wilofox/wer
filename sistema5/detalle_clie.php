<?php  
include('conex_inicial.php');
include('funciones/funciones.php');

?>
<table width="470" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" id="tblproductos">
  <?php 
		  
		  	//  if(isset($_REQUEST['nomb_det'])){
		
		//  }else{
		//   $strSQL1="select * from producto";
		 //// }
		//  echo $strSQL1;

		  
		//  if(isset($_REQUEST['nomb_det'])){
	  $nombre=$_REQUEST['nomb_det'];
		   $strSQL1="select * from cliente where razonsocial like '%$nombre%' or ruc like '%$nombre%'";
		//  }else{
		//   $strSQL1="select * from producto";
		 //// }

 
//  echo $contador;
  $resultado1=mysql_query($strSQL1,$cn);
   $contador=mysql_num_rows($resultado1);
  while($row1=mysql_fetch_array($resultado1)){
		  
		    	  
		  ?>
  <tr>
    <td width="50"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><a href="javascript:elegir('<?php echo $row1['codcliente']?>','<?php echo caracteres($row1['razonsocial'])?>','<?php echo $row1['direccion']?>','<?php echo $row1['ruc']?>')"><?php echo $row1['codcliente'];?></a><a href="javascript:elegir('<?php echo $row1['codcliente']?>','<?php echo $row1['razonsocial']?>','<?php echo $row1['direccion']?>','<?php echo $row1['ruc']?>')"></a></font></td>
    <td width="200"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php echo $row1['razonsocial'];?></font></td>
    <td width="80"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php echo $row1['ruc']?></font></td>
    <td width="140"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php echo $row1['direccion']?></font></td>
  </tr>
  <?php 
   
  } 
  
    if($contador==0){
  ?>
  <?php 
  }
  ?>
</table>

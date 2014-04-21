<? session_start();
   include('../conex_inicial.php');
   
   $cod_tienda = trim ( $_POST['cod_tienda'] );
  if(!empty( $cod_tienda )) 
 ?>  
 	<select id="cod_tienda" name="cod_tienda" class="FrmCmbChico" >
		<option value = "to" >Todos</option>
<?	    $rsti	=	mysql_query(" SELECT cod_tienda,des_tienda FROM tienda WHERE cod_suc=".$cod_tienda." ORDER BY des_tienda",$cn);
        while(	$rowti = mysql_fetch_array(	$rsti )	){
?>		<option value='<?=trim($rowti['cod_tienda'])?>'><?=trim($rowti['des_tienda'])?></option>
<?      } ?>    
    </select>
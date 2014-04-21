<?php 
include('conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #003366; }
.Estilo32 {color: #003366}
.Estilo13 {color: #0767C7}
.Estilo9 {	font-size: 10px;
	font-weight: bold;
}
-->
</style>
</head>

<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
.Estilo15 {color: #FFFFFF}
.Estilo19 {font-family: Arial, Helvetica, sans-serif}
.Estilo21 {color: #FF6600}
.Estilo24 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo27 {color: #333333}
.Estilo30 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #003366;}
.Estilo31 {font-size: 10px}
.anulado  {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
.Estilo33 {font-size: 12}
-->
</style>

<link rel="stylesheet" type="text/css" media="all" href="calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="calendario/calendar.js"></script>
<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendario/calendar-setup.js"></script>

<body>
<table width="742" height="151" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="742"><form name="form1" method="post" action="">
      <table width="723" height="212" border="0" cellpadding="0" cellspacing="0">
        <tr  style="background:url(imagenes/white-top-bottom.gif)">
      <td width="1033" height="27" colspan="11" style="border:#999999">
	  <span class="Estilo19 Estilo1 Estilo32 text5"><span class="Estilo1 Estilo32 Estilo33"><span class="Estilo1 Estilo32 Estilo24"><strong> Log&iacute;stica :: Inventarios :: Consolidado Productos Vendidos
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
      </strong></span></span></span>	  </td>
    </tr>
        <tr>
          <td height="19">&nbsp;</td>
          <td><span class="Estilo17 text5 text5 Estilo19 Estilo21"><span class="text5 text5 Estilo24 Estilo31 Estilo32"><span class="text5 text5 Estilo31">Fecha1:</span></span></span></td>
          <td><span class="Estilo17 text5 text5 Estilo19 Estilo21"><span class="text5 text5 Estilo24 Estilo31 Estilo32"><span class="text5 text5 Estilo31">Fecha2:</span></span></span></td>
          <td width="124"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Vendedor</span></span></span><span class="text5 text5 Estilo19 Estilo27 Estilo31">:</span></td>
          <!--<td><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24"><span class="Estilo24"><span class="Estilo24"><span class="Estilo24"><span class="Estilo24"><span class="Estilo24"><span class="Estilo24">Terminal</span></span></span></span></span></span></span></span></span><span class="text5 text5 Estilo19 Estilo27 Estilo31">:</span></td>-->
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td width="5" height="23">&nbsp;</td>
          <td width="108"><label for="textfield"></label>
            &nbsp;&nbsp;
            <input  name="fecha1" type="text" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha1'])){echo $_REQUEST['fecha1'];}else{ echo date('Y-m-d');} ?>">
            <button type="reset" id="f_trigger_b2" >...</button>
            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha1",      
        ifFormat       :    "%Y-%m-%d",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
            </script></td>
          <td width="114">&nbsp;&nbsp;
            <input  name="fecha2" type="text"  size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha1'])){echo $_REQUEST['fecha2'];}else{ echo date('Y-m-d');} ?>">
            <button type="reset" id="f_trigger_b3" >...</button>
            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%Y-%m-%d",      
        showsTime      :    true,            
        button         :    "f_trigger_b3",   
        singleClick    :    true,           
        step           :    1                
    });
            </script></td>
          <td align="left"><select style="width:120" name="vendedor">
            <option value="000">------ Todos ------</option>
            <?php 
			$strSQL="select * from usuarios where codigo >=002";
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			
			?>
            <option value="<?php echo $row['codigo']?>"><?php echo $row['usuario']?></option>
            <?php 
			
			}?>
            <script>
			 var valor1="<?php echo $_REQUEST['vendedor']?>";
     var i;
	 for (i=0;i<document.form1.vendedor.options.length;i++)
        {
		
            if (document.form1.vendedor.options[i].value==valor1)
               {
			   
               document.form1.vendedor.options[i].selected=true;
               }
        
        }
			
			      </script>
          </select></td>
          <!--<td width="132"><select name="serie" style="width:120">
            <option value="000">------ Todos -------</option>
            <?php /*
			$strSQL="select * from caja";
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			
			?>
            <option value="<?php echo $row['codigo']?>"><?php echo $row['descripcion']?></option>
            <?php }?>
            <script>
			 var valor1="<?php echo $_REQUEST['serie']*/?>";
     var i;
	 for (i=0;i<document.form1.serie.options.length;i++)
        {
		
            if (document.form1.serie.options[i].value==valor1)
               {
			   
               document.form1.serie.options[i].selected=true;
               }
        
        }
			
			      </script>
          </select>   		    </td>-->
          <td width="81"><input type="submit" name="Submit" value="Consultar" ></td>
          <td width="122" align="center"><table  width="80%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" onClick="vista('vista')"  style="cursor:pointer; border:#09549F solid 1px">
            
            <tr>
              <td align="center"><span class="Estilo9 Estilo13"><span class="Estilo9"><img src="imagenes/ico_lupa.png" width="16" height="16"></span>Vista Impresi&oacute;n </span></td>
            </tr>
          </table></td>
            <td width="117" align="center"><table  width="80%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" onClick="vista('excel')"  style="cursor:pointer; border:#09549F solid 1px">
            
            <tr>
              <td align="center"><span class="Estilo9 Estilo13"><span class="Estilo9"><img src="imagenes/icono-excel.gif" width="16" height="16"></span>Vista Excel </span></td>
            </tr>
          </table></td>
          <td width="52">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="7">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="7" valign="top">
		  
		  <table width="709" border="0" cellpadding="1" cellspacing="1">
            <tr>
              <td width="34" bgcolor="#006699">&nbsp;</td>
              <td width="64" height="18" align="center" bgcolor="#006699"><span class="Estilo7 Estilo15">Codigo</span></td>
              <td width="308" bgcolor="#006699"><span class="Estilo7 Estilo15">Descripci&oacute;n</span></td>
              <td width="71" bgcolor="#006699"><span class="Estilo7 Estilo15">Cantidad</span></td>
              <td width="82" align="right" bgcolor="#006699"><span class="Estilo7 Estilo15">Valorizado</span></td>
              <td width="131" align="center" bgcolor="#006699">&nbsp;</td>
              </tr>
			
			
			<?php 
			
			$fecha1=$_REQUEST['fecha1'];
			$fecha2=$_REQUEST['fecha2'];
			
			
			/*$serie=$_REQUEST['serie'];
			if($serie!="000"){
			$filtro2=" and c.serie='$serie' ";
			}else{*/
			$filtro2="";
			//}
			$vende=$_REQUEST['vendedor'];
			if($vende!="000"){
			$filtro1=" and c.cod_vendedor='$vende' ";
			}else{
			$filtro1="";
			}
			$val_item=0;
			
			$strSQL="SELECT c.*,cod_prod,cantidad,precio,c.impto1 as igv_d,c.incluidoigv as flag_igv,d.flag_kardex as fk from cab_mov c, det_mov d where d.cod_cab=c.cod_cab and c.cod_ope!='CM' and c.cod_ope!='AS' and c.cod_ope!='TS' and  substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro2.$filtro1." and c.flag!='A' and c.tipo=2 order by d.nom_prod";
			//echo $strSQL;
			  $d=0;
			  $c=0;
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
				if($row['total']<>0.00){
					if($d==0){
						$codp=$row['cod_prod'];
						$result[0][$c]=$row['cod_prod'];
						$result[1][$c]=0;
						$result[2][$c]=0;
					}
					if($codp==$row['cod_prod']){
						if($row['fk']=='1'){
							$result[1][$c]=$row['cantidad']-$result[1][$c];
						}else{
							$result[1][$c]=$row['cantidad']+$result[1][$c];
						}
						$sql_prod=mysql_query("Select moneda from producto where idproducto='".$row['cod_prod']."'",$cn);
						$row_prod=mysql_fetch_array($sql_prod);
						if($row['moneda']<>$row_prod[0]){
							switch($row['moneda']){
								case '01':$precio=$row['precio']*$row['tc'];break;
								case '02':$precio=$row['precio']/$row['tc'];break;
							}
						}else{
							$precio=$row['precio'];
						}
						$imp_t=$row['cantidad']*$precio;
						if($row['flag_igv']=='N'){
							$iv=$imp_t*$row['igv_d']/100;
							$imp_t=$imp_t+$iv;
						}
						$result[2][$c]=$imp_t+$result[2][$c];
					}else{
						$c++;
						$codp=$row['cod_prod'];
						$result[0][$c]=$row['cod_prod'];
						$result[1][$c]=0;
						$result[2][$c]=0;
						if($row['fk']=='1'){
							$result[1][$c]=$row['cantidad']-$result[1][$c];
						}else{
							$result[1][$c]=$row['cantidad']+$result[1][$c];
						}
						$sql_prod=mysql_query("Select moneda from producto where idproducto='".$row['cod_prod']."'",$cn);
						$row_prod=mysql_fetch_array($sql_prod);
						if($row['moneda']<>$row_prod[0]){
							switch($row['moneda']){
								case '01':$precio=$row['precio']*$row['tc'];break;
								case '02':$precio=$row['precio']/$row['tc'];break;
							}
						}else{
							$precio=$row['precio'];
						}
						$imp_t=$row['cantidad']*$precio;
						if($row['flag_igv']=='N'){
							$iv=$imp_t*$row['igv_d']/100;
							$imp_t=$imp_t+$iv;
						}
						$result[2][$c]=$imp_t+$result[2][$c];
					}
					$d++;
				}
			}
//			}
			  //print_r($result[0]);
			  //print_r($result[1]);
			  //print_r($result[2]);
			  //echo $d."-".$c;
			for($i=0;$i<count($result[0]);$i++){  
//			  while($row=mysql_fetch_array($resultado)){
  				//echo $result[0][$i]." - ".$result[1][$i]." - ".$result[2][$i]."<br>";
				//$codigo=$row['cod_prod'];
				//$producto=$row['nom_prod'];
				//$cantidad=$row['cantidad']; 
				$codigo=$result[0][$i];
				$cantidad=$result[1][$i]; 
				$sql_prod=mysql_query("Select nombre from producto where idproducto='".$codigo."'",$cn);
				$row_prod=mysql_fetch_array($sql_prod);
				$producto=$row_prod[0];
                $total_item=$total_item+$cantidad;
				//$val_item=$val_item+($cantidad*$row['precio']);
				$val_item=$val_item+($result[2][$i]);
				
			?>
						
            <tr>
              <td bgcolor="#F9F9F9">&nbsp;</td>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $codigo?></span></td>
              <td bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $producto?></span></td>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $cantidad?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo number_format($result[2][$i],2,".","");/*echo $cantidad*$row['precio'];*/?></span></td>
              <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
              </tr>
			

		  	<?php 
		
		}
			?>
			
		    <tr>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      </tr>
		    <tr>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
              <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
              <td bgcolor="#F9F9F9"><span class="Estilo7">Total General</span></td>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo7"><?php echo $total_item;?></span></td>
              <td align="right" bgcolor="#F9F9F9" class="Estilo17"><?php echo number_format($val_item,2,".","");?></td>
              <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      </form>
    </td>
  </tr>
</table>



</body>
</html>

<script>

function doc_det(valor){

window.open("doc_det.php?referencia="+valor,"","toolbar=yes,status=no, menubar=no, scrollbars=no, width=500, height=300,left=300 top=250");

}
function vista(formato){
//alert(formato);
var fecha1=document.form1.fecha1.value;
var fecha2=document.form1.fecha2.value;
var vendedor=document.form1.vendedor.value;
var serie="000";
//document.form1.serie.value;
window.open("reportes/rpt_recoleccion.php?fecha1="+fecha1+"&fecha2="+fecha2+"&vendedor="+vendedor+"&serie="+serie+"&formato="+formato,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=700, height=700,left=50 top=50");
}




</script>

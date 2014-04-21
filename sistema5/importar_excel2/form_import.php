<?php ini_set("memory_limit","2048M"); ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>jQuery Easy - Importar Excel</title>
<link rel="stylesheet" type="text/css" href="http://www.jqueryeasy.com/wp-content/themes/bigfoot/style.css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="jQuery Easy RSS Feed" href="http://www.jqueryeasy.com/feed/" />
<link rel="alternate" type="application/atom+xml" title="jQuery Easy Atom Feed" href="http://www.jqueryeasy.com/feed/atom/" />
<link rel="pingback" href="http://www.jqueryeasy.com/xmlrpc.php" />
<!--<link rel="shortcut icon" href="http://www.jqueryeasy.com/wp-content/themes/bigfoot/images/favicon.ico" />-->
<link rel='stylesheet' id='wp-pagenavi-css'  href='http://www.jqueryeasy.com/wp-content/plugins/wp-pagenavi/pagenavi-css.css?ver=2.70' type='text/css' media='all' />
<script type='text/javascript' src='http://www.jqueryeasy.com/wp-includes/js/l10n.js?ver=20101110'></script>
<script type='text/javascript' src='http://www.jqueryeasy.com/wp-includes/js/jquery/jquery.js?ver=1.6.1'></script>

<script type="text/javascript" src="http://www.jqueryeasy.com/wp-content/plugins/syntax-highlighter-compress/scripts/shCore.js"></script>
<script type="text/javascript" src="http://www.jqueryeasy.com/wp-content/plugins/syntax-highlighter-compress/scripts/shAutoloader.js"></script>
<link type="text/css" rel="stylesheet" href="http://www.jqueryeasy.com/wp-content/plugins/syntax-highlighter-compress/styles/shCoreDefault.css"/>
<!-- END: Syntax Highlighter ComPress -->
<style type="text/css">
.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}.Estilo1 {color: #0066FF}
</style>
<script language="javascript" type="text/javascript" src="http://www.jqueryeasy.com/wp-content/themes/bigfoot/javascripts/jquery.js"></script>
<script language="javascript" type="text/javascript" src="http://www.jqueryeasy.com/wp-content/themes/bigfoot/javascripts/tabber.js"></script>
<script language="javascript" type="text/javascript" src="http://www.jqueryeasy.com/wp-content/themes/bigfoot/javascripts/superfish.js"></script>
<!--[if lt IE 7]>
<script type="text/javascript" src="http://www.jqueryeasy.com/wp-content/themes/bigfoot/javascripts/pngfix.js"></script>
<script type="text/javascript" src="http://www.jqueryeasy.com/wp-content/themes/bigfoot/javascripts/menu.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="http://www.jqueryeasy.com/wp-content/themes/bigfoot/css/ie.css" />
<![endif]-->
</head>
<body>

<style type="text/css">
	#demos{
		width:800px;
		margin:10px auto 0 auto;
		padding:30px;
		border:1px solid #DFDFDF;
		font:normal 12px Arial, Helvetica, sans-serif
	}
	#demos h3{
		border-bottom:1px solid #DFDFDF;
		padding-bottom:7px;
		margin:10px 0
	}
	table{
		margin-top:15px;
		width:100%
	}
	table td{
		padding:7px;
		border:1px solid #CCC
	}
</style>
<div id="demos">
  <h3>&nbsp;</h3>
  
  
  <form action="form_import.php" method="post" enctype="multipart/form-data" name="frmload" id="frmload">
    <table width="548" height="100" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="339" align="center" valign="middle"><h3><label><fieldset><legend><span class="Estilo1">Cargar Archivo</span></legend></fieldset></label>&nbsp;Seleccionar archivo Excel
            <script>
  
  function eliminar(){
  	
	
  	location.href='form_import.php?elim&periodo='+document.frmload.periodo.value+'&anio='+document.frmload.anio.value;
  
  } 
  
            </script>
            <input type="file" name="file" />
&nbsp; &nbsp; &nbsp;
<input name="submit" type="submit" value="----- IMPORTAR -----" />
        </h3>
        </td>
        <td width="338" align="center"><fieldset><legend><span class="Estilo1">Eliminar Importación</span></legend>
            <table width="319" height="61" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center">Periodo:
                  <select name="periodo" id="periodo">
                    <option value="01" selected="selected">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                  </select>
                  <select name="anio" id="anio">
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013" selected="selected">2013</option>
                  </select></td>
              </tr>
              <tr>
                <td align="center"><input type="button" name="Submit" value="Eliminar Importaci&oacute;n" onclick="eliminar();" /></td>
              </tr>
            </table>
        </fieldset> </td>
      </tr>
    </table>
  </form>
  <div id="show_excel">
    <?php 
		
		include('../funciones/funciones.php');
		include('../conex_inicial.php');
		
		
		if(isset($_REQUEST['elim'])){		
		
		$importado=date("Y-m-d");
		$periodo=$_REQUEST['periodo'];
		$anio=$_REQUEST['anio'];
				
		$strSQL="select * from cab_mov where importado!='0000-00-00' and substring(fecha,1,7)='$anio-$periodo' " ;
		
		//echo $strSQL;
		
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){
		
			$strSQL="delete from det_mov where cod_cab='".$row['cod_cab']."'";
			mysql_query($strSQL,$cn);
			
			
		}
						
			$strSQL="delete from cab_mov where importado!='0000-00-00' and substring(fecha,1,7)='$anio-$periodo' ";
			mysql_query($strSQL,$cn);
		
		echo "Eliminaci&oacute;n Completa...";
		die();		
		}
				
		if($_FILES['file']['name'] != '')
		{
			
			require_once 'reader/Classes/PHPExcel/IOFactory.php';

			//Funciones extras
			
			function get_cell($cell, $objPHPExcel){
				//select one cell
				$objCell = ($objPHPExcel->getActiveSheet()->getCell($cell));
				//get cell value
				return $objCell->getvalue();
			}
			
			function pp(&$var){
				$var = chr(ord($var)+1);
				return true;
			}
	
			$name	  = $_FILES['file']['name'];
			$tname 	  = $_FILES['file']['tmp_name'];
			$type 	  = $_FILES['file']['type'];
				
			if($type == 'application/vnd.ms-excel')
			{
				// Extension excel 97
				$ext = 'xls';
			}
			else if($type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
			{
				// Extension excel 2007 y 2010
				$ext = 'xlsx';
			}else{
				// Extension no valida
				echo -1;
				exit();
			}
		
			$xlsx = 'Excel2007';
			$xls  = 'Excel5';
	
			//creando el lector
			$objReader = PHPExcel_IOFactory::createReader($$ext);
			
			//cargamos el archivo
			$objPHPExcel = $objReader->load($tname);
		
			$dim = $objPHPExcel->getActiveSheet()->calculateWorksheetDimension();
		
			// list coloca en array $start y $end
			list($start, $end) = explode(':', $dim);
				
			if(!preg_match('#([A-Z]+)([0-9]+)#', $start, $rslt)){
				return false;
			}
			list($start, $start_h, $start_v) = $rslt;
			if(!preg_match('#([A-Z]+)([0-9]+)#', $end, $rslt)){
				return false;
			}
			list($end, $end_h, $end_v) = $rslt;
		
			//empieza  lectura vertical
			//$table = "<table  border='1'>";
			$zip=0;
			for($v=$start_v; $v<=$end_v; $v++){
				//empieza lectura horizontal
				
				//$table .= "<tr>";
				
				if($zip<>0){	
				
				for($h=$start_h; ord($h)<=ord($end_h); pp($h)){
					$cellValue = get_cell($h.$v, $objPHPExcel);
					//$table .= "<td>";
					if($cellValue !== null){
						//$table .= $cellValue;
						$campos=$campos."|".$cellValue;
					}
					//$table .= "</td>";
				}
				//$table .= "</tr>";
				
				
				//**********************
				
				
				
				$temp=explode("|",$campos);
				$tipomov=$temp[3];
				$doc=$temp[4];
				$serie=substr($temp[5],0,3);
				$numero=substr($temp[5],3,7);
				$auxiliar="";
				$ruc=$temp[8];
				$razonsocial=$temp[6];
				$t_persona=$temp[7];
				$direccionClie=$temp[10];
				$tienda=$temp[1];
				$sucursal=substr($temp[1],0,1);
				$idproducto=str_pad($temp[11],6,"0",STR_PAD_LEFT);
				$moneda=str_pad($temp[13],2,"0",STR_PAD_LEFT);
				$precio=$temp[14];
				$cantidad=$temp[12];
				$imp_item=number_format($precio*$cantidad,2);
				$femision=formatofecharay($temp[2]);
				$kardex_pro="S";
				$afecto="S";
				$flag_kardex=$tipomov;
				$unidad="09";
				$factor="1000";
				$ruc_vend=$temp[18];
				
				if($serie=='' || $numero==''){				
				continue;
				}
				
				//******************************cliente****************************
				 list($auxiliar)=mysql_fetch_row(mysql_query("select codcliente from cliente where ruc='".$ruc."'"));
				 $strSQL2="";
				 if($auxiliar==''){
				 
				 
				 $resultado3=mysql_query("select max(codcliente) as codigo from cliente",$cn);
				$row3=mysql_fetch_array($resultado3);
				
				$codigocli=$row3['codigo'];
				$codigocli=str_pad($codigocli+1,6,'0',STR_PAD_LEFT);
				
				
				if($t_persona=='N'){
				$t_persona="natural";
				}else{
				$t_persona="juridica";
				}
				
				$tipoAux='C';
				
				 $strSQL2= "insert into cliente (codcliente,tipo_aux,razonsocial,ruc,telefono,nombres,apellidos,t_persona,doc_iden,direccion,email,contacto,cargo,baja,web,clas_clie,condicion,estado_percep,por_percep,lider,codlider,tipoprov,responsable,ubigeo) values ('".$codigocli."','".$tipoAux."','".$razonsocial."','".$ruc."','".$telefono."','".$nombres."' ,'".$apellidos."' ,'".$t_persona."' ,'".$doc_iden."' ,'".$direccionClie."' ,'".$email."' ,'".$contacto."','".$cargo."','".$baja."','".$web."','".$clas_clie."','".$condicion."','".$estado_percep."','".$por_percep."','".$lider."','".$codlider."','".$tipoprov."','".$responsable."','".$idubigeo."')";
				
				//echo 
				$auxiliar=$codigocli;
				
			mysql_query($strSQL2,$cn);
				 
				 }
				 //***************************************************************
				 
				
				$strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep,porcen_percep,ancho,largo,mt2,factor,descOT,codanex,desc1) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','".$idproducto."','".$nombreprod."','".$tc."','".$moneda."','".$precio."','".$cantidad."','".$imp_item."','".$femision."','".$kardex_pro."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','".$notas."','".$flag_kardex."','".$unidad."','".$flag_percep."','".$porcen_percep_det."','".$ancho."','".$largo."','".$mt2."','".$factor."','".$descOT."','".$descOT."','".$desc1."')"; 
				
				//$table .= "<tr><td colspan='20'>".$strSQL2."<br>".$strSQL444."</td></tr>";
				$campos="";
				
				mysql_query($strSQL444,$cn);
				
				//echo $strSQL444;
				//**********************
			}
			$zip++;
			}
		//	$table .= "</table>";
			
			echo $table;		
		}
		
		$strSQL="select sum(cantidad*precio) as total, count(cod_det) as cont,GROUP_CONCAT(CAST(cod_det  as char(8))) as cod_det2, det_mov.* from det_mov where cod_cab='0' group by cod_ope,tipo,serie,numero,tipo,tienda,sucursal order by cod_det";
		//echo $strSQL;
		
		$resultado=mysql_query($strSQL);
		while($row=mysql_fetch_array($resultado)){
				
		$strSQL2="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado2=mysql_query($strSQL2,$cn);
		$row2=mysql_fetch_array($resultado2);
		$codigo=$row2['cod_cab']+1;
				
		$incluidoigv="S";
		$kardex="S";
		$inafecto="N";
		
		$totalDoc=number_format($row['total'],2);
		$b_imp=number_format($totalDoc/1.18,2);
		$igv=$totalDoc-$b_imp;
		$importado=date("Y-m-d");
		
		$strSQLInsert="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,cliente,fecha,moneda,tc,b_imp,igv,total,tienda,sucursal,incluidoigv,kardex,inafecto,importado,impto1)values('".$codigo."','".$row['tipo']."','".$row['cod_ope']."','".$row['numero']."','".$row['serie']."','".$row['vendedor']."','".$row['auxiliar']."','".$row['fechad']."','".$row['moneda']."','".$row['tcambio']."','".$b_imp."','".$igv."','".$totalDoc."','".$row['tienda']."','".$row['sucursal']."','".$incluidoigv."','".$kardex."','".$inafecto."','".$importado."','18')";
		
		//echo $strSQLInsert;
		
		mysql_query($strSQLInsert,$cn);
		
		$array_Cod_det=explode(',',$row['cod_det2']);
					
			foreach ($array_Cod_det as $subkey=> $subvalue) {						
			$strUdp="update det_mov set cod_cab='".$codigo."' where cod_det='".$subvalue."'";
			
			echo $strUdp."<br>";
			
			mysql_query($strUdp,$cn);			
			}
			
		}		
		
		?>
  </div>
</div>
</body>
</html>

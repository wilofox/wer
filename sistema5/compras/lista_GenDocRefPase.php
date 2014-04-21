<?php 

		session_start();
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
		
?><style type="text/css">
<!--
.Estilo100 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
-->
</style>
<div id="detalle" style="width:802px; height:260px; overflow-y:scroll;border:0px solid;" >
<table width="784"  border="1" cellpadding="0" cellspacing="0" bgcolor="#003399" id="lista_productos">
  <?php 
    
		 //PAGINACION 1	
		 $registros = 100; 
		 $pagina = $_REQUEST['pagina']; 
			   
		//echo $pagina;

		if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		} 
		//------------------------------------------
			
			$almacen=$_REQUEST['almacen'];
			$cliente=$_REQUEST['cliente'];
			$ruc=$_REQUEST['ruc'];
			$vendedor=$_REQUEST['vendedor'];
			$docref=$_REQUEST['docref'];
			$tipomov=$_REQUEST['tipomov'];
			$fec1=$_REQUEST['fec1'];
			$fec2=$_REQUEST['fec2'];
			$mosdocFac=$_REQUEST['mosdocFac'];
			$mosdocAnu=$_REQUEST['mosdocAnu'];
			$Estado=$_REQUEST['Estado'];
			$inifec=explode("-",$fec1);
			$finfec=explode("-",$fec2);
			
			

if ($mosdocAnu<>''){			
 $SQLMosDoc=" and flag ='$mosdocAnu' ";
}


$Estado=ereg_replace("=F", "='F'", $Estado);
$Estado=ereg_replace("=O", "='O'", $Estado);
$Estado=ereg_replace("=A", "='A'", $Estado);

if (substr($Estado,0,2)<>'T'){
	if (substr($Estado,0,2)=='P' || substr($Estado,0,2)=='T'){
	$Estado=substr($Estado,2,200);
	}
		$Estado=ereg_replace("and", "or", $Estado);
		$Estado= "and ".substr($Estado,3,300);
	if ($Estado=="and "){
	$Estado= "";
	}
}
//echo $Estado;

 if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado ="";
		  }elseif (trim($Estado)=='P'){
			$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'F' "; 
		  }elseif (trim($Estado)=='F'){
			$SQLEstado ="  and flag<>'A' and estadoOT='F' "; 
		  }else{
		  
			$SQLEstado =$Estado;
		  }	
 }else{
	$SQLEstado =" and flag<>'A' and estadoOT<>'O' and estadoOT<>'F' ";
  }
 
 // and flag_r <>'RA'
  
  if($docref!="0"){
   $filtroCod =" and cod_ope='$docref' and tipo='".$tipomov."' ";
 //  echo $filtroCod;
  }else{
   $filtroCod =" and (cod_ope='TB' or cod_ope='TF' or cod_ope='NV') ";
  } 
  
 $SQLConsulta=" where tienda='$almacen' ".$filtroCod." and cod_vendedor like '%$vendedor%'
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
  $SQLMosDoc   $SQLEstado
    ";

// 	and flag_r <>'RA'
//and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".date('Y-m-d')."'

$resultados = mysql_query("select * from cab_mov CM
inner join cliente C on CM.cliente =C.codcliente 
$SQLConsulta
order by cod_ope" ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select * from cab_mov  CM
inner join cliente C on CM.cliente =C.codcliente 	
$SQLConsulta and substring(fecha,1,10) between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."' order by fecha desc LIMIT $inicio, $registros";
//echo $strSQL;	
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
			
			while($row=mysql_fetch_array($resultado)){
						 
			 	$j++;
				if($j%2==0){
				$color_row='#FFFFFF';//'#E9F3FE';#00FFCC #FFFFFF'
				}else{
				$color_row='#FFFFFF';
				}	
// documentos anulados rojo
$AnRK='';	
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['flag']=='A'){
		$color_row='#FFFFFF';
		$AnRK='2';
	}
}	
// documentos con serie (anulara y desanular no permite)
$sql="select * from series where producto in  (
select cod_prod from det_mov where cod_cab='".$row['cod_cab']."' )
and tienda='$almacen'  LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['id']<>''){
		$color_row='#FFFFFF';
	//	$AnRK='3';
	}
}
 //documentos con Pagos (anulara y desanular no permite)
/*$sql="select *  from cab_mov where cod_cab='".$row['cod_cab']."'  and condicion='2'
 and flag <>'A'
LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
		$color_row='#FFDFF4';
		$AnRK='3';
}*/						 					
 //documentos Terminado
$sql="select * from cab_mov where cod_cab='".$row['cod_cab']."'  and cod_ope in ('OP') and flag<>'A'
LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){

	if ($rowX['estadoOT']=='F'){
		$color_row='#FFFFFF';
		$AnRK='3';
	}elseif ($rowX['estadoOT']=='O'){
		$color_row='#FFFFFF';
		//$AnRK='3';
	}elseif ($rowX['estadoOT']=='F'){
		//$color_row='#FF6600';
		$AnRK='3';
	}
	//echo "estado".$rowX['estadoOT'];
}

//echo "-->".$AnRK;
$data="";	
$data=$row['sucursal']."~".$row['cod_ope']."~".$row['serie']."~".$row['Num_doc']."~".$row['ci']."~";
list($tip_form)=mysql_fetch_array(mysql_query(" select formato from operacion where codigo='".$row['cod_ope']."'"));					
$data.=	$tip_form;			



//-------------------------documento referencia-----------------------------------


	
	//echo $row['flag_r'];
	$acuentaDocRef=0;
	$serieRef="";
	$numeroRef="";
	if($row['flag_r']=='RO'){
		
		
		
		$strSQLSM="select * from referencia where cod_cab_ref='".$row['cod_cab']."' order by id desc ";
		$resultadoMS=mysql_query($strSQLSM,$cn);
		$rowSM=mysql_fetch_array($resultadoMS);
		
		
		$strSQLSM="select * from cab_mov where cod_cab='".$rowSM['cod_cab']."' ";
		$resultadoMS=mysql_query($strSQLSM,$cn);
		$rowR=mysql_fetch_array($resultadoMS);   	
				
		$codDocRef=$rowR['cod_cab'];
		$serieRef=$rowR['serie'];
		$numeroRef=$rowR['Num_doc'];
		
		$strSQLSM="select * from pagos where referencia='".$codDocRef."' ";
		$resultadoMS=mysql_query($strSQLSM,$cn);
		while($rowR=mysql_fetch_array($resultadoMS)){
		
			
		 	if($row['moneda']!=$rowR['moneda']){
		       if($rowR['moneda']=='02'){
			   $montoParcial=$rowR['monto']*$rowR['tcambio'];
			   }else{
			   $montoParcial=$rowR['monto']/$rowR['tcambio'];
			   }
			}else{
			
				$montoParcial=$rowR['monto'];
			}
		
		
		$acuentaDocRef=$acuentaDocRef+$montoParcial;
		
		}   	
				
	
	
	}else{
	
		$strSQLSM="select * from pagos where referencia='".$row['cod_cab']."' ";
		$resultadoMS=mysql_query($strSQLSM,$cn);
		while($rowR=mysql_fetch_array($resultadoMS)){
		
		//$acuentaDocRef=$acuentaDocRef+$rowR['monto'];
		
			if($row['moneda']!=$rowR['moneda']){
		       if($rowR['moneda']=='02'){
			   $montoParcial=$rowR['monto']*$rowR['tcambio'];
			   }else{
			   $montoParcial=$rowR['monto']/$rowR['tcambio'];
			   }
			}else{
			
				$montoParcial=$rowR['monto'];
			}
		
		
		$acuentaDocRef=$acuentaDocRef+$montoParcial;
		
		
		
		}
	}


//----------------------------------------------------------------------------------
if ($AnRK<>'3' ){ 
$color_row="#FFFFFF";
}else{
$color_row="#CCCCCC";
}
?>


			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" ondblclick="doc_det(this)"  >
      <td width="24" align="center"><input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  
	   if($row['flag_r']=='RO'){
	    echo $codDocRef; 
	   }else{
	   echo $row['cod_cab'];
	   }
	  
	  
	  
	  ?>" /></td>
      <td width="20" align="center" class="texto1" >	  
	   <? if ($AnRK<>'3' ){ ?>
	   <input 
	   <? if ($acuentaDocRef > 0){ echo 'disabled';  } ?>
	   style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?php  echo $row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?>
	  <input type="hidden" name="tipformato" value="<?php echo $data ?>" />	  </td>
             <td width="102" class="texto1"><?php echo $row['fecha']?></td>	
			  <td width="68" align="center" class="texto1" ><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>	
              <td width="68" align="center" class="texto1" ><?php echo $serieRef.'-'.$numeroRef; ?></td>
              <td width="149" class="texto1"><?php echo utf8_encode($row['razonsocial'])?>
			  <? if ($AnRK<>'3' ){ ?>
              <input type="hidden" name="codprov" id="codprov" value="<?php echo $row['cliente'] ?>" />
			  <? } ?>
			  </td>
              <td width="26" align="center" class="texto1"><?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?>
			   
			  <? if ($AnRK<>'3' ){ ?>
              <input type="hidden" name="codMon" id="codMon" value="<?php echo $row['moneda'] ?>" />
			  <? } ?>
			   
      </td>
              <td width="57" align="right" class="texto1"><?php 
			  if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($row['total'],2);
	}
			  ?></td>
			  <td width="54" align="right" class="texto1">
			  <?php 
	
	
	
	 echo number_format($acuentaDocRef,2);
	
			   ?></td>			  
			  <td width="55" align="right" class="texto1"><?php $saldo=number_format($row['total']-$acuentaDocRef,2); if($saldo < 0) echo "0.00"; else echo $saldo;?></td>
			  <td width="67" align="center" class="texto1"><?php 
			  
			  if($saldo<=0) echo "Cancelado" ;else echo "No Cancelado"; 
			  
			  ?></td>	
			  
			  <td width="70" align="center" class="texto1"><?php 
			  
			   if($row['flag_r']=='RO') echo "Facturado"; else echo "LIBRE";
			  
			  ?></td>
    </tr>
  
  <?php }?>
</table>
</div>
		  
	<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargardatos($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargardatos($i)'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='cargardatos($pagina+1)'>Siguiente ></a>"; 
} 
    ?>
	 &nbsp;&nbsp;</font> 
	 <input type="hidden" name="pag" id="pag" value="<?php echo $pagina?>" />
	</td>
  </tr>
</table>
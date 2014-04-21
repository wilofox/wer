<?php 
session_start();
include('conex_inicial.php');
include('funciones/funciones.php');

		$tipomov=$_REQUEST['tipomov'];
		$empresa=$_REQUEST['empresa'];
		$tempCodVend=$_REQUEST['tempCodVend'];
				
		if(isset($_REQUEST['ot'])){
		$filtro1="  ";
		}else{
		$filtro1=" and codigo!='OT' ";
		}
		
		if($_SESSION['codvendedor']=='' || !isset($_SESSION['codvendedor']) ){
		$_SESSION['codvendedor']=$tempCodVend;
		}
		$usuario=$_SESSION['codvendedor'];
					
?>
			
			<select disabled="disabled" style="width:160" name="doc" id="doc"  onChange="cambiar_enfoque(this);" onFocus="enfocar_cbo(this);limpiar_enfoque(this);">
		  <option value="0"></option>
		  <?php 
		   $resultados10 = mysql_query("select operacion.*,docuser.*,operacion.cola as colaOp1,operacion.cola2 as colaOp2 from operacion,docuser where codigo=doc and tipo=tipomov  and codigo!='TS' ".$filtro1."  and tipo='".$tipomov."' and empresa='".$empresa."' and usuario='".$usuario."' group by codigo order by descripcion ",$cn); 
		    echo $resultados10;
			while($row10=mysql_fetch_array($resultados10))
			{
			
			$p1[]=substr($row10['p1'],0,1);
			$p2[]=substr($row10['p1'],1,1);
			$p3[]=substr($row10['p1'],2,1);
			$p4[]=substr($row10['p1'],3,1);
			$p5[]=substr($row10['p1'],4,1);
			$p6[]=substr($row10['p1'],5,1);
			$p7[]=substr($row10['p1'],6,1);
			$p8[]=substr($row10['p1'],7,1);
			$p9[]=substr($row10['p1'],8,1);
			$p10[]=substr($row10['p1'],9,1);
			$p11[]=substr($row10['p1'],10,1);
			$p12[]=substr($row10['p1'],11,1);
			$p13[]=substr($row10['p1'],12,1);
			$p14[]=substr($row10['p1'],13,1);
			$p15[]=substr($row10['p1'],14,1);
			$p16[]=substr($row10['p1'],15,1);
			$p17[]=substr($row10['p1'],16,1);
			$p18[]=substr($row10['p1'],17,1);
			$p19[]=substr($row10['p1'],18,1);
			
			$numauto[]=substr($row10['p1'],19,1);
			$descuentos[]=substr($row10['p1'],20,1);
			$mostrarOT[]=substr($row10['p1'],21,1);
			
			$p20[]=substr($row10['p1'],25,1);
			$modifdesc[]=substr($row10['p1'],26,1);
			$puntos[]=substr($row10['p1'],27,1);
			$envases[]=substr($row10['p1'],28,1);
			$chkElemProd[]=substr($row10['p1'],29,1);
			
			
			$p1_cod[]=$row10['codigo'];
			$nitems[]=$row10['nitems'];
			$serie[]=$row10['serie'];
			$numero_ini[]=$row10['numero_ini'];
			$numero_fin[]=$row10['numero_fin'];
			$impresion[]=$row10['impresion'];
			$formato[]=$row10['formato'];
			$kardex_doc[]=$row10['kardex'];
			$impuesto1[]=$row10['imp1'];
			$min_percep[]=$row10['min_percep'];
			$moneda[]=$row10['moneda'];
			$predefecto[]=$row10['predefecto'];
			$cola1[]=$row10['colaOp1'];
			$cola2[]=$row10['colaOp2'];
			$tipoDesc[]=$row10['tipoDesc'];
			$ElemProd[]=$row10['elemProd'];			
			$accionDoc[]=$row10['impresion'];
			$modifPrecio[]=substr($row10['p1'],24,1);
			$sunatdoc[]=$row10['sunat'];
					
				
		  ?>
            <option value="<?php echo $row10['codigo']?>"><?php echo caracteres($row10['descripcion'])?></option>
			
			<?php }?>
          </select>
		  
		  <?php 
		  
		  function php2js ($var) {

			if (is_array($var)) {
				$res = "[";
				$array = array();
				foreach ($var as $a_var) {
					$array[] = php2js($a_var);
				}
				//return "[" . join(",", $array) . "]";
				return "" . join(",", $array) . "";
				
			}
			elseif (is_bool($var)) {
				return $var ? "true" : "false";
			}
			elseif (is_int($var) || is_integer($var) || is_double($var) || is_float($var)) {
				return $var;
			}
			elseif (is_string($var)) {
			
						
				//return "\"" . addslashes(stripslashes($var)) . "\"";
				  return "" . addslashes(stripslashes($var)) . "";	
			}
		
			return FALSE;
		}

			$js1 = php2js($p1); 
			$js2 = php2js($p2); 
			$js3 = php2js($p3); 
			$js4 = php2js($p4); 
			$js5 = php2js($p5); 
			$js6 = php2js($p6); 
			$js7 = php2js($p7); 
			$js8 = php2js($p8); 
			$js9 = php2js($p9); 
			$js10 = php2js($p10); 
			$js11 = php2js($p11); 
						
			$js_cod = php2js($p1_cod); 
			$js_nitems = php2js($nitems);
			$js_serie = php2js($serie);
			$js_numero_ini = php2js($numero_ini);
			$js_numero_fin = php2js($numero_fin);
			$js_impresion = php2js($impresion);
			$js_formato = php2js($formato);
			$js_kardex_doc = php2js($kardex_doc);
			$js_impuesto1 = php2js($impuesto1);
			$js_min_percep = php2js($min_percep);
			$js_moneda = php2js($moneda);
			$js_predefecto = php2js($predefecto);
			$js_cola1 = php2js($cola1);
			$js_cola2 = php2js($cola2);
						
			$js12 = php2js($p12); 
			$js13 = php2js($p13); 
			$js14 = php2js($p14);
			$js15 = php2js($p15);
			$js16 = php2js($p16);
			$js17 = php2js($p17); 
			$js18 = php2js($p18);
			$js19 = php2js($p19);
			$js20 = php2js($p20);  
			
			$jsnumauto = php2js($numauto);
			$jsdescuentos = php2js($descuentos);
			$jsmostrarOT = php2js($mostrarOT);
						
			$jsmodifdesc=php2js($modifdesc);
			$jspuntos=php2js($puntos);
			$jsenvases=php2js($envases);
			$jstipoDesc=php2js($tipoDesc);
			$jschkElemProd=php2js($chkElemProd);
			$jsElemProd=php2js($ElemProd);	
			$jsaccionDoc=php2js($accionDoc);
			$jsmodifPrecio=php2js($modifPrecio);
			$jssunatdoc=php2js($sunatdoc);
					
						
			echo "?".$js1."?".$js2."?".$js3."?".$js4."?".$js5."?".$js6."?".$js7."?".$js8."?".$js9."?".$js10."?".$js11."?".$js_cod."?".$js_nitems."?".$js_serie."?".$js_numero_ini."?".$js_numero_fin."?".$js_impresion."?".$js_formato."?".$js_kardex_doc."?".$js_impuesto1."?".$js12."?".$js13."?".$js14."?".$js_min_percep."?".$js15."?".$js_moneda."?".$js16."?".$js17."?".$js18."?".$js_predefecto."?".$js_cola1."?".$js_cola2."?".$js19."?".$jsnumauto."?".$jsdescuentos."?".$jsmostrarOT."?".$js20."?".$jsmodifdesc."?".$jspuntos."?".$jsenvases."?".$jstipoDesc."?".$jschkElemProd."?".$jsElemProd."?".$jsaccionDoc."?".$jsmodifPrecio."?".$jssunatdoc."?";						
		   ?>
		  	  
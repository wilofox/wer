<?php 


function caracteres($text){
  // this function will intially be used to implement underlining support, but could be used for a range of other
  // purposes
  $search = array('á','é','í','ó','ú');
  $replace = array('&#225;','&#233;','&#237;','&#243;','&#250;');
  return str_replace($search,$replace,$text);
}
function mostrar_resultado($tipo,$cadena){
$result=mysql_query("select codcliente,razonsocial,ruc,t_persona from cliente where tipo_aux='".$tipo."' and razonsocial like '%".$cadena."%'");
echo '<div id="resultado" style="width:465px; height:120px; overflow-y:scroll" >';
echo "<table border='0' >";
while($dat=mysql_fetch_row($result)){
echo "<tr><td width='70'>$dat[0]</td><td>$dat[1]</td><td width='70'>$dat[2]</td><td width='40' align='center'>$dat[3]</td></tr>";
}
echo "</table></div>";
}
?>

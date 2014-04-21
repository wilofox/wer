function enviar_a_pdf(){
var sucursal=document.form1.sucursal.value;
var almacen= document.form1.almacen.value;
$("#name_empresa").val($("#sucursal option:selected").text());
$("#empresa_recuperada").val(sucursal);
$("#tienda_recuperada").val(almacen);
$("#form1").submit();
}
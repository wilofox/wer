<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Código de barras</title>
</head>
<body>

<!--
 Este ejemplo ha sido descargado de Internet, no es de mi creación, unicamente
 lo publico para que este al alcance de todos
-->

<form action="" method="post">
    Ingrese el Codigo para crear el código de barras:
    <input name="numero" type="text" style="background-color:#CCF"/>
    <input type="submit" value="Enviar" />
</form>

<?php
if(isset($_POST["numero"]) )
{
    //Mostramos la imagen
    echo "<img src='codigoBarras_img.php?numero=".$_POST["numero"]."'>";
}
?>

</body>
</html>

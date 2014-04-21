<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Valida fechas</title>
 
</head>
<body>
<?php
//Si estamos validando
if (isset($_POST["dia"]) && isset($_POST["mes"]) && isset($_POST["anio"]))
    if ($_POST["dia"]<>"" && $_POST["mes"]<>"" && $_POST["anio"]<>"")
    {
    $correcto=TRUE;
    if (checkdate($_POST["mes"],$_POST["dia"],$_POST["anio"]))
        echo "<p>El día, mes y año son <b>Correctos</b></p>";
    else
        {
        echo "El día, mes o el año son <b>incorrectos</b>, por favor reviselo</p>";
        $correcto=FALSE;
        }
 
    if (isset($_POST["hora"]))
        if (($_POST["hora"]<=23)&&($_POST["hora"]>=0))
            echo "<p>La hora introducida en <b>Correcta</b>";
        else
            {
            echo "<p>La hora introducida en <b>Incorrecta</b>, por favor reviselo";
            $correcto=FALSE;
            }
    if (isset($_POST["minutos"]))
        if (($_POST["minutos"]<=59)&&($_POST["minutos"]>=0))
            echo "<p>Los minutos introducidos son <b>Correctos</b>";
        else
            {
            echo "<p>Los minutos introducidos son <b>Incorrectos</b>, por favor reviselo";
            $correcto=FALSE;
            }
    if (isset($_POST["segundos"]))
        if (($_POST["segundos"]<=59)&&($_POST["segundos"]>=0))
            echo "<p>Los segundos introducidos son <b>Correctos</b>";
        else
            {
            echo "<p>Los segundos introducidos son <b>Incorrectos</b>, por favor reviselo";
            $correcto=FALSE;
            }
    if ($correcto)
                {
        echo "<p>Todo ha sido correcto, si quiere puede hacer modificaciones</p>";
        echo "<p>Si lo desea puede <a href=\"validar.php\">volver</a> al principio o modificar los datos</p>";
                }
    if (!$correcto)
        echo "<p><b>No ha sido correcto, por favor modifique los datos incorrectos</b></p>";
    }
    else
        echo "<p><b>Atención!!!</b> Debe introducir algo al menos en <b>día mes y año</b></p>";
//Si tenenemos errores o es la primera vez deberemos volver a validar
?>
<form action="validar.php" method="POST">
<fieldset>
<legend>Validación de fechas</legend>
<ol>
<li>
<label for="dia">Día</label>
<input id="dia" name="dia" type="number" size="2" maxlength="2" min="1" max="31" value="<?php echo $_POST['dia'];?>" required autofocus/>
</li>
<li>
<label for="mes">Mes</label>
<input id="mes" name="mes" type="number" size="2" maxlength="2" min="1" max="12" value="<?php echo $_POST['mes'];?>" required/>
</li>
<li>
<label for="anio">Año</label>
<input id="anio" name="anio" type="number" size="4" maxlength="4" min="1900" max="3500" value="<?php echo $_POST['anio'];?>" required/>
</li>
<li>
<label for="hora">Hora</label>
<input id="hora" name="hora" type="number" size="2" maxlength="2" min="00" max="23" value="<?php echo $_POST['hora'];?>" required/>
</li>
<li>
<label for="minutos">Minutos</label>
<input id="minutos" name="minutos" type="number" size="2" maxlength="2" min="00" max="59" value="<?php echo $_POST['minutos'];?>" required/>
</li>
<li>
<label for="segundos">Segundos</label>
<input id="segundos" name="segundos" type="number" size="2" maxlength="2" min="00" max="59" value="<?php echo $_POST['segundos'];?>" required/>
</li>
</ol>
</fieldset>
<button type="submit">validar</button>
</form>
</body>
</html>
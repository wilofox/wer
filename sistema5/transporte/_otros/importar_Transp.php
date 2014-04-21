<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body><?php
$target_path = "/home/vol1/example.us/a/ayush/www/virtual/closing/";

$target_path = $target_path . basename( $_FILES['file']['name']);

if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
echo "The file ". basename( $_FILES['file']['name']). " has been uploaded";

include ('mysql.php');
require_once 'reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$data->read('data.xls');
error_reporting(E_ALL ^ E_NOTICE);

for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
{

$closing = $data->sheets[0]['cells'][$i][2];

$sql = "UPDATE listedcomp SET closing = '$closing';";
if (mysql_query($sql)) {
echo "Done";
} else {
mysql_error();
}}

} else{
//echo "There was an error". $_FILES['file']['error']." uploading the file, please try again!";
echo "Hubo un error al cargar el archivo ". $_FILES['file']['error'].", por favor intente de nuevo!";
}?> 

<?
/*echo $_REQUEST['SUBMIT'];
    if(isset($_POST['SUBMIT']))
    {
         $fname = $_FILES['sel_file']['name'];
        
         $chk_ext = explode(".",$fname);
        
         if(strtolower($chk_ext[1]) == "csv")
         {
        
             $filename = $_FILES['sel_file']['tmp_name'];
             $handle = fopen($filename, "r");
       
             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
             {
                $sql = "INSERT into user(name,email,phone) values('$data[0]','$data[1]','$data[2]')";
                mysql_query($sql) or die(mysql_error());
             }
       
             fclose($handle);
             echo "Successfully Imported";
         }
         else
         {
             echo "Invalid File";
         }   
    }*/
?>
    <form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post'>

        importación de archivos : <input type='text' name='sel_file' size='20'>
		<input type="file" name='file' size='20'/>
        <input type='submit' name='submit' value='submit'>

    </form>
</body>
</html>

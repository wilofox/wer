<?php
session_start();
class Quick_CSV_import
{
  var $table_name; //where to import to
  var $file_name;  //where to import from
  var $use_csv_header; //use first line of file OR generated columns names
  var $field_separate_char; //character to separate fields
  var $field_enclose_char; //character to enclose fields, which contain separator char into content
  var $field_escape_char;  //char to escape special symbols
  var $error; //error message
  var $msg; //error message
  var $arr_csv_columns; //array of columns
  var $table_exists; //flag: does table for import exist
  var $encoding; //encoding table, used to parse the incoming file. Added in 1.5 version
  
  function Quick_CSV_import($file_name="")
  {
    $this->file_name = $file_name;
    $this->arr_csv_columns = array();
    $this->use_csv_header = true;
    $this->field_separate_char = ",";
    $this->field_enclose_char  = "\"";
    $this->field_escape_char   = "\\";
    $this->table_exists = false;
  }
  
  function import()
  {
    if($this->table_name=="")
      //$this->table_name = "temp_".date("d_m_Y_H_i_s");
	  $this->table_name = "mashist_temp"; //  -- master_historial
    
    $this->table_exists = false;
    $this->create_import_table();
    
    if(empty($this->arr_csv_columns))
      $this->get_csv_header_fields();
    
    /* change start. Added in 1.5 version */
    if("" != $this->encoding && "default" != $this->encoding)
      $this->set_encoding();
    /* change end */
    
    if($this->table_exists)
    {
     	/*$sql = "LOAD DATA INFILE '".@mysql_escape_string($this->file_name).
             "' INTO TABLE `".$this->table_name.
             "` FIELDS TERMINATED BY '".@mysql_escape_string($this->field_separate_char).
             "' OPTIONALLY ENCLOSED BY '".@mysql_escape_string($this->field_enclose_char).
             "' ESCAPED BY '".@mysql_escape_string($this->field_escape_char).
             "' ".
             ($this->use_csv_header ? " IGNORE 1 LINES " : "")
			 ."(cod_trans,fec_hor_des,fec_turno,ruc,cod_ope,Num_serdoc,placa,surtidor,cara,lectura_ini,lectura_fin,prec_m3,cant_m3,condicion,descuento,incremento,recaudo,total)";
			 //."(`".implode("`,`", $this->arr_csv_columns)."`)";
	  $res = @mysql_query($sql);    
	  $this->error = mysql_error();	*/   
	    $row = 1;
	    $handle = fopen ($this->file_name, 'r');
		while (($data = fgetcsv($handle, 10*1024,$this->field_separate_char, '"')) !== FALSE)
		{	
		
//echo $data[1];
$_SESSION['docExcel']=$data[2];		
if ($data[0]=='0'){

			// validar fecha 1
			$fecha=$data[1];
			$fechoF=explode("-", substr($fecha,0,10) );
			$fechoH=explode(":", substr($fecha,12,20) );
			$fechoVal=validar($fechoF[2],$fechoF[1],$fechoF[0],$fechoH[0],$fechoH[1]); //,$fechoH[2]
			if ($fechoVal==''){
				$this->msg ="<hr/>Formato fecha1 es incorrecto!! (yyyy-mm-dd hh:mm:ss) ";
				return false;
			}// validar fecha 2
			$fecha=$data[2];
			$fechoF=explode("-", substr($fecha,0,10) );
			$fechoH=explode(":", substr($fecha,12,20) );
			$fechoVal=validar($fechoF[2],$fechoF[1],$fechoF[0],$fechoH[0],$fechoH[1]); //,$fechoH[2]
			if ($fechoVal==''){
				$this->msg ="<hr/>Formato fecha2 es incorrecto!!. El formato correcto es (yyyy-mm-dd hh:mm:ss) ";
				return false;
			}
			// validar Doumento duplicados
			$strSQLVal = " select * from master_historial where cod_ope ='".$data[4]."' 
			and Num_serdoc='".$data[5]."'  ";			
			$resulval = @mysql_query($strSQLVal);
			$rowV = @mysql_fetch_array($resulval);
			$totalval =mysql_num_rows($resulval); 
			if ($totalval>0){
				$this->msg ="<hr/>La archivo Excel(*.CSV) ''".formatofecha(substr($_SESSION['docExcel'],0,10))."'' ya ha sido importado!!";//( ".$data[4].' '.$data[5]." )
				return false;
			}
}
			//insertar dats		
			$sql = "INSERT INTO ".$this->table_name." VALUES ('". implode("','", $data) ."')";
			$res = @mysql_query($sql);
			$this->error = mysql_error();	
		}

    }
  }
  
  //returns array of CSV file columns
  function get_csv_header_fields()
  {
    $this->arr_csv_columns = array();
    $fpointer = fopen($this->file_name, "r");
    if ($fpointer)
    {
      $arr = fgetcsv($fpointer, 10*1024, $this->field_separate_char);
      if(is_array($arr) && !empty($arr))
      {
        if($this->use_csv_header)
        {
          foreach($arr as $val)
            if(trim($val)!="")
              $this->arr_csv_columns[] = $val;
        }
        else
        {
          $i = 1;
          foreach($arr as $val)
            if(trim($val)!="")
              $this->arr_csv_columns[] = "column".$i++;
        }
      }
      unset($arr);
      fclose($fpointer);
    }
    else
      $this->error = "archivo no se puede abrir: ".(""==$this->file_name ? "[empty]" : @mysql_escape_string($this->file_name));
    return $this->arr_csv_columns;
  }
  
  function create_import_table()
  {
    $sql = "CREATE TABLE IF NOT EXISTS ".$this->table_name." (";
    
    if(empty($this->arr_csv_columns))
      $this->get_csv_header_fields();
    
    if(!empty($this->arr_csv_columns))
    {
      $arr = array();
      for($i=0; $i<sizeof($this->arr_csv_columns); $i++)
          $arr[] = "`".$this->arr_csv_columns[$i]."` TEXT";
      $sql .= implode(",", $arr);
      $sql .= ")";
      $res = @mysql_query($sql);
      $this->error = mysql_error();
      $this->table_exists = ""==mysql_error();
    }
  }
  
  /* change start. Added in 1.5 version */
  //returns recordset with all encoding tables names, supported by your database
  function get_encodings()
  {
    $rez = array();
    $sql = "SHOW CHARACTER SET";
    $res = @mysql_query($sql);
    if(mysql_num_rows($res) > 0)
    {
      while ($row = mysql_fetch_assoc ($res))
      {
        $rez[$row["Charset"]] = ("" != $row["Description"] ? $row["Description"] : $row["Charset"]); //some MySQL databases return empty Description field
      }
    }	
    return $rez;	
  }
  
  //defines the encoding of the server to parse to file
  function set_encoding($encoding="")
  {
    if("" == $encoding)
      $encoding = $this->encoding;
    $sql = "SET SESSION character_set_database = " . $encoding; //'character_set_database' MySQL server variable is [also] to parse file with rigth encoding
    $res = @mysql_query($sql);
    return mysql_error();
  }
  /* change end */

}

function validar ($dia,$mes,$anio,$hora,$minutos){ //,$segundos
    if (!checkdate($mes,$dia,$anio))
        return FALSE;
    elseif (!(($hora<=23)&&($hora>=0)))
        return FALSE;
    elseif (!(($minutos<=59)&&($minutos>=0)))
        return FALSE;
    elseif (!(($segundos<=59)&&($minutos>=0)))
        return FALSE;
    return TRUE;
}
?>
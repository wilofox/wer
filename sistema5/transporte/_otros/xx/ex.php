<?


include("pobs-ini.inc.php");


echo "<HTML><HEAD><TITLE>POBS - A PHP Obfuscator</TITLE><STYLE TYPE='text/css'>";echo "td { font-family: Verdana, sans serif;font-size:".$V24b02965."pt;  vertical-align: top; }";echo "</STYLE></HEAD><BODY>";


define("C00529ab2", "<TD VALIGN=TOP>");define("C4d89b09c", "<TD BGCOLOR=#6699CC VALIGN=TOP>");define("C5481f31d", "<TD BGCOLOR=#E6E6E6 VALIGN=TOP>");define("C9c3b8e37", "<TR>");define("Cd742068d", "</TR>");define("Cdabce349", "</TD>");define("C6faee0d5", "</TABLE>");


if ($PA) F85580fcb();


$V9429cf94=time();


$Vf797b56c=0;$V048f0047=0;


$Vbc961c59=array();$Vb787292f=array();$V4cb73b6b=array();$Vae809e1a=array();


$V4a949e17=array();$Va7254761=array();$Vd74f666d=array();


if ($PA) F23da1c4c();else Fb72cca71();


function F23da1c4c() {global $V0e475c03, $V9b131e1e;if (!(is_readable($V0e475c03))) {echo "Error. Source Directory ".$V0e475c03." is not readable. Program will terminate<br>";exit;}if (!(is_writeable($V9b131e1e))) {echo "Error. Target Directory ".$V9b131e1e." is not writeable. Program will terminate<br>";exit;}F69b1473d();Fcecc24ab();F8eceda2a();F001878fb();}


function Fb72cca71() {global $V5c642867, $V1e5309c7, $V9b131e1e, $V0e475c03, $Veb1e1b83, $V7620b171, $V43225a8d;global $V29eb2c69, $V0981e6bd, $V00960abb, $Va7a918c1, $V4dd4189a, $Vcb30d890;global $V3164646b;echo "<TABLE CELLPADDING=0 WIDTH=100% CELLSPACING=0 BORDER=0>";echo C9c3b8e37.C4d89b09c."<A HREF='http://pobs.mywalhalla.net' TARGET=_new><IMG SRC=pobslogo.gif HSPACE=20 WIDTH=150 HEIGHT=61 BORDER=0></A>".Cdabce349;echo C4d89b09c."<br><b>A PHP Obfuscator<br>Version 0.91".Cdabce349.Cd742068d.C6faee0d5;


F85580fcb();


echo "<TABLE CELLPADDING=3 WIDTH=100% CELLSPACING=0 BORDER=1>";echo C9c3b8e37.C4d89b09c." <CENTER><DIV style="font-size:13pt;"><b>Settings</DIV></CENTER>".Cdabce349.Cd742068d."<br>";echo C9c3b8e37.C00529ab2." <CENTER>For the most up-to-date documentation, visit <A HREF='http://pobs.mywalhalla.net' TARGET=STD>http://pobs.mywalhalla.net</A></CENTER>".Cdabce349.Cd742068d.C6faee0d5."<br>";


echo "<TABLE CELLPADDING=3 WIDTH=100% CELLSPACING=0 BORDER=0>";echo C9c3b8e37."<TD VALIGN=TOP ROWSPAN=2>";


echo "<TABLE CELLPADDING=3 WIDTH=100% CELLSPACING=0 BORDER=1>";echo C9c3b8e37.C5481f31d." TimeOut (sec)".Cdabce349.Cd742068d;echo C9c3b8e37.C00529ab2.$V5c642867.Cdabce349.Cd742068d;


echo C9c3b8e37.C5481f31d." Source Directory".Cdabce349.Cd742068d;echo C9c3b8e37.C00529ab2.$V0e475c03.Cdabce349.Cd742068d;echo C9c3b8e37.C5481f31d." Target Directory".Cdabce349.Cd742068d;echo C9c3b8e37.C00529ab2.$V9b131e1e.Cdabce349.Cd742068d;


echo C9c3b8e37.C5481f31d." Allowed File Extensions".Cdabce349.Cd742068d;echo C9c3b8e37.C00529ab2;foreach($V1e5309c7 as $V89735695 => $V68920240 ) echo $V68920240."<br>";echo Cdabce349.Cd742068d;


echo C9c3b8e37.C5481f31d." Replacements".Cdabce349.Cd742068d;echo C9c3b8e37.C00529ab2." Functions: ".F9856a771($V29eb2c69)."<br>";echo " Constants: ".F9856a771($V0981e6bd)."<br>";echo " Variables: ".F9856a771($V00960abb)."<br>";echo Cdabce349.Cd742068d;


echo C9c3b8e37.C5481f31d." Removals".Cdabce349.Cd742068d;echo C9c3b8e37.C00529ab2;echo " Comments: ".F9856a771($Va7a918c1)."<br>";echo " Indents: ".F9856a771($V4dd4189a)."<br>";echo " Returns: ".F9856a771($Vcb30d890)."<br>";echo Cdabce349.Cd742068d;


echo C9c3b8e37.C5481f31d;echo "<FORM METHOD=POST ACTION="".$GLOBALS[PHP_SELF]."?PA=P">";echo "<INPUT TYPE=CHECKBOX NAME=Vfd4668cc CHECKED>Replace edited files only<br>";echo "<INPUT TYPE=SUBMIT NAME=Ok VALUE='Start scanning and replacing'>";echo "</FORM>";echo Cdabce349.Cd742068d;


echo C6faee0d5;


echo Cdabce349;echo C00529ab2;


echo "<TABLE CELLPADDING=3 WIDTH=100% CELLSPACING=0 BORDER=1>";echo C5481f31d." Exclude Functions".Cdabce349.Cd742068d;echo C9c3b8e37.C00529ab2;foreach($Veb1e1b83 as $V89735695 => $V68920240 ) { echo $V89735695.": ".$V68920240."<br>"; }echo Cdabce349.Cd742068d;


echo C5481f31d." Exclude Constants".Cdabce349.Cd742068d;echo C9c3b8e37.C00529ab2;foreach($V43225a8d as $V89735695 => $V68920240 ) { echo $V89735695.": ".$V68920240."<br>"; }echo Cdabce349.Cd742068d;


echo C5481f31d." Selected files to be replaced".Cdabce349.Cd742068d;echo C9c3b8e37.C00529ab2;if (sizeof($V3164646b)) {foreach($V3164646b as $V89735695 => $V68920240 ) { echo $V89735695.": ".$V68920240."<br>"; }} else echo "All scanned files";echo Cdabce349.Cd742068d;


echo C6faee0d5;


echo Cdabce349;echo C00529ab2;


echo "<TABLE CELLPADDING=3 WIDTH=100% CELLSPACING=0 BORDER=1>";echo C5481f31d." Exclude Variables".Cdabce349.Cd742068d;echo C9c3b8e37.C00529ab2;foreach($V7620b171 as $V89735695 => $V68920240 ) { echo $V89735695.": ".$V68920240."<br>"; }echo Cdabce349.Cd742068d;echo C6faee0d5;


echo Cdabce349;echo Cd742068d.C6faee0d5;


}


function F9856a771($V68920240) {if ($V68920240==FALSE) return "<FONT COLOR=Red>No</FONT>";else return "<FONT COLOR=green>Yes</FONT>";}


function F69b1473d() {


global $V7620b171, $Vd74f666d;foreach( $V7620b171 as $V89735695 => $V68920240 ) {$V5e0bdcbd=strrpos($V68920240, "*");if ($V5e0bdcbd!==FALSE) {echo "WildCardValue:".$V68920240."<br>";array_push($Vd74f666d, str_replace("*", "", $V68920240));$V7620b171[$V89735695]="Niets".$V89735695;}}}


function Fcecc24ab() {global $Vbc961c59, $Vb787292f, $V4cb73b6b, $Vae809e1a, $V4a949e17, $Va7254761;global $V0e475c03, $V1e5309c7, $V00960abb;global $V7620b171, $Vd74f666d, $Veb1e1b83, $V43225a8d;$V73600783=dir($V0e475c03);while($Ve1341437=$V73600783->read()) {if (is_file($V0e475c03."/".$Ve1341437)) {


$V56e6ddd1=substr($Ve1341437,(strrpos($Ve1341437, ".")+1));if (in_array($V56e6ddd1, $V1e5309c7) and sizeof($Va7254761) < 400) {


echo "Scanning Filename:".$Ve1341437."<br>";array_push ($Va7254761, $Ve1341437);$V4a949e17=file($V0e475c03."/".$Ve1341437);flush();for ($Vae146d64=0; $Vae146d64<sizeof($V4a949e17); $Vae146d64++) {$V4803e6b9=trim(strtolower($V4a949e17[$Vae146d64]));if (substr($V4803e6b9, 0, 9)=="function ") {$V3d47dd83=strpos($V4803e6b9, "(");$V7181d094=substr(trim($V4a949e17[$Vae146d64]), 0, $V3d47dd83);$V7181d094=trim(str_replace("function ", "", $V7181d094));if (!($Vb787292f[$V7181d094]) and !(in_array($V7181d094,$Veb1e1b83))) $Vb787292f[$V7181d094]="F".substr(md5($V7181d094), 0,8);$Vc74d460b++;} elseif (substr($V4803e6b9, 0, 6)=="define") {$Vcc5bcbcf=strpos($V4803e6b9, "(");$V2a54f74e=strpos($V4803e6b9, ",");$V509d3cbc=substr(trim($V4a949e17[$Vae146d64]), ($Vcc5bcbcf+1), ($V2a54f74e-$Vcc5bcbcf-1));$V509d3cbc=str_replace('"',"",$V509d3cbc);$V1638d396=strpos($V509d3cbc, "$");if ($V1638d396===FALSE) {if (!($V4cb73b6b[$V509d3cbc]) and !(in_array($V509d3cbc,$V43225a8d))) {$V4cb73b6b[$V509d3cbc]="C".substr(md5($V509d3cbc), 0,8);}}}if ($V00960abb) F89e1b8ff($V4a949e17[$Vae146d64]);}}}}$V73600783->close();


asort ($Vb787292f);asort ($V4cb73b6b);sort ($Va7254761);}


function F8eceda2a() {global $Vb787292f, $Vae809e1a, $V4cb73b6b, $Va7254761, $V7620b171, $Vd74f666d, $Vc74d460b;


Ff5e16527($Vb787292f, "Found functions that will be replaced", $V67435345="FFF0D0");Ff5e16527($V4cb73b6b, "Found constants that will be replaced", $V67435345="8DCFF4");$V0f3f9054=$Vae809e1a;ksort ($V0f3f9054);Ff5e16527($V0f3f9054, "Found variables that will be replaced", $V67435345="89CA9D");Ff5e16527($V7620b171, "User Defined Exclude Variables", $V67435345="BFBFBF");Ff5e16527($Va7254761, "Scanned Files", $V67435345="EA6B48");


echo "<br><br>Number of userdefined elements to be replaced<br>";echo "Functions:".sizeof($Vb787292f)."<br>";echo "Variables:".sizeof($Vae809e1a)."<br>";echo "Constants:".sizeof($V4cb73b6b)."<br>";echo "<br>Scanned Files:".sizeof($Va7254761)."<br>";}


function F001878fb() {global $V3164646b, $Va7254761, $V9429cf94, $Vf797b56c, $V048f0047;global $Vfd4668cc, $V0e475c03, $V9b131e1e;echo "**** START REPLACING AND WRITE THE TARGET FILES ***** <br>";foreach( $Va7254761 as $V89735695 => $V1e621df3) {if ($Vfd4668cc) {$Vac986feb=$V0e475c03."/".$V1e621df3;$V693ed254=$V9b131e1e."/".$V1e621df3;if (file_exists($V693ed254)) {$Vb9b17830=stat($V693ed254);$V3286ee11=$Vb9b17830[9];$Vb9b17830=stat($Vac986feb);$V4c83e27b=$Vb9b17830[9];if ($V4c83e27b>$V3286ee11) $V0e3f6b26=TRUE;else $V0e3f6b26=FALSE;} else $V0e3f6b26=TRUE;} else $V0e3f6b26=TRUE;if ($V0e3f6b26) {$Vae9e0e69=time();echo "<FONT COLOR=red>Replaced ".$V1e621df3." Nr:".($V89735695+1)." of ".sizeof($Va7254761);F834dd2b5($V1e621df3);echo " - Elapsed Time: ".(time()-$Vae9e0e69)." sec.</FONT><br>";} else echo "<FONT COLOR=green>".$V1e621df3.": sourcefile older than targetfile. Not replaced</FONT><br>";flush();}


echo "Start Time: ".$V9429cf94."<br>";echo "Finish Time: ".time()."<br>";echo "Elapsed Time: ".(time()-$V9429cf94)." sec<br>";


echo "Total FileSize of parsed Files: ".$Vf797b56c ." Bytes <br>";echo "Total FileSize of written Files: ".$V048f0047 ." Bytes <br>";}


function F89e1b8ff($V4803e6b9) {global $Vae809e1a, $V840b8ea0, $V7620b171, $Vd74f666d;while (ereg('$([0-9a-zA-Z_]*)', $V4803e6b9, $V66373a9c)) {$V526ea0eb=$V66373a9c[1];if (!$Vae809e1a[$V526ea0eb] and !(in_array($V526ea0eb,$V840b8ea0)) and !(in_array($V526ea0eb,$V7620b171))) {


foreach( $Vd74f666d as $V89735695 => $V68920240 ) {if (substr($V526ea0eb, 0, strlen($V68920240))==$V68920240) {echo "Variable with name ".$V526ea0eb." added to list of variables to be excluded.<br>";array_push($V7620b171, $V526ea0eb);}}if (!(in_array($V526ea0eb,$V7620b171))) {$Vae809e1a[$V526ea0eb]="V".substr(md5($V526ea0eb), 0,8);}}$V5e0bdcbd=strpos($V4803e6b9, '$');$Vba2a9c6c=($V5e0bdcbd+strlen($V66373a9c[1]));$V4803e6b9=substr($V4803e6b9, (strpos($V4803e6b9,'$')+1));}}


function F834dd2b5($V1e621df3) {global $Vae809e1a,$Vb787292f, $V4cb73b6b, $V0e475c03, $V9b131e1e, $V00960abb;global $V0981e6bd, $V29eb2c69, $V4dd4189a, $Va7a918c1, $Vcb30d890;$Vac986feb=$V0e475c03."/".$V1e621df3;$V693ed254=$V9b131e1e."/".$V1e621df3;$V2adf924e=fopen($Vac986feb, "r");$V98bf7d8c=fread($V2adf924e, filesize($Vac986feb));$GLOBALS["Vf797b56c"]+=filesize($Vac986feb);echo " - Size:".filesize($Vac986feb);fclose ($V2adf924e);


if ($V29eb2c69) {foreach( $Vb787292f as $V89735695 => $V68920240 ) {$V98bf7d8c=ereg_replace("([^a-zA-Z0-9_])(".$V89735695.")[ 	]*(()","1".$V68920240."3", $V98bf7d8c);}}


if ($V00960abb) {foreach( $Vae809e1a as $V89735695 => $V68920240 ) {if (strpos($V98bf7d8c, $V89735695)!==FALSE) {$V98bf7d8c=ereg_replace('([ 	"']NAME=["']*)'.$V89735695.'([ 	"'>])','1'.$V68920240.'2', $V98bf7d8c);$V98bf7d8c=ereg_replace('$('.$V89735695.')([^0-9a-zA-Z_])','$'.$V68920240.'2', $V98bf7d8c);$V98bf7d8c=ereg_replace('&('.$V89735695.')([^0-9a-zA-Z_])','&'.$V68920240.'2', $V98bf7d8c);$V98bf7d8c=ereg_replace('->('.$V89735695.')([^0-9a-zA-Z_])','->'.$V68920240.'2', $V98bf7d8c);$V98bf7d8c=ereg_replace('($GLOBALS)([ 	]*)([)([ "'	]*)'.$V89735695.'([ "'	]{1,3})(])', '134'.$V68920240.'56',$V98bf7d8c);}}}


if ($V0981e6bd) {foreach( $V4cb73b6b as $V89735695 => $V68920240 ) {$V98bf7d8c=ereg_replace("([^a-zA-Z0-9_$])(".$V89735695.")([^a-zA-Z0-9_])","1".$V68920240."3", $V98bf7d8c);}}if ($V4dd4189a) {$V98bf7d8c=ereg_replace("[	 ]*", "", $V98bf7d8c);}if ($Va7a918c1) {$V98bf7d8c=ereg_replace("[	 ]{1,2}//[^]*", "", $V98bf7d8c);$V98bf7d8c=ereg_replace("[	 ]*//[^]*", "", $V98bf7d8c);}if ($Vcb30d890) {$V98bf7d8c=ereg_replace("([{};:])[ 	]*", "1", $V98bf7d8c);}$V98bf7d8c=ereg_replace("{2,20}", "", $V98bf7d8c);


$Vce55aa86=fopen($V693ed254, "w");$V809d8809=fwrite($Vce55aa86, $V98bf7d8c);fclose ($Vce55aa86);clearstatcache();$GLOBALS["V048f0047"]+=filesize($V693ed254);}


function Ff5e16527($Vd92ddbd1, $V5872d9a7="", $V67435345="FFF0D0") {global $Vf4c91239;echo "<br><br>".$V5872d9a7.":<br>";echo "<TABLE BORDER=1 BGCOLOR=#".$V67435345.">".C9c3b8e37;$V8464e43c=0;foreach( $Vd92ddbd1 as $V89735695 => $V68920240 ) {$V8464e43c++;echo C00529ab2.$V89735695."<br>".$V68920240.Cdabce349;if (($V8464e43c%$Vf4c91239)==0) echo Cd742068d.C9c3b8e37;}echo Cd742068d.C6faee0d5;flush();}


function F85580fcb() {global $V5c642867;$Vbe9942a7=strtolower(get_cfg_var("safe_mode"));if (!$Vbe9942a7) set_time_limit($V5c642867);else echo "<b><FONT COLOR=orange>Warning: SafeMode is on. Can not set timeout.</b></FONT><br>";}


?>


</BODY>


</HTML>
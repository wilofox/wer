<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Imprimiendo</title>
</head>


<script type="text/javascript" src="utilitarios/npProlyam.js"></script> 
<script type="text/javascript" src="utilitarios/jquery-1.4.4.js"></script> 

<script language="javascript">
	 var  objPlugin = new  npPlugin("plugin");
  
    function extract_link_href(aSourceHTML)
    {
        var regexp=/<link.*href\s*=\s*[\'\"]([^\"\']*)[\"\'][^>]*>/ig;
        var result;
        var sret="";
        while((result = regexp.exec(aSourceHTML)) != null) {
            sret+=result[1]+";";
        }
        return sret; 
    }

    function SaveHTML(url)
    {
        var url_links="";
        var alinks=new Array();
        var all_css =new Array();
        var s_url="";
        var all_html="";
       // alert(1);
        s_url=url;
        all_html="";
        if (s_url!=""){
                alert(s_url);
                $.ajax({
                  type: "GET",
                  async:false,    
                  dataType: "text/html",          
                  url: s_url,//alinks[link],
                  complete: function( res, status ) {
                        // If successful, inject the HTML into all the matched elements
                        if ( status === "success" || status === "notmodified" ) 
                        {
                          //alert(res.responseText);
                          all_html=res.responseText;
                        }
                        //alert(res.responseText);
                        //alert(22);
                    }
                });        
        }
        // alert(20);
        if (all_html==""){
            alert("error al recuperar html base.... pf verifique");
            return ;
         }   
         
         url_links= extract_link_href(all_html);
        alinks= url_links.split(";");
        for (var link in alinks )
        {
            var s_url=alinks[link];
            //alert(s_url);
            if (s_url!=""){
                $.ajax({
                  type: "GET",
                  async:false,    
                 // contentType='application/x-www-form-urlencoded',
                  dataType: "text/html",          
                  url: s_url,//alinks[link],
                  complete: function( res, status ) {
                        // If successful, inject the HTML into all the matched elements
                        if ( status === "success" || status === "notmodified" ) 
                        {
                          all_css[s_url]=res.responseText;
                          //alert(res.responseText);
                        }
                        //all_css+=res.responseText;
                    }
                });        
            }
        }
        //alert("1");  
        //alert(all_html);
        objPlugin.saveDataHTML(url,all_html, "html");
        for (var v in  all_css)
        {
            //alert(all_css[v]);
            objPlugin.saveDataHTML(v,all_css[v], "css");
        } 
    }    


    function PrintHTMLSample()
    {
	
	  //var cod_cab="<?php // echo $_REQUEST["cod_cab"] ?>";	
	  //var formato="<?php //echo $_REQUEST["formato"] ?>";
	  var url="<?php echo $_REQUEST['url']?>";
	  var impresora="<?php echo $_REQUEST["cola_imp"] ?>";
	  
	  //objPlugin.PrintHTML( url, document.getElementById("printer").value);
	  
	   var objCola=objPlugin.PrintHTML( url, impresora);
	   //alert(objCola);
	   
	   if(objCola=='OK'){
	   window.close();
	   }
	   
	   
	  // colocar la URL a imprimir
	  //SaveHTML(url)
      //objPlugin.PrintHTML(url,document.getElementById("printer").value);
	  
         
    }
	
	function iniciar(){
	objPlugin.getVersion();
		
	//alert(valor);
	}
	
	function isset(variable_name) {
			try {
			//alert(variable_name);
				 if (typeof(eval(variable_name)) != 'Object')
				 if (eval(variable_name) != null)
				 return true;
			 } catch(e) { }
			return false;
	}
		
		
	function cargarIni(){
	//alert();
	PrintHTMLSample()
	//document.getElementById('pc').innerHTML=objPlugin.getComputerName();
	//document.form1.usuario.focus();
	}	
			
</script>
<body  onload="javascript:cargarIni()">
 <!--[if IE]>
    <object CLASSID="CLSID:D59F4895-9DEE-471E-B176-6E7FC9E01130"  
            id="plugin" 
            type="application/prolyam-plugin"  
            width="200" 
            height="50"  
			 style="visibility:hidden"
			>
    </object>
    
    <![endif]-->
    <!--[if !IE]> <!-->
    <object id="plugin" 
            type="application/prolyam-plugin"  
            width="200" 
            height="50"
			 style="visibility:hidden"
			 >
    </object>
    <!--<![endif]-->
	
    <form id="form1" name="form1" method="post" action="">
	  <em><strong>Imprimiendo Colas</strong></em>
      <!--<input type="text" name="pruebas" id="pruebas" />-->
	  <?php echo $_REQUEST["cola_imp"] ?>;
    </form>
</body>
</html>

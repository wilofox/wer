<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
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
</script>


<body>

 <object CLASSID="CLSID:D59F4895-9DEE-471E-B176-6E7FC9E01130" 
			codebase="utilitarios/npProlyam.cab#version=1,0,0,1"            
			id="plugin"             
			type="application/prolyam-plugin"              
			width="100"             
			height="10"  
			style="visibility:hidden;"> 
			   
	</object>
sdhsdhsdfjhdfsj
</body>
</html>

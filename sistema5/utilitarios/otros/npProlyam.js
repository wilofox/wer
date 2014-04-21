function npPlugin(idElement) 
{
    function  getPath(fullPath)
    {
        var path = '';
        if (fullPath) {
            var startIndex = (fullPath.indexOf('\\') >= 0
                ? fullPath.lastIndexOf('\\')
                : fullPath.lastIndexOf('/'));
                
            if (startIndex>=0){     
                var path = fullPath.substring(0,startIndex+1);
            }
        }
        return path;
    }
       
    function createXMLHttpRequest ()
    {
        try { return new XMLHttpRequest(); } catch(e) {}
        try { return new ActiveXObject( 'Msxml2.XMLHTTP' ); } catch (e) {}
        try { return new ActiveXObject( 'Microsoft.XMLHTTP' ); } catch (e) {}
        return null;
    };
    
     var idElementGlobal= idElement;
     //alert("loading...");
     var getIEVersion= function () 
     { // or something like this
       var ua = window.navigator.userAgent;
       var msie = ua.indexOf("MSIE ");
       return ((msie > 0) ? parseInt(ua.substring(msie+5, ua.indexOf(".", msie))) : 0);
    }
    function loadElement(element,cadena) 
    {
        if(getIEVersion() != 0) { // this means we are in IE
            document.getElementById(element).innerHTML = cadena;
        } else {
           document.getElementById(element).innerHTML = cadena; 
        }
    }
    
    function checkStatus  ( xhr )
    {
        // HTTP Status Codes:
        //       2xx : Success
        //       304 : Not Modified
        //         0 : Returned when running locally (file://)
        //      1223 : IE may change 204 to 1223 (see http://dev.jquery.com/ticket/1450)
        return ( xhr.readyState == 4 &&
                        (       ( xhr.status >= 200 && xhr.status < 300 ) ||
                                xhr.status == 304 ||
                                xhr.status === 0 ||
                                xhr.status == 1223 ) );
    };
    function getResponseText( xhr )
    {
        if ( checkStatus( xhr ) )
                return xhr.responseText;
        return null;
    };
     function load ( url, callback, getResponseFn )
    {
            var async = !!callback;
            var xhr = createXMLHttpRequest();
            if ( !xhr )
                    return null;
            xhr.open( 'GET', url, async );
            if ( async )
            {
                    xhr.onreadystatechange = function()
                    {
                            if ( xhr.readyState == 4 )
                            {
                                    callback( getResponseFn( xhr ) );
                                    xhr = null;
                            }
                    };
            }
            xhr.send(null);
            return async ? '' : getResponseFn( xhr );
    };
    
    function loadSync   ( url, getResponseFn )
    {
            var async = false;
            var xhr = createXMLHttpRequest();
            if ( !xhr )
                    return null;
            xhr.open( 'GET', url, async );
            xhr.send(null);
            return async ? '' : getResponseFn( xhr );
    };
    this.getVersion = function ()
    {   
        //alert("1");
         var plugin=GetPluginObject();
         var ret="";
         //alert("2");
         if (plugin!=null)
            ret= plugin.FunctionValue('getVersion') ;
         //alert("3");   
         return ret;   
    }
    this.getMAC= function ()
    {
        var plugin=GetPluginObject();
        var ret="";
        if (plugin!=null)
            ret= plugin.FunctionValue('getMAC') ;  
         return ret;   
    }
    this.getSO=function()
    {
        var plugin=GetPluginObject();
        var ret="";
        if (plugin!=null)
            ret= plugin.FunctionValue('getSO') ;  
         return ret;   
    }
    this.getComputerName=function ()
    {
        var plugin=GetPluginObject();
        var ret="";
        if (plugin!=null)
            ret=plugin.FunctionValue('getComputerName') ;  
        return ret;    
    }
    this.getUserName=function()
    {
        var plugin=GetPluginObject();
        var ret="";
        if (plugin!=null)
            ret=plugin.FunctionValue('getUserName') ;
         return ret;           
    }
    this.getPrinters =function()
    {
        var plugin=GetPluginObject();
        var ret="";
        if (plugin!=null)
            ret= plugin.FunctionValue('getPrinters') ;
        return ret;    
    }
    this.getHDDSerial=function ()
    {
        var plugin=GetPluginObject();
        var ret="";
        if (plugin!=null)
            ret=plugin.FunctionValue('getHDDSerial') ;
        return ret;        
    }
    this.dlSaveHTML =function (url, data, type)
    {
        var plugin=GetPluginObject();
        var ret="";
        if (plugin!=null)
            return plugin.FunctionValue('dlFileSave',   url,   data,  type);
        return ret;      
    }
    this.dlPrintHTML =function (url, printname, parameters)
    {
        var plugin=GetPluginObject();
        var ret="";
		var size=0;
		
		var param_values= printname +"|" +parameters;
		//alert(param_values);	
        if (plugin!=null)
            return plugin.FunctionValue('dlHtmlPrint', url, param_values  );
        return ret;           
    }

    var obj_plugin=null;
    var obj_init  =false;
    function GetPluginObject ()
    {
        var obj;
        if (obj_plugin) return obj_plugin;
        obj = document.getElementById(idElementGlobal);
        if (obj){
            var version =obj.FunctionValue('getVersion');
            if (version!="") 
                obj_plugin=obj;
        } else
        {
            obj=obj_plugin;
        }
        if  (!obj_plugin) 
            alert("plugin no se ha instalado correctamente. Verifique"); 

        return obj_plugin;
    }    
    
    this.Init =function ()
	{
                     
 		var obj = GetPluginObject();
		obj_init = (obj != null);
        return obj_init;
   	}

 
    this.PrintHTML =function (url, printname, parameters)
    {
        var plugin=GetPluginObject();
        var ret="";
        if (plugin==null)
            return ret;

        if (this.SaveHTML(url))
        {
           ret=this.dlPrintHTML(url, printname, parameters);
        }     
        if  (ret!="OK")
           // alert(ret);
        return ret;    
    }
    
    this.SaveHTML =function (url)
    {
        var url_links="";
        var alinks=new Array();
        var all_css =new Array();
        var s_url="";
        var all_html="";
        var sPathHTML="";
        
        //alert("SaveHTML-start:"+url);
        s_url=url;
        all_html="";
        if (s_url!=""){
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
                    }
                });        
        }
        if (all_html==""){
            alert("Error en [nprolyam.js] al recuperar html pf verifique");
            return false;
         }   
        //alert("SaveHTML-loaded HTML base:"+all_html); 
        
        sPathHTML=getPath(s_url);
        
        //Extraer los links CSS a buffer de archivos
        var regexp=/<link.*href\s*=\s*[\'\"]([^\"\']*)[\"\'][^>]*>/ig;
        url_links ="";
        {
            var matched;
            while((matched = regexp.exec(all_html)) != null) {
                url_links += matched[1]+";";
            }
        }
        alinks= url_links.split(";");
        
        for (var link in alinks )
        {
            var s_url=alinks[link];
            //alert(s_url);
            if (s_url!=""){
                $.ajax({
                  type: "GET",
                  async:false,    
                  dataType: "text/html",          
                  url: sPathHTML+s_url,
                  complete: function( res, status ) {
                        if ( status === "success" || status === "notmodified" ) 
                        {
                          all_css[s_url]=res.responseText;
                          //alert("url:"+s_url +" "+res.responseText);
                        }
                    }
                });        
            }
        }
       //alert("SaveHTML-loaded css base:"+all_html); 
       
        //Embebed CSS files a  HTML
        all_html=all_html.replace(regexp,
                                    function(m, src)
                                    {
                                        //alert("p0:"+m+ " p1:"+src);
                                        //src="ejemplo/demo.css";
                                        var source="";
                                        if (all_css[src]!=undefined)
                                             source= "<style type=\"text/css\">\n"+
                                                     "/* CSS:["+src+"] OK */\n"+
                                                     all_css[src] +"\n"+
                                                     "</style>\n" ;
                                        else 
                                             source= "<style type=\"text/css\">\n"+
                                                     "/* CSS:["+src+"] NO FOUND */\n"+
                                                     "</style>\n" ;
                                        return source;     
                                    }
                                 );
        //alert("SaveHTML-2:"+all_html); 
        objPlugin.dlSaveHTML(url,all_html, "html");
       
        return true;    
    }    
   // alert("loading ok>");
};

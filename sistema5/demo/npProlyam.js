function npPlugin(idElement) 
{
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
    function createXMLHttpRequest ()
    {
        try { return new XMLHttpRequest(); } catch(e) {}
        try { return new ActiveXObject( 'Msxml2.XMLHTTP' ); } catch (e) {}
        try { return new ActiveXObject( 'Microsoft.XMLHTTP' ); } catch (e) {}
        return null;
    };
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
    function getResponseXml ( xhr )
    {
        if ( checkStatus( xhr ) )
        {
                var xml = xhr.responseXML;
                return new CKEDITOR.xml( xml && xml.firstChild ? xml : xhr.responseText );
        }
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
    this.extract_link_href   = function (aSourceHTML)
    {
        var regexp=/<link.*href\s*=\s*[\'\"]([^\"\']*)[\"\'][^>]*>/ig;
        var result;
        var sret="";
        while((result = regexp.exec(aSourceHTML)) != null) {
            sret+=result[1]+";";
        }
        return sret; 
    }
    
    this.saveDataHTML =function (url, data, type)
    {
        var plugin=GetPluginObject();
        var ret="";
        if (plugin!=null)
            return plugin.FunctionValue('dlFileSave',   url,   data,  type);
        return ret;      
    }
    this.PrintHTML =function (url, printname)
    {
        var plugin=GetPluginObject();
        var ret="";
        if (plugin!=null)
            return plugin.FunctionValue('dlHtmlPrint', url, printname  );
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
            alert("plugin no se ha instalado correctamente. verifique"); 

        return obj_plugin;
    }    
    
    this.Init =function ()
	{
        var splugin_ie= '<object id="plugin"                    '+
                        '    type="application/prolyam-plugin"  '+
                        '    width="10"                         '+
                        '    height="10" >                      '+
                        '</object>                              ';

        var splugin_ff= '<object id="plugin"                    '+
                        '    type="application/prolyam-plugin"  '+
                        '    width="10"                         '+
                        '    height="10" >                      '+
                        '</object>                              ';
                    
        if(getIEVersion() != 0) { // this means we are in IE
            document.getElementById(idElementGlobal).innerHTML = splugin_ie;
        } else {
           document.getElementById(idElementGlobal).innerHTML = splugin_ff; 
        }
		var obj = GetPluginObject();
		obj_init = (obj != null);
        return obj_init;
   	}
   // alert("loading ok>");
};

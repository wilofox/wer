<HTML>

<HEAD>
<TITLE>HTML Samples</TITLE>
<!--<link rel="stylesheet" type="text/css" href="demo.css"/>-->
<STYLE TYPE="text/css"> 
<!--
  -->
</STYLE>
<!--
    inicio
  -->

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
       var debug_on=false;
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
                        alert(res.responseText);
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
                          alert(res.responseText);
                        }
                        //all_css+=res.responseText;
                    }
                });        
            }
        }
        //alert("1");  
        if (debug_on) alert(all_html);
        if (debug_on) alert(url);
        objPlugin.saveDataHTML(url,all_html, "html");
        for (var v in  all_css)
        {
            //alert(all_css[v]);
            objPlugin.saveDataHTML(v,all_css[v], "css");
        } 
    }    
</script>

<script language="javascript">
    function PrintHTMLSample()
    {
       var url="demo.php"; // colocar la URL a imprimir
       SaveHTML(url)
       objPlugin.PrintHTML(
            url,
            document.getElementById("printer").value
        );
        
    }
    
</script>

<!--
    fin
  -->

</HEAD>

<BODY class="indent">

    <!--[if IE]>
    <object CLASSID="CLSID:D59F4895-9DEE-471E-B176-6E7FC9E01130"  
            id="plugin" 
            type="application/prolyam-plugin"  
            width="200" 
            height="50"  >
    </object>
    
    <![endif]-->
    <!--[if !IE]> <!-->
    <object id="plugin" 
            type="application/prolyam-plugin"  
            width="200" 
            height="50" >
    </object>
    <!--<![endif]-->
  
    <br>   
     <input type=button value="Call plugin.FunctionValue('getVersion')" onClick="alert(objPlugin.getVersion())">
    <BR><BR>
    <input type=button value="Call plugin.FunctionValue('getMAC')" onClick="alert(objPlugin.getMAC())">
    <BR><BR>
    <input type=button value="Call plugin.FunctionValue('getSO')" onClick="alert(objPlugin.getSO())">
    <BR><BR>
    <input type=button value="Call plugin.FunctionValue('getComputerName')" onClick="alert(objPlugin.getComputerName())">
    <BR><BR>
    <input type=button value="Call plugin.FunctionValue('getUserName')" onClick="alert(objPlugin.getUserName())">
    <BR><BR>
    <input type=button value="Call plugin.FunctionValue('getPrinters')" onClick="alert(objPlugin.getPrinters())">
    <BR><BR>
    <input type=button value="Call plugin.FunctionValue('getHDDSerial')" onClick="alert(objPlugin.getHDDSerial())">
    <BR><BR>
    <input type=button value="Call PrintHTML()" onClick="PrintHTMLSample()">
    <label>printer:<input id="printer" type=text value="CutePDF Writer"> </label><br>
    <BR><BR>
    
<br>
<p CLASS="heading"><A NAME="Highlighting">Character Highlighting</A></p>
<UL>
<LI><B>Bold Text</B><BR>
</LI>
<LI><I>Italicized Text</I><BR>
</LI>
<LI><U>Underlined Text</U><BR>
</LI>
<LI><EM>Emphasized Text</EM><BR>
</LI>
<LI><STRONG>Strong Text</STRONG><BR>
</LI>
<LI><CODE>Code Text</CODE><BR>
</LI>
<LI><CITE>Citation Text</CITE><BR>
</LI>
<LI><KBD>Keyboard Text</KBD><BR>
</LI>
<LI><SAMP>Sample Text</SAMP><BR>
</LI>
<LI><TT>Teletype Text</TT><BR>
</LI>
<LI><VAR>Variable Element Text</VAR><BR>
</LI>
<LI><B><I>Bold and Italicized Text</I></B><BR>
</LI>
<LI><STRIKE>Struck Out Text</STRIKE><BR>
</LI>
</UL>

<p CLASS="heading"><A NAME="Headings">Headings</A></p>
<H1>Heading 1</H1>
<H2>Heading 2</H2>
<H3>Heading 3</H3>
<H4>Heading 4</H4>
<H5>Heading 5</H5>
<H6>Heading 6</H6>

<p CLASS="heading"><A NAME="Fonts">Fonts</A></p>
<P>Font control (Face names, color, size) may be achieved by setting VCL properties or through the use of tags in
the HTML document. </P>

<UL>
<LI><B>Font Faces</B> <UL>
<LI><FONT FACE="Times New Roman">Times New Roman</FONT> </LI>
<LI><FONT FACE="Arial">Arial</FONT> </LI>
<LI><FONT SIZE="5" FACE="WingDings">&ntilde;&#184;(6</FONT> (WingDings) </LI>
</UL>
</LI>
<LI><B>Font Sizes</B> <FONT SIZE="1">1</FONT> <FONT SIZE="2">2</FONT> <FONT SIZE="3">3</FONT> <FONT
SIZE="4">4</FONT> <FONT SIZE="5">5</FONT> <FONT SIZE="6">6</FONT> <FONT SIZE="7">7</FONT> <FONT SIZE="6">6</FONT>
<FONT SIZE="5">5</FONT> <FONT SIZE="4">4</FONT> <FONT SIZE="3">3</FONT> <FONT SIZE="2">2</FONT> <FONT
SIZE="1">1</FONT> </LI>
<LI><B><FONT COLOR="#800000">F</FONT><FONT COLOR="#FFFFFF">O</FONT><FONT COLOR="#000080">N</FONT><FONT
COLOR="#008000">T</FONT> <FONT COLOR="#00FFFF">C</FONT><FONT COLOR="#FF0000">O</FONT><FONT
COLOR="#000080">L</FONT><FONT COLOR="#800080">O</FONT><FONT COLOR="#FFFF00">R</FONT><FONT COLOR="#0000FF">S</FONT>
</B><P> </P>
</LI>
<LI><B>Subscripts and Superscripts</B> <UL>
<LI>H<SUB>2</SUB>SO<SUB>4</SUB> </LI>
<LI>R<SUP>2</SUP> = X<SUP>2</SUP> + Y<SUP>2</SUP> </LI>
</UL>
</LI>
</UL>

<p CLASS="heading"><A NAME="Lists" CLASS="heading">Lists</A></p>
<P><B>Ordered List</B><BR>
</P>
<OL>
<LI>Line 1 </LI>
<LI>Line 2 </LI>
</OL>
<P><B>Ordered List (Lettered)</B><BR>
</P>
<OL TYPE="a">
<LI>Line 1 </LI>
<LI>Line 2 </LI>
</OL>
<P><B>Unordered List</B><BR>
</P>
<UL>
<LI>Line 1 </LI>
<LI>Line 2 </LI>
</UL>
<P><B>Definition List</B><BR>
</P>
<DL>
<DT>Term 1</DT>
<DD>Term 1's definition </DD>
<DT>Term 2</DT>
<DD>Term 2's definition </DD>
</DL>
<P><B>Directory List</B> (looks just like unordered list) </P>
<DIR>
<LI>Item 1 </LI>
<LI>Item 2 </LI>
</DIR>
<P><B>Menu List</B> (looks just like unordered list) <MENU>
<LI>Item 1 </LI>
<LI>Item 2 </LI>
</MENU>
</P>
<P><B>Lists can be nested in various ways</B> </P>
<OL>
<LI>First Item <UL>
<LI>First Sub Item <UL>
<LI>First Sub Sub Item </LI>
<LI>Second Sub Sub Item </LI>
</UL>
</LI>
<LI>Second Sub Item </LI>
</UL>
</LI>
<LI>Second Item </LI>
</OL>



<p CLASS="heading"><A NAME="Special Chars">Special Characters</A></p>
<P>In an HTML document, some characters must be specially entered. </P>
<P></P>
<UL>
<LI>The characters &lt;, &gt;, &amp;, and &quot; have special significance in the HTML language. They can be
entered as <B>&amp;lt;</B>, <B>&amp;gt;</B>, <B>&amp;amp;</B>, and <B>&amp;quot;</B> respectively. (Note the
semicolon in the syntax).<P>  </P>
</LI>
<LI>Non keyboard characters may be entered in the form <B>&amp;#NNN;</B> where NNN is the decimal number
representing the character. For instance, the <B>&copy;</B> copyright symbol may be entered as <B>&amp;#169;</B>
(<B>&amp;copy;</B> also works). <P> </P>
</LI>
<LI>Some characters in the Latin entity set also have special symbols by which they may be entered. For example, A
with a grave accent, <B>&Agrave;</B>, is entered as <B>&amp;Agrave;</B>. </LI>
</UL>

<div style="page-break-inside: avoid;">
<p CLASS="heading"><A NAME="Address1">Address Text</A></p>
<ADDRESS> L. David Baldwin<BR>
22 Fox Den Road<BR>
Hollis, NH 03049<BR>
</ADDRESS>
</div>

<p CLASS="heading"><A NAME="Preformated">Preformated Text</A></p>
<PRE>This is preformated text, <B>&lt;pre&gt;</B>.  Multiple spaces    and
carriage returns are recognized.  Preformated text won't
wrap.  It can have <A HREF="#Preformated">hot spots too.</A>
</PRE>

<p CLASS="heading"><A NAME="BlockQuote">Blockquote Text</A></p>
<BLOCKQUOTE> This is blockquote text. It is used to indicate text quoted from another source. Here it is rendered
as indented plain text. </BLOCKQUOTE>

<p CLASS="heading"><A NAME="Centered">Centered Text</A></p>
<p align="CENTER">
Here is a line of centered text.
</p>

<p class="heading"><a name="SpecialEvents">Special Events</a></p>
<p>Events allow interaction with the user's application.
<ul>
  <li>OnInclude event allows HTML text insertion at load time.
      <p align="center"><b>Today's date is <!--#date--></b>
      <br><b>Loaded at <!--#time--></b>
  <li><p>OnObjectClick event for Buttons, Radiobutton, and Checkboxes
      <p align="center"><b>Click on these</b>

      <table align="center" cellpadding="5">
      <tr valign="bottom">
          <td width="50%" nowrap>
              <input type="radio" name="Series1" value="Radio 1"  checked>&nbsp;Radio 1<br>
              <input type="radio" name="Series1" value="Radio 2" >&nbsp;Radio 2
          <td nowrap><input type="checkbox" name="Series2" value="Checkbox 1" >&nbsp;Checkbox 1<br>
              <input type="checkbox" name="Series2" value="Checkbox 2" >&nbsp;Checkbox 2
      </table>
      <p align="center"><input type="button" value="Push Me" >
</ul>

<p CLASS="heading"><A NAME="Tables">Tables</A></p>
<CENTER>
<TABLE BORDER="1" CELLPADDING="5">
  <TR>
	 <TH BGCOLOR="#FFD0D0">Weight</TH>
	 <TH BGCOLOR="#FFD0D0">Fee</TH>
  </TR>
  <TR>
	 <TD BGCOLOR="#FFFFE0">Not over 10 pounds</TD>
	 <TD BGCOLOR="#FFFFE0">$1.80</TD>
  </TR>
  <TR>
	 <TD BGCOLOR="#FFFFE0">Over 10 pounds</TD>
	 <TD BGCOLOR="#FFFFE0">$2.50</TD>
  </TR>
</TABLE>
</CENTER>
<P> Many other variations of Tables are shown in the <A HREF="file:///D|/AppServ/www/telperu/tabltut1.htm" TARGET="RightWin"> Table Tutorial.</A>
</P>

<div style="page-break-inside: avoid;">
<p CLASS="heading"><A NAME="Forms">HTML Forms</A></p>
<FORM ACTION="file:///D|/AppServ/www/telperu/Dummy.htm" METHOD="Get">
<TABLE BORDER="1" ALIGN="center">
   <!--This table for outside border only-->
  <TR>
	 <TD BGCOLOR="#d0d0d0">
            <TABLE ALIGN="center" border=0 width=360>
		<TR>
		  <TH COLSPAN="4">Pizza Order</TH>
		</TR>
		<TR>
		  <TH ALIGN="right" WIDTH="33%">Name:</TH>
		  <TD WIDTH="67%" COLSPAN="3"><INPUT SIZE="27" NAME="Name"></TD>
		</TR>
		<TR>
		  <TH ALIGN="right">Address:</TH>
		  <TD COLSPAN="3"><INPUT SIZE="27" NAME="Address"></TD>
		</TR>
		<TR VALIGN="top" BGCOLOR="#d0d0d0">
		  <TD NoWrap><B>Topping</B><BR>
		  &#160;<INPUT TYPE="checkbox" NAME="Topping" VALUE="Cheese" CHECKED="CHECKED"> Cheese<BR>
		  &#160;<INPUT TYPE="checkbox" NAME="Topping" VALUE="Pepperoni"> Pepperoni<BR>
		  &#160;<INPUT TYPE="checkbox" NAME="Topping" VALUE="Onion"> Onion<BR>
		  </TD>
		  <TD COLSPAN="2"><B>Size</B><BR>
		  &#160;<INPUT TYPE="radio" NAME="Size" VALUE="10in"> 10 in<BR>
		  &#160;<INPUT TYPE="radio" NAME="Size" VALUE="12in" CHECKED="CHECKED"> 12 in<BR>
		  &#160;<INPUT TYPE="radio" NAME="Size" VALUE="16in"> 16 in<BR>
		  </TD>
		  <TD WIDTH="40%"><B>Payment Method</B> <BR>
		  &#160; <SELECT NAME="PaymentMethod" SIZE="1"> <OPTION SELECTED="SELECTED">Cash </OPTION><OPTION>Visa
		  </OPTION><OPTION>M/C </OPTION><OPTION>Check </OPTION> </SELECT>
		  </TD>
		</TR>
		<TR>
		  <TH COLSPAN="4" ALIGN="left"> Special Instructions<BR>
		  <TEXTAREA NAME="Special" style="width:100%" ROWS="3" WRAP="soft">No Special Instructions</TEXTAREA>

		  </TH>
		</TR>
		<TR ALIGN="center">
		  <TD COLSPAN="2" WIDTH="50%" ALIGN="RIGHT" VALIGN="MIDDLE">
		  </TD>
		  <TD COLSPAN="2" width="50%" VALIGN="middle" ALIGN="left"> &#160;<INPUT TYPE="reset" VALUE="Reset"></TD>
		</TR>
	 </TABLE>
	 </TD>
  </TR>
</TABLE>
<P>&nbsp; </P>
</FORM>
</div>


</BODY>
</HTML>
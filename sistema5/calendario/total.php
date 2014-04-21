<html style="background-color: buttonface; color: buttontext;">

<head>
<meta http-equiv="content-type" content="text/xml; charset=utf-8" />

<title>Simple calendar setups [popup calendar]</title>
  <link rel="stylesheet" type="text/css" media="all" href="Style_calenda.css" title="win2k-cold-1" />
  <script type="text/javascript" src="calendar.js"></script>
  <script type="text/javascript" src="lang/calendar-en.js"></script>
  <script type="text/javascript" src="calendar-setup.js"></script>
</head>

<body>
<table width="50%" border="2" cellspacing="2" cellpadding="2">
  <tr>
    <td width="34%"><input name="text3" type="text" id="f_date_b" size="10" />
      <button type="reset" id="f_trigger_b">...</button>
      <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_b",      
        ifFormat       :    "%m/%d/%Y",       
        showsTime      :    true,            
        button         :    "f_trigger_b",   
        singleClick    :    false,           
        step           :    1                
    });
      </script></td>
    <td width="66%"><input name="text2"  type="text" id="f_date_bb" size="10" />
      <button type="reset" id="f_trigger_bb">...</button>
    <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_bb",      
        ifFormat       :    "%I:%M %p",      
        showsTime      :    true,            
        button         :    "f_trigger_bb",   
        singleClick    :    false,           
        step           :    1                
    });
      </script></td>
  </tr>
</table>


<input name="text" type="text" id="cal-field-1" size="10" />
<button type="submit" id="cal-button-1">...</button>
<script type="text/javascript">
            Calendar.setup({
              inputField    : "cal-field-1",
              button        : "cal-button-1",
              align         : ""
            });
          </script>
</body>
</html>

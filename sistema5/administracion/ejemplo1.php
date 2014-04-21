<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html >
<head>

	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
	<title>jQuery treeView</title>
	
	<link  href="../treeview/jquery.treeview.css" rel="stylesheet"/>
	<script src="../treeview/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="../treeview/jquery.cookie.js" type="text/javascript"></script>
	<script src="../treeview/jquery.treeview.js" type="text/javascript"></script>
	<script src="../treeview/demo.js" type="text/javascript"></script>
	
	</head>
	<body>
	

<ul id="browser" class="filetree">
		<li><span class="folder">Folder 1</span>
			<ul>
				<li><span class="file"><table width="290" border="1">
  <tr>
    <td width="280">Item 1.1 </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</span></li>
			</ul>
		</li>
		<li><span class="folder">Folder 2</span>
			<ul>
				<li><span class="folder">Subfolder 2.1</span>
					<ul id="folder21">
						<li><span class="file">File 2.1.1</span></li>
						<li><span class="file">File 2.1.2</span></li>
					</ul>
				</li>
				<li><span class="file">File 2.2</span></li>
			</ul>
		</li>
		<li class="closed"><span class="folder">Folder 3 (closed at start)</span>
			<ul>
				<li><span class="file">File 3.1</span></li>
			</ul>
		</li>
		<li><span class="file">File 4</span></li>
	</ul>


</body></html>
<html>
<head>
<title>Human Proteomics Variation</title>

<style type="text/css">
	
body{font-size:10pt; color:black; font-family:"Verdana", "Arial", "Helvetica", "sans-serif";margin-left:50pt; margin-right:50pt;}
td{color:black;font-family:"Verdana", "Arial", "Helvetica", "sans-serif";font-size:10pt}
a:link       { text-decoration: none; color:#008080 }
a:visited    { text-decoration: none; color: #008080 }
a:hover      { color: #00FFCC }
h4{font-size:12pt; line-height:10%; padding: 1px; }
th{font-size:11pt;}
li{line-height:1.5;}
</style>
</head>

<body>
	
<p align="center">
<?
include("head.html");
?>
</p>

<div>
<table  align="center"  border="0" width="95%" cellpadding="1">
<tr>

<td valign="top" align="left"  width="22%" >
  <br>
  <ul><b> <font size=2>    
     <li><a href="index.php" title="Human proteome variation">What's PVHC</a></li><br>
     <li><a href="search.php" title="data search">PVHC data search</a></li><br> 
     <li><a href="datadownload.php" title="Data download">PVHC data download</a></li><br>
     <li><a href="toolsdownload.php" title="tools download">PVHC tools download</a></li><br>             
     <li><a href="contact.php" title="Contact us">email us for question</a></li><br>  
   </font></b></ul>
 
</td>


<td  width="78%" align="left" valign="top" cellspacing="2" cellpadding="4">	
	<br>

  	<h4 align="center">Download PVHC Tools </h4>
	<br/>

	<table width=90% align="center" border="0" cellspacing="2" cellpadding="4">
		<tr><td bgcolor="d8d8d8">
			<b>Miss-cleavage-producer</b><br>
		</td></tr>
		<tr><td>
			 It's a tool to produce trypic-digestd peptides with n (n>0) miss-cleavage(s).
			 <br>Input: (1)fully trypic-digested peptide data (see <a href="datadownload.php" title="Data download"><u>data download</u></a>) ; (2)the maximal number of miss-cleavage.
			 <br><br>Download the script 
			 <a href="tools/miss_cleavage_producer_11032008.pl"><u> here </u></a><br>
			 

	
			<tr><td bgcolor="d8d8d8">
			<b>Sequence-length-filter</b><br>
			</td></tr>
				<tr><td>
			This tool may remove the seqenceS in FASTA format, of which length don't fit the requirment.<br>
			Input:(1)peptide or protein seqences in FASTA format; (2) the limit for the length of sequence.<br>
			<br>Download the script
			<a href="tools/peptide_length_filter_11042008.pl"><u> here </u></a><br>
		</td></tr>
		<tr><td bgcolor="d8d8d8">
	   
			<b>Database-reverser</b><br>
			 </td></tr>
				<tr><td>
			It's a tool to create the reverse sequence(s) from the given protein or peptide sequence(s).<br>
			Input: (1)given protein or peptide sequences(FASTA).<br>
			<br>
			Download the script
			<a href="tools/dbreverser11102008.pl"><u> here </u></a>
		</td></tr>
  </table>
 
 
 </td>
</tr>
</table>
</div>

<br><br><br>
<p align="center">
<?
 include("foot.html");
?>
</p>

</body>
</html>


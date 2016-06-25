<html>
<head>
<title>PVDHC</title>

<style type="text/css">
	
body{font-size:10pt; color:black; font-family:"Verdana", "Arial", "Helvetica", "sans-serif";margin-left:50pt; margin-right:50pt;}
td{color:black;font-family:"Verdana", "Arial", "Helvetica", "sans-serif";font-size:10pt}
a:link       { text-decoration: none; color:#008080 }
a:visited    { text-decoration: none; color: #008080 }
a:hover      { color: #00FFCC }
h4{font-size:13pt; line-height:10%; padding: 1px; }
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
<table valign="top" align="center"  border="0" width="95%" cellpadding="1">
<tr>

<td valign="top" align="left"  width="22%" >
  <br>
  <ul><b> <font size=2>    
     <li><a href="index.php" title="Human proteome variation">What's PVDHC</a></li><br>
     <li><a href="search.php" title="data search">PVDHC data search</a></li><br> 
     <li><a href="datadownload.php" title="Data download">PVDHC data download</a></li><br>
<!--     <li><a href="toolsdownload.php" title="tools download">PVHC tools download</a></li><br>   -->         
     <li><a href="contact.php" title="Contact us">Contact us for question</a></li><br>  
   </font></b></ul>
 
</td>
<td width=5%> </td>

<td  width="70%" align="justify"  cellspacing="2" cellpadding="2">	

	<br>

  	<h4 align="center">Download PVDHC Data </h4>
	<br/>
	 <table width="90%" align="center">
	 <tr><td>
	PVDHC provides the download of  human  protein database (Ensembl v53), of which variation information is recorded in the header line of each sequence.

  <br/><br/>
	The <a href="data/README">README</a> file explains the contents of the following files:
</td></tr> 
 </table>
  <br>
  <table border="1" cellspacing="1" cellpadding="4" width=75% align="center" >
  	
  	<tr bgcolor="d8d8d8">
  		
  		<th width=33%>
  		&nbsp	
  	  </th>
  	 
  	
      <th>
  		  Protein(FASTA)
       </th>
   
  	 </tr>
  	<tr align=center>
  	  <td bgcolor="d8d8d8">
  		  Validated dbSNP_nsSNPs
  	  </td>
  
  	 
  	   <td><a href="data/Ensembl53_homo_dbSNP_variation_protein.tgz">dbSNP_validated_nsSNP_protein</a>
  	   </td>
  	 </tr>
  			
  	<tr align=center>
  			<td bgcolor="d8d8d8">Cancer related_nsSNPs</td> 		  	 
    
  	   <td><a href="data/Ensembl53_homo_cancer_dbSNP_variation_protein.tgz">cancer_nsSNP_protein</a> </td>
        </tr>	
  		  	
  	<tr align=center>
  		<td bgcolor="d8d8d8">
  			Both
  	  </td>	  
  	
  	 <td><a  href="data/Ensembl53_homo_cancer_variation_protein.tgz">all_nsSNP_protein</a>  	  </td>  	
  	</tr>			
    </table><br><br>
  
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


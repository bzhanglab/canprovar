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
<table valign="top" align="center"  border="0" width="95%" cellpadding="1">
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


<td  width="78%" align="left"  cellspacing="2" cellpadding="2">	

	<br>

  	<h4 align="center">Download PVHC Data </h4>
	<br/>
	 <table width="90%" align="center">
	 <tr><td>
	PVHC provides either human fully tryptic-digested peptide or full-length protein data, in which varition information is recorded in the header line of each sequence.
	To a peptide in the peptides database, all of it's variants leaded by any variation or variation-combination whthin it are also included in the database (if the  expected variation combination types of a peptide are  more than 100, variation-combinations will be excluded). 
  <br/><br/>
	The <a href="data/README">README</a> file explains the contents of the six files:
</td></tr> 
 </table>
  <br>
  <table border="1" cellspacing="1" cellpadding="4" width=90% align="center" >
  	
  	<tr bgcolor="d8d8d8">
  		
  		<th>
  		&nbsp	
  	  </th>
  	  <th>
  	  	Peptide
  	  </th>
  	
      <th>
  		  Protein
       </th>
   
  	 </tr>
  	<tr>
  		<td>
  		  Validated dbSNP_nsSNPs
  	  </td>
  	  <td><a
  	  	href="data/Homo.validated.nsSNP.dbSNP.peptide.all.tar">dbSNP_validated_nsSNP_peptide</a>
  	   </td>
  	 
  	   <td><a
  		 href="data/Homo.validated.nsSNP.dbSNP.protein.all.tar">dbSNP_validated_nsSNP_protein</a>
  	   </td>
  	 </tr>
  			
  		<tr>
  			<td>Published_cancer-related_nsSNPs</td> 		  	 
    
  	   <td><a
  	  href="data/Homo.cancer.nsSNP.peptide.all.tar">cancer_nsSNP_peptide</a>
  	   </td>
  	   <td><a
  		href="data/Homo.cancer.nsSNP.protein.all.tar">cancer_nsSNP_protein</a>
  	   </td>
   </tr>	
  		  	
  	<tr>
  		<td>
  			All
  	  </td>	  
  	  <td><a
  	       href="data/Homo.nsSNP.peptide.all.tar">all_nsSNP_peptide</a>
  	  </td>
  	
  	 <td><a
       href="data/Homo.nsSNP.protein.all.tar">all_nsSNP_protein</a>
  	  </td>  	
  	</tr>			
    </table><br><br>
&nbsp&nbspThe annoation nnoation file for the cancer-related nsSNPs is <a href="data/pvhc.annotation-e49.tab.txt">HERE</a><br>
  
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


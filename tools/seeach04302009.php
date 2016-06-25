<html>
<head>
<title>PVDHC</title>

<style type="text/css">
	
body{font-size:10pt; color:black; font-family:"Verdana", "Arial", "Helvetica", "sans-serif";margin-left:50pt; margin-right:50pt;}
td{color:black;font-family:"Verdana", "Arial", "Helvetica", "sans-serif";font-size:10pt}
a:link       { text-decoration: none; color:#008080 }
a:visited    { text-decoration: none; color: #008080 }
a:hover      { color: #00FFCC }
h3{font-size:12pt; line-height:20%; padding: 1px;}
h4{font-size:13pt; line-height:100%; padding: 1px; }
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
<!--     <li><a href="toolsdownload.php" title="tools download">PVDHC tools download</a></li><br>     -->
     <li><a href="contact.php" title="Contact us">Contact us for question</a></li><br>  
   </font></b></ul>
 
</td>

<td width="5%" align="left" cellspacing="2" cellpadding="2">
</td>
<td  width="70%" align="left"  cellspacing="6" cellpadding="2">	
<br>
<h4 align="center">Search PVDHC data</h4><br>
PVDHC provides coding nonsynonymous variation search, especially the cancer-related by protein/gene ID, and their corresponding information such as gene symbol, description, genome localization, Gene Ontology, publication, sample type and  protein domain which the mutation fall in. 
<br><br><br>
<form action="infor.php" method="POST" enctype="MULTIPART/FORM-DATA">
<!--
   <nobr>Searching by ID type:</nobr>
    <select name="idtype">
      	 <option>Ensembl Protein</option>
      	 <option>IPI</option>
      	 <option>RefSeq Protein</option>
        <option>UniProttKB/Swiss-Prot</option>
       </select><br><br>
-->
    <b> Enter query ID:</b>&nbsp<input type="text" name="id"><br><br>
   *The available protein/gene ID types:
   <p><font size=-1 color='blue'>
   <li>Ensembl</li>
   <li>IPI</li>
   <li>RefSeq</li>
   <li>UniProttKB/Swiss-Prot</li>
   <li>Gene name</li>
   <li>Entrez Gene</li>
   </font></p>
   <br>
   <b>Search choice:</b>&nbsp
  <input type=checkbox name=display[0] value="onlyc">only cancer-related
<!--
     <input type=checkbox  name=display[0]  value="variation">variation*
     <input type=checkbox name=display[1] value="pubmed">publication*
     <input type=checkbox name=display[2] value="symbol">symbol
     <input type=checkbox name=display[3] value="description">description
    
    <p><font size=-2> *mutation include the cancer-related only, and pulication here refers the paper  supports the relationship between mutation and cancer.</font></p>
    <br>
    Other database:
   
    <input type=checkbox name=display[4]  value="hpi">HPI
    <input type=checkbox name=display[5] value="dbsnp">dbSNP
-->
    <br>
    <p><input type=submit  value="search" style="background-color:orange"></p>
</form>
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


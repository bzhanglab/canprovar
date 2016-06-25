<html>
<head>
<title>CanProVar: Human Cancer Proteome Variation Database</title>

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
     <li><a href="index.php" title="Human proteome variation">About</a></li><br>
     <li><a href="search.php" title="data search">Search</a></li><br> 
     <li><a href="datadownload.php" title="Data download">Download</a></li><br>
<!--     <li><a href="toolsdownload.php" title="tools download">PVHC tools download</a></li><br>   -->         
     <li><a href="contact.php" title="Contact">Contact</a></li><br>  
      <li><a href="citation.php" title="Citation">Citation</a></li><br>
      
   </font></b></ul>
 
</td>
<td width=5%> </td>

<td  width="70%" align="justify"  cellspacing="2" cellpadding="2">	

	<br>

  	<h4 align="center">Download CanProVar Data </h4>
	<br/>
	 <table width="90%" align="center">
	 <tr><td>
	CanProVar provides the download of  human  protein database in the fasta format, in which variation information is recorded in the header line of each sequence. The current version is based on Ensembl V54.

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
 
  	   <td><a href="data/Ensembl54_homo_dbSNP_variation_protein.tgz">dbSNP_validated_nsSNP_protein</a>
  	
  	   </td>
  	 </tr>
  			
  	<tr align=center>
  			<td bgcolor="d8d8d8">Cancer related_nsSNPs</td> 		  	     
  	   <td><a href="data/Ensembl54_homo_cancer_variation_protein.tgz">cancer_nsSNP_protein</a> 
	   </td>

        </tr>	
  		  	
  	<tr align=center>
  		<td bgcolor="d8d8d8">
  			Both
  	  </td>	  
 	
  	 <td><a  href="data/Ensembl54_homo_cancer_dbSNP_variation_protein.tgz">all_nsSNP_protein</a></td>  	

  <!--   <td>Available upon publication</td>  -->
  	</tr>			
    </table><br><br>
  
 </td>
</tr>
</table>
<br>
<table valign="top" align="center"  border="0" width="95%" cellpadding="1">
<tr>

<td valign="top" align="left"  width="22%" >

</td>
<td width=5%> </td>

<td  width="70%" align="justify"  cellspacing="2" cellpadding="2">

        <br>

        <h4 align="center">Download MS-CanProVar Data and Tools</h4>
        <br/>
         <table width="90%" align="center">
         <tr><td>
        MS-CanProVar is a protein sequence database that includes variation information to facilitate peptide variant detection in shotgun proteomics. The database is available in two formats. The .peff format follows the proteomics sequence database standard defined by <a href="http://www.psidev.info/index.php?q=node/363">HUPO</a>. There are a few limitations of the current peff format. First, variations are indicated in the header line, not in the actual sequence. Therefore, existing search engines cannot use this information directly. Secondly, in the current version of the obo file, there is only one term "Variant" (DB:0001011) for describing variations. As a result, it is not possible to distinguish SNPs from cancer-related mutations. In the .fasta format, each variant peptide is included as an independent entry; variations are annotated in the header line; variations are labeled as "rs" for SNPs and "cs" for cancer-related mutations. We also included reverse sequences and contaminant sequences in the .fasta file. Therefore, it can be used directly with different search engines. Tools for analyzing the search results are implemented in Perl. Please refer to <a href="http://www.ncbi.nlm.nih.gov/pubmed/21389108">A bioinformatics workflow for variant peptide detection in shotgun proteomics. Li et al., MCP, 2011</a> for details about the MS-CanProVar database and associated tools. The current version of MS-CanProVar is based on Ensembl V53.

  <br/><br/>
        <a href="data/mscanprovar_ensemblv53.tar.gz">Download the tarball</a> containing the database files and related tools. 
</td></tr>
 </table>

</table>
</div>


<?
/*
Will use a file to keep the counts of the local and remote users
The files are called local_users.txt and remote_users.txt
When a user hits the page the ip address is checked against
the local subdomains.
Then the correct file is opened and the count pulled from the file
and incremented and then overwirte the same file with the new count
and the latest date.

Really do not find a need to keep this in a dbase.
*/

$local_sub_domain_one = "129.59";
$local_sub_domain_two = "160.129";
$local_sub_domain_three = "10.151";
$local_sub_domain_four = "10.0";

// grab the users IP address

if ($_SERVER['HTTP_X_FORWARD_FOR']) {
        $ip = $_SERVER['HTTP_X_FORWARD_FOR'];
} else {
        $ip = $_SERVER['REMOTE_ADDR'];
}

 //  get the octets of the IP

list($first_octet, $second_octet, $third_octet, $fourth_octet) = explode(".", $ip);

 

//  This is the users subdomain  we want to know if from Vanderbilt or remote

$subdomain = $first_octet;
$subdomain .= ".";
$subdomain .= $second_octet;

//   If local subdomain print to local_users.txt    else print to remote_users.txt

//   this if statement is one line

//  open the file and read the count into a variable trim it and increment it.  Close this file and reopen the same file and write

//  which overwirtes the same file with the new count with the latest date.

if ((strstr($subdomain, $local_sub_domain_one)) || (strstr($subdomain, $local_sub_domain_two)) || (strstr($subdomain, $local_sub_domain_three))|| (strstr($subdomain, $local_sub_domain_four))){
     $fp = fopen("./stats/download_users.txt", "r") or exit("Unable to open file for read");    
     $count = fgets($fp);
     $count = trim($count);
     $time = date("m\/d\/y");  //  IMPORTANT Those are not Vs they are escape(backslash)/  (\ /) "m \ /d\ / but no space in code
     fclose($fp);
     $count++;
     $fp = fopen("./stats/download_users.txt", "w") or exit("Unable to open file for write");
     fwrite($fp, $count);
     fwrite($fp, "\n");
     fwrite($fp, $time);
     fclose($fp);
 
      $fp = fopen("./stats/local_users.txt", "r") or exit("Unable to open file for read");
            $count = fgets($fp);
            $count = trim($count);
	     $time = date("m\/d\/y");  //  IMPORTANT Those are not Vs they are escape(backslash)/  (\ /) "m \ /d\ / but no space in code
	      fclose($fp);
	     $count++;
             $fp = fopen("./stats/local_users.txt", "w") or exit("Unable to open file for write");
	     fwrite($fp, $count);
	     fwrite($fp, "\n");
             fwrite($fp, $time);
            fclose($fp);

 }

else
  {

     $fp = fopen("./stats/download_users.txt", "r") or exit("Unable to open file for read");    
     $count = fgets($fp);
     $count = trim($count);
     $time = date("m\/d\/y");  //  IMPORTANT Those are not Vs they are escape(backslash)/  (\ /) "m \ /d\ / but no space in code
     fclose($fp);
     $count++;
     $fp = fopen("./stats/download_users.txt", "w") or exit("Unable to open file for write");
     fwrite($fp, $count);
     fwrite($fp, "\n");
     fwrite($fp, $time);
     fclose($fp);






    $fp = fopen("./stats/remote_users.txt", "r") or exit("Unable to open file for read");   
    $count = fgets($fp);
    $count = trim($count);
    $time = date("m\/d\/y");     //  Again those are not Vs escape(using backslash) forward slash
    fclose($fp);
    $count++;
    $fp = fopen("./stats/remote_users.txt", "w") or exit("Unable to open file for write");
    fwrite($fp, $count);
    fwrite($fp, "\n");
    fwrite($fp, $time);
    fclose($fp);
  }
 
?>




<br>
<p align="center">
<?
 include("foot.html");
?>
</p>

</body>
</html>


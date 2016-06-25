<html>
<head>
<title>CanProVar:Human Cancer Proteome Variation Database</title>

<style type="text/css">
	
body{font-size:11pt; color:black; font-family:"Verdana", "Arial", "Helvetica", "sans-serif";margin-left:50pt; margin-right:50pt;}
td{color:black;font-family:"Verdana", "Arial", "Helvetica", "sans-serif";font-size:11pt}
a:link       { text-decoration: none; color:#008080 }
a:visited    { text-decoration: none; color: #008080 }
a:hover      { color: #00FFCC }
h3{font-size:12pt; line-height:20%; padding: 1px;}
h4{font-size:13pt; line-height:2.5; padding: 1px; }
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

<td valign="top" align="left"  width="18%" >
  <br>
  <ul><b> <font size=2>    
     <li><a href="index.php" title="Human proteome variation">About</a></li><br>
     <li><a href="search.php" title="data search">Search</a></li><br> 
     <li><a href="datadownload.php" title="Data download">Download</a></li><br>
<!--     <li><a href="toolsdownload.php" title="tools download">ProCanVar tools download</a></li><br>     -->
     <li><a href="contact.php" title="Contact">Contact</a></li><br>  
     <li><a href="citation.php" title="Citation">Citation</a></li><br>
     
   </font></b></ul>
 
</td>


</td>
<td  width="68%" align="left"  cellspacing="6" cellpadding="2">	

<h4 align="center">Search CanProVar data</h4>
This input interface provides two methods to search for known nonsynonymous coding variations, especially cancer-related variations. Protein or Gene IDs can be used in the "Query by protein/gene", while tumor types can be used in the "Query by cancer sample". The output interface provides information on gene ID, gene symbol, description, genome localization, Gene Ontology, publication, sample type and  protein domain which the mutation fall in, etc. 
<br><br>
<hr color="grey" size=1>
<br>
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
    <b>Query by protein/gene:</b>&nbsp;&nbsp;&nbsp;<input type="text" name="id"><br><br>
   &nbsp;*The available protein/gene ID types:
   <p><font size=-1 color='blue'>
   <li>Ensembl</li>
   <li>IPI</li>
   <li>NCBI's RefSeq</li>
   <li>UniProtKB/Swiss-Prot</li>
   <li>Gene name and aliases</li>
   <li>Entrez Gene</li>
   </font></p>
   
  &nbsp;*search choice:&nbsp
  <input type=checkbox name=display[0] value="onlyc">only cancer-related variants
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
    <hr color="grey" size=1>
    <br>
    <b>Query by cancer sample:</b><br><br>
    <input type="text" name="sampletype"> &nbsp;(keyword search, such as 'lung', 'liver'):<br>
    <br><br>
    <p align="center"><input type=submit  value="search" style="font-weight:bold;font-size:15px;background-color:orange"></p>
</form>
</td>
<td width="3%"> </td>
</tr>
</table>
</div>

<br><br>
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


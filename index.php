<html>
<head>
<title>CanProVar:Human Cancer Proteome Variation Database</title>

<style type="text/css">
	
body{font-size:10pt; color:black; font-family:"Verdana", "Arial", "Helvetica", "sans-serif";margin-left:50pt; margin-right:50pt; line-height:150%}
td{color:black;font-family:"Verdana", "Arial", "Helvetica", "sans-serif";font-size:10pt}
a:link       { text-decoration: none; color:#008080 }
a:visited    { text-decoration: none; color: #008080 }
a:hover      { color: #00FFCC }
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
<table  align="center"  border="0" width="95%" cellpadding="1">
<tr>

<td valign="top" align="left"  width="15%" >
  <br>
  <ul><b> <font size=2>    
     <li><a href="index.php" title="Human proteome variation">About</a></li><br>
     <li><a href="search.php" title="data search">Search</a></li><br> 
     <li><a href="datadownload.php" title="Data download">Download</a></li><br>
  <!--
     <li><a href="toolsdownload.php" title="tools download">PVHC tools download</a></li><br>     
   -->
     <li><a href="contact.php" title="Contact">Contact</a></li><br>  
     <li><a href="citation.php" title="Citation">Citation</a></li><br>
     
   </font></b></ul>
 
</td>


<td  width="65%" align="justify" valign="top"  cellspacing="6" cellpadding="2">	

  	<h4 align="center">About CanProVar</h4>

<p style="line-height:150%;font-size:12pt" >
 <b>CanProVar</b> is designed to store and display single amino acid alterations including both germline and somatic variations in the human proteome, especially those related to the genesis or development of human cancer based on the published literatures. Cancer-related variations and conrresponding annotations can be queried through the web-interface using Protein IDs in the Ensembl, IPI, RefSeq, and Uniport/Swiss-Prot databases or gene names and Entrez gene IDs. Fasta files with variation information are also available for download.  Please find the more details <a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=20052754[uid]&log$=activity' target='_blank'>here</a>.
</p>
 <br>
<hr width=98% color=grey size=1>
<p style="line-height:150%; font-size:12pt; color:blue">
<br><b>Updates and statistics</b></p>
<table width="95%" cellpadding="6" valign="top">
<tr><td><font color="blue">5/7/2010</font>&nbsp;</td><td>CanProVar was updated with 2,250 new cancer variations. 40 of the previous cancer variations became obsolete.  The same sources used previously were used for this update.  This brings the total to 11,445 cancer variations in CanProVar.  The coding SNPs have not changed and that number is still 41,541.</td>
</tr>
<tr><td><font color="blue">10/1/2009</font>&nbsp;</td><td>More than 1000 somatic mutations were revealed in lung cancer samples by <a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=18948947[uid]&log$=activity' target='_blank'> Ding et al (2008)</a>, of which 665 found new protein variations were added into CanProVar.</td>
</tr>
<tr><td><font color="blue">7/20/2009&nbsp;</font></td><td>8,570 distinct human cancer protein variaions were collected and integrated from <a href='http://www.sanger.ac.uk/genetics/CGP/cosmic/' target='_blank'> COSMIC</a>, <a href='http://ca.expasy.org/sprot/hpi/' target='_blank'>HPI</a>, <a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=omim' target='_blank'> OMIM</a>,<a href='http://cancergenome.nih.gov/about/index.asp' target='_blank'> TCGA</a>,<a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=17344846[uid]&log$=activity' target='_blank'>Greenman2007</a> and<a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=16959974[uid]&log$=activity' target='_blank'> Sjoblom2006</a>, also 41,541 coding SNPs from <a href='http://www.ncbi.nlm.nih.gov/projects/SNP/'> dbSNP</a>.</td>
</tr></table>
<!-- 
<table border=1 cellpadding="4">
 <tr align="center">
  <td>Date</td><td>Cancer related variations</td><td>Coding SNPs in dbSNP</td>
 </tr>
 <tr><td>7/20/2009&nbsp;&nbsp;</td><td> 8,570 </td> <td>41,541</td></tr>
 <tr><td>10/1/2009&nbsp;&nbsp;</td><td> 9,235 </td><td>41,541</td></tr>
 </table>
 -->

<br>
<hr width=98% color=grey size=1>
 <p style="line-height:150%; font-size:12pt;">
<br><b>Usage statistics since Feb 15, 2010</b></p>
<i>
<?
#  Place the date you start usage here
$usage_count = 0;
#  This is incremented with each fgets
$fp = fopen ("./stats/local_users.txt", "r")  or exit("Unable to open file for read");       
while (!feof($fp))
          {
            if ($usage_count == 0)
              {
                echo "The local usage count is ";
                echo "<b>";
		echo fgets($fp);
		echo "</b>";
              }
            elseif($usage_count==1)
              {
                echo "and the last date of local usage: ";
                echo "<b>";
		echo fgets($fp);
		echo "</b>";
                #exit;
	      }
           $usage_count++;
          }
fclose ($fp);
echo "<br />";
$usage_count = 0;      //  again incremented for fgets

$fp = fopen ("./stats/remote_users.txt", "r")  or exit("Unable to open file for read");            
while (!feof($fp))
          {
            if ($usage_count == 0)
                {
                  echo "The remote usage count is ";
                  echo "<b>";
		  echo fgets($fp);
		  echo "</b>";
                }
            else
                {
                  echo "and the last date of remote usage: ";
                 echo "<b>";
		 echo fgets($fp);
		 echo "</b>";
                }
           $usage_count++;
            }
fclose ($fp);

echo "<br />";
$usage_count = 0;   

$fp = fopen ("./stats/download_users.txt", "r")  or exit("Unable to open file for read");            
while (!feof($fp))
          {
            if ($usage_count == 0)
                {
                  echo "The data download count is ";
                  echo "<b>";
		  echo fgets($fp);
		  echo "</b>";
                }
            else
                {
                  echo "and the last date of data download: ";
                 echo "<b>";
		 echo fgets($fp);
		 echo "</b>";
                }
           $usage_count++;
            }
fclose ($fp);



?>
</i>
<br>
</td>
 <td width=5%></td>
 <tr>
</table>
</div>

<br><br>
<p align="center">
<?
 include("foot.html");
?>
</p>

</body>
</html>


<html>
<head>
<title>CanProVar Search</title>
<script src="sorttable.js"></script>

<style type="text/css">
body{color:black;font-family:"Verdana", "Arial", "Helvetica", "sans-serif";font-size:9pt;margin:0}
td{color:black;font-family:"Verdana", "Arial", "Helvetica", "sans-serif";font-size:9pt; line-height:150%}

th{color:black;font-family:"Verdana", "Arial", "Helvetica", "sans-serif";font-size:9pt; font-weight:bold; line-height:170%}

a:link       { text-decoration: none; color:#008080; font-size:9pt}
a:visited    { text-decoration: none; color: #008080 }a:hover      { color: #00FFCC }
input:hover { background: orange;}
div{color:#008080; line-height:180%}
div:hover {color:#00FFCC;}

h3{font-size:12pt; line-height:20%; padding: 1px;}

/*table.sortable thead { background-color: #eee; color:#666666 font-weight: bold;  cursor: default;} */

</style>
</head>

<body >
<p align="center">

	<?
	include("head.html");
        ?>

</p>
<br>
<br>




<table border="0.5" align="center" width="90%" cellspacing="2"  cellpadding="4">


<?php

session_start();


require ('include/locateconfig.inc.php');
$connection = db_connect();
$sampletype=$_POST['sampletype'];
if (ereg('.', $sampletype)){
       
       $sampletype1=preg_replace('/cancer/','',$sampletype);
       
       if (preg_match('/[a-z]/i', $sampletype1)){
         
        $query="select * from cancersnp10012009  where sample like '%$sampletype1%' order by symbol";
	$results= db_query ($connection, $query);
	$query_data=mysql_fetch_array($results);
	$protein=$query_data["protein"];
	if(is_null($protein)){
	   echo "<tr><td>No result was found</td></tr>";
	
       	}else{
	
	 $name=$query_data["symbol"];
	 $names["$protein"]=$name;
	  $pcount["$protein"]=1;
	// echo "<tr><td>$protein,$names[$protein],$pcount[$protein]</td></tr>";
	 
         while($query_data=mysql_fetch_array($results)){
	  $protein=$query_data["protein"];
	  $name=$query_data["symbol"];
	  $names["$protein"]=$name;
	  $pcount["$protein"]+=1;
	 // echo "<tr><td>$protein,$names[$protein],$pcount[$protein]</td></tr>";
	  
	 }
	echo "<tr><td><b>The cancer sample you queried:&nbsp;&nbsp;<font color='red'>'$sampletype'</font></b><br></td></td>";
	echo "<tr><td><b>Searching results are listed below:</b><br><br></td></tr>";
	
       echo "<table width=75% align=center border=0.5  class=\"sortable\" style=\"width: 800px;\">";
        echo"<tr align=center bgcolor='FFA500'><th height=32>NO.</th>";
	    echo "<th>protein</td><th>gene name</th><th>related variants</th><th bgcolor='white'></th></tr>";
	    $n=0;			    									
	   foreach ($names as $key => $value) {  
	     $n++;
	     echo "<tr  bgcolor='E6E6FA'  align=center><td>$n</td><td>$key</td><td>$value</td><td>$pcount[$key]</td>";
	     echo "<td align='left'bgcolor='white'> <form action='infor.php' target='_blank' method='POST' enctype='MULTIPART/FORM-DATA' style='margin:0px; display:inline'> <input type='hidden' name='id' value='$key'><input type='submit' value='query' style='font-size:9pt; color:green; border:none; border-bottom: 1px dotted green;'></form></td>";
		echo "</tr>";	  

        	 }
	
         }
	echo "</table>";
	 echo "<br><br><br><table align='center'><tr><td><font color='red'><b><a href='http://5ht.accre.vanderbilt.edu/canprovar/search.php'>[&nbsp;continue search&nbsp;]</a></b></font></td></tr></table>";
	 
     
      }else{
     echo "<tr><td>$sampletype is invalid keyword for the search of  sample type</td></tr><br>";
  }
}else{

$id=$_POST['id'];
$display=$_POST['display']; //array
echo "<tr><td>";
$id=trim($id);
echo "<b>ID you entered:</b> $id<br>";
//   $id=ereg_replace(^[\n\r\t\x0B],,$id);
//  $id=trim($id);
if (ereg ('^([0-9]|[a-zA-Z])', $id)){// $id is not null


if (ereg('^ENSP', $id)){
$proid=$id;
#       echo "$proid<br>";
}else{
$query="select * from new_idmap  where proid='$id' order by cs DESC,rs DESC";
$results=db_query ($connection, $query);
$query_data=mysql_fetch_array ($results);
$proid=$query_data["ensembl"];
if (is_null($proid)){
echo "<br><br><font color=red>Your input ID <b>$id </b>was not found in our database</font><br></td></tr>";
exit;
}else{

 $otherid=NULL;
 while($query_data=mysql_fetch_array($results)){
    $otherid.=$query_data['ensembl']."#";
 
 }

}
}

}else{
   if (ereg('.',$id)){
     echo "<br><br>Error: Invalidate ID was entered<br></td></tr>";
    }else{
    
     echo "<br><br>Error:No ID was entered<br></td></tr>";
    }
exit;
//   $query=NULL;
}



##########++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (!is_null($proid)){ #

     $query1="select * from ensemblpro53 where protein='$proid'";
     $results1= db_query ($connection, $query1);

  if (is_null ($results1)){
            echo "no  information was found  for the protein $proid<br>";
           exit;
   }else{
//  echo "<td>database query is ok </td><br>";

//display basic information of your target protein
      $query_data1=mysql_fetch_array($results1);

$entry=$query_data1["protein"];
echo "<b>Ensembl protein:</b>&nbsp;$entry&nbsp;&nbsp;&nbsp;";
if(!is_null($otherid)){
//echo "<font color='grey'>(also $otherid)</font><br>";
 echo "<nobr><font color='grey'>(also </font>";
 $otherids=split('#',$otherid);
 $n=0;
 foreach($otherids as $otherid){
 $n++;
 if($n==8){
#  echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  }
  if (ereg('ENSP', $otherid)){
     echo "<form action='infor.php' target='_blank' method='POST' enctype='MULTIPART/FORM-DATA' style='margin:0px; display:inline'>
         <input type='hidden' name='id' value='$otherid'>
          <input type='submit' value='$otherid' style='font-size:7pt; color:grey; border:none; border-bottom: 1px dotted green; backgound-color:white'></form>";
   }
 }
  echo "<font color='grey'>)</font></nobr>";
  
}
$click="document.all.child0.style.display=(document.all.child0.style.display=='none')?'':'none'";
echo "<div id=main0  onclick=$click>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;<b><u>Protein sequence</u></b>&nbsp;</div>";
#echo "<div id=main0 style=color:green  onclick=document.all.child0.style.display=(document.all.child0.style.display=='none')?'':'none'; style.color=red;>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;<u>sequence</u>&nbsp;</div>";

$querys="select * from sequences10012009 where protein='$entry'";
$resultss=db_query($connection, $querys);
if (!is_null($resultss)){
//           echo "<div id='child0' style='display:none'>&nbsp;&nbsp;hi</div>";

$query_datas=mysql_fetch_array($resultss);
$fullseq=$query_datas["seq"];
$rs=$query_datas["rs"];
$cs=$query_datas["cs"];
$rsn=explode(',', $rs);
$csn=explode(',', $cs);
$seq=preg_split('//', $fullseq);
echo "<div id='child0' style='display:none'>";
echo "<table>";
$p=-1;

foreach($seq as $amino){
    $p++;
     $b=fmod($p,60);
     if (($p==1)or ($b==1)){
                $l=11-strlen($p);
                $r=str_repeat('&nbsp;&nbsp;',$l );

                if($p==1){

                           echo "<br><tr><td>";
               }else{
                               echo"</td></tr><td>";
                }

              echo "$r<font color='grey'>$p</font>&nbsp;&nbsp;&nbsp;&nbsp;";
           }
     if (in_array($p, $csn)){
            echo "<span style='background:yellow'><font color='orangered' face='Courier'>$amino</font></span>";
        }elseif(in_array($p, $rsn)){
	     
             echo "<span style='background:#87cefa'><font color='0000FF' face='Courier'>$amino</font></span>";
       }else{
          echo "<font face='Courier'>$amino</font>";
        }
 }


echo "</font></td></tr></table>$r&nbsp;&nbsp;&nbsp;&nbsp;<font color='darkorange' size=18>.</font>&nbsp;<font color=black>cancer related</font>&nbsp;&nbsp;&nbsp;&nbsp;<font color='0000FF' size=20>.</font>&nbsp;<font color=black>dbSNP</font>";

echo "<br><br></div>";
}else{
echo "<div id='child0' style='display:none'>&nbsp;&nbsp;Not availale</div>"; 
}

}
//if (!is_null($otherid)){

//echo "<b>Other corresponding protein:</b> $otherid<br>";
//}
$genename="";
if (!is_null($entry)){

$entry=$query_data1["symbol"]; 
echo "<b>Name:</b> $entry<br>";
$genename=$entry;
$entry=$query_data1['description'];
echo "<b>Description:</b> $entry <br>";
$entry=$query_data1['chromsome'];
echo "<b>Location:</b>$entry";
$entry=$query_data1['position'];
echo "&nbsp;$entry<br>";
echo "<br><b>Gene Ontology:</b><br>";
}

// GO annotation
function formatgo($go){
 //echo "$go";
   $go1=split(';', $go);
   $gof=NULL;
   $goo=NULL;
   sort($go1); 
   $n=0;
   foreach($go1 as $go2){
     
    $go3=split(':',$go2);
     $go3[2]=trim($go3[2]);
     if(ereg($go3[2],$goo)){
    
     break;    
     }elseif(ereg('\w+', $go3[2])){
     
     break;
     }
   // echo "$go3[0]#$go3[1]#$go3[2]&nbsp;"; 
     //$n++;
    // $b=fmod($n, 3);
    // if(($n>3) and ($b==1)){
    // $gof.="<br>";
     //     }

     
    if (is_null($gof)){
      $gof="<a href=http://www.ebi.ac.uk/ego/GTerm?id=GO:$go3[1] target='_blank'>$go3[2]</a>";
      
    }else{
    $gof.="&nbsp;&nbsp;<font color=black>|</font>&nbsp;&nbsp;<a href=http://www.ebi.ac.uk/ego/GTerm?id=GO:$go3[1] target='_blank'>$go3[2]</a>";
    }
   $goo.=$go3[2]." ";
   
  }
//  echo "$gof";
   return $gof;
}

$query1="select * from bp where protein='$proid'";
$results1=db_query ($connection, $query1);
$query_data1=mysql_fetch_array($results1);
$entry=$query_data1["bp"];
if (is_null($entry)){
$bp="NA";
}else{
$bp=formatgo($entry);
}

$query1="select * from mf where protein='$proid'";
$results1=db_query ($connection, $query1);
$query_data1=mysql_fetch_array($results1);
$entry=$query_data1["mf"];
if (is_null($entry)){
$mf="NA";
}else{
$mf=formatgo($entry);
}
$query1="select * from cl where protein='$proid'";
$results1=db_query ($connection, $query1);
$query_data1=mysql_fetch_array($results1);
$entry=$query_data1["cl"];
if (is_null($entry)){
$cl="NA";
}else{
$cl=formatgo($entry);
}
						  
echo "<tr><td><div id=main1   onclick=document.all.child1.style.display=(document.all.child1.style.display=='none')?'':'none'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;<b><u>Biological process</u></b>&nbsp</div> <div id='child1' style='display:none'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$bp<br></div><div id=main2 style=';text-align:justify;text-justify:distribute-all-lines;' onclick=document.all.child2.style.display=(document.all.child2.style.display=='none')?'':'none'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;<b><u>Molecular function</u></b>&nbsp</div> <div id='child2' style='display:none'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$mf<br></div><div id=main1  onclick=document.all.child3.style.display=(document.all.child3.style.display=='none')?'':'none'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;<b><u>Cellular localization</u></b>&nbsp</div> <div id='child3' style='display:none'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cl</div></td></tr>";

// muted inteactants
if (!is_null($genename)){
 echo "<br><tr><td><b>Interaction partner with cancer_related variations :</b>";
 $query="select * from mneighbor where gene='$genename'";
 $result=db_query($connection, $query);
 $query_data=mysql_fetch_array($result);
 $neighbor=$query_data["neighbor"];
 $pvalue=$query_data["pvalue"];
 $k1=$query_data["k1"];
 if (is_null($neighbor)){
  echo "NA</td></tr><br>";
 }else{
  echo "&nbsp;&nbsp;(&nbsp; pvalue=$pvalue,&nbsp;hypergeometric test)";
  //echo "<tr><td>&nbsp;&nbsp;$k1</td></tr>";
  
 // echo "<tr><td>&nbsp;&nbsp;$neighbor</td></tr>";
    $neighbors=split(';',$neighbor);
    $nei0="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    $n=0;
    foreach($neighbors as $nei){
     $n++;
     $b=fmod($n,10);
    
     if($b==1){
     $nei0.= "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
     }
      $nei0.="<form action='infor.php' target='_blank' method='POST' enctype='MULTIPART/FORM-DATA' style='margin:0px; display:inline'>
                 <input type='hidden' name='id' value='$nei'>
	               <input type='submit' value='$nei' style='font-size:8pt; color:grey65; border:none; border-bottom: 1px dotted red; backgound-color:white'></form>&nbsp;&nbsp;";
    
    }
    echo "<div id=main4   onclick=document.all.child4.style.display=(document.all.child4.style.display=='none')?'':'none'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>$k1</u></b>&nbsp</div> <div id='child4' style='display:none'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$nei0<br></div></td></tr>";
    
 }

}


//rearch cancer-related dbSNP database

echo "<tr><td><br><b><li><font color='darkred'>Cancer-related variations in CanProVar:</font></li></b></td><tr>"; 


function pfamcall($protein, $position){
     $query="select * from pfam where protein='$protein' and start <= '$position' and end >= '$position'";
     $pfamresults=db_query($connection, $query);
     $pfams=NULL;
     while($query_pfam=mysql_fetch_array($pfamresults)){
        if (!is_null ($query['pfamid'])){
             $pfams.="<a href=http://pfam.sanger.ac.uk/family?acc=$query_pfam[pfamid] target='_blank'>$query_pfam[pfamid]</a>&nbsp;&nbsp;";
	  }
        }
  //   echo "<tr><td>$pfams</td></tr>";
   return $pfams;
}

//pfamcall("ENSP00000362458","34");

function sourcelink ($protein,$var,$source){
  $sources=split(",",$source);
  $newsource="";
  
  foreach($sources as $s){
  $s=trim($s);
  
  
   if(ereg('COSMIC',$s)){
    $query="select *  from cosmic_hyperlink where protein='$protein' and mutation='$var'";
    $cosmiclink=db_query($connection, $query);
    $query_source=mysql_fetch_array($cosmiclink);
       if(!is_null($query['sourceid'])){
         $newsource.="&nbsp;<a href='http://www.sanger.ac.uk/perl/genetics/CGP/cosmic?action=mut_summary&id=$query_source[sourceid]'  target='_blank'>$s</a>,";
	 }
	     
   }elseif(ereg('HPI', $s)){

   $query="select *  from hpi_hyperlink where protein='$protein' and mutation='$var'";
            $hpilink=db_query($connection, $query);
             $query_source=mysql_fetch_array($hpilink);
	           if(!is_null($query ['sourceid'])){
	           $newsource.="&nbsp;<a href='http://ca.expasy.org/cgi-bin/get-sprot-variant.pl?$query_source[sourceid]'  target='_blank'>$s</a>,";
		        }
		       
   
   }elseif(ereg('OMIM', $s)){
      $query="select *  from omim_hyperlink where protein='$protein' and mutation='$var'";
            $omimlink=db_query($connection, $query);
              $query_source=mysql_fetch_array($omimlink);
	            if(!is_null($query['sourceid'])){
	             $newsource.="&nbsp;<a href='http://www.ncbi.nlm.nih.gov/entrez/dispomim.cgi?id=$query_source[sourceid]'  target='_blank'>$s</a>,";
		      }
		       
   
   }elseif(ereg('Sjoblom', $s)){
     $newsource.="&nbsp;Sjoblom2006,"; 
 #   $newsource.="&nbsp;<a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=16959974[uid]&log$=activity' target='_blank'>Sjoblom2006</a>,";
    
   
   }elseif(ereg('Greenman', $s)){
     $newsource.="&nbsp;Greenman2007,";
     
   # $newsource.="&nbsp;<a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=1734484[uid]&log$=activity' target='_blank'>Greenman2007</a>,";
   
   
   }elseif(ereg('TCGA', $s)){
     $newsource.="&nbsp;TCGA,";
     
   #  $newsource.="&nbsp; <a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=18772890[uid]&log$=activity' target='_blank'>TCGA</a>,";
   
   }elseif(ereg ('Ding', $s)){
     $newsource.="&nbsp;Ding2008,";
     
    #   $newsource.="&nbsp;<a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=18948947[uid]&log$=activity' target='_        blank'>Ding2008</a>,";
   
     }
  
 else{
  $newsource.="#$s";
  }
   }#foreach

  $newsource=substr($newsource,0,-1);
  return  $newsource;

}

function blosum($var){
   $var1=substr($var,0,1);
   $var1.=substr($var,-1);
   $score="";
   $queryb="select * from blosum62 where aa='$var1'" ;
   $resultb=db_query ($connection, $queryb);
   $queryb_data=mysql_fetch_array($resultb);
   if(!is_null ($queryb_data['score'])){
    $score=$queryb_data['score'];
    if($score < 0){
    $score="<font color='red'>$score</font>"; 
     }
   }else{
   $score="-";
   
   }
  return $score;
}


echo "<table width=80% align=center border=0.5, class=\"sortable\", style=\"width: 800px;\">";
$query2="select * from cancersnp10012009 where protein='$proid' order by position"; 
$results2=db_query ($connection, $query2);
$query_data2=mysql_fetch_array($results2);
if (is_null ($query_data2['csid'])){

        echo "<tr><td><br>No cancer-related variation was found</td></tr>";
}else{
// $query_data2=mysql_fetch_array($result2);
//echo"<table align='center' border=1 width=70%>";
//     echo "<table align=center width=90%>";
   echo"<tr  align=center bgcolor='FFA500'>\n<th height=32>NO.</th><th>csID</th>";
    $displaynew[0]="csid";

     $displaynew[]="variation";
    echo "<th width=150>variation</th>";
    echo "<th>change conservation<sup>+</sup></th>";
    echo "<th>Domain</th>";
    echo"<th width=260>cancer sample</th>";
     $displaynew[]="sample";

      $displaynew[]="pubmed";
      echo "<th width=200>PubMed</th>";
      $displaynew[]="resource";
   
     echo "<th width=90>data source<sup>++</sup></th>";

         $displaynew[]="dbsnp";
    echo "<th width=120>validated dbSNP*</th>";
  #  echo "<td>Domain</td>";
    echo "</tr>";
 
 

$entry=NULL;
$n=1;  
// $query_data=mysql_fetch_array($results);
echo "<tr bgcolor='E6E6FA' style='hover{background:grey}'><td>$n</td>";
foreach ($displaynew as $term){
$entry=$query_data2[$term];
//    http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=16959974[uid]&log$=activity
if (ereg ('pubmed',$term)){
echo "<td>"; #PMID 

    $pt=0;
    $page="";
    $terms=split (', ', $entry);
    foreach($terms as $entrys){
    $pt++;
     $p=fmod($pt,3);
     if($p==1 and $pt >3) {
	   echo "<br>";
      }
	   ereg ('([0-9]+)$', $entrys, $pid); #$pid is a array
	   $page="http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=$pid[1][uid]&log$=activity";
	     if(!is_null($terms[$pt])){
	     echo "<a href=$page target='_blank'>$pid[1]</a>&nbsp&nbsp";
		  }else{
               echo "<a href=$page target='_blank'>$pid[1]</a>";
		   }
	  }
	  
	  echo "</td>";
											  
}elseif(ereg ('var', $term)){
echo "<td align=center><b>$entry</b></td>";
 $score=blosum($entry);
  echo "<td align=center>$score</td>";
   $entry=pfamcall($proid,$query_data2['position']);
     echo "<td>$entry</td>";
       
}elseif(ereg('sample',$term)){

  echo "<td>$entry</td>";


 }elseif(ereg ('resource', $term)){
     
        $entry=sourcelink($proid, $query_data2['variation'], $entry);
	       echo "<td>$entry</td>";
	     
}elseif(ereg('dbsnp', $term)){
      $page="http://www.ncbi.nlm.nih.gov/SNP/snp_ref.cgi?type=rs&rs=$entry";
       echo "<td><a href=$page target='_blank'>$entry</a></td>";
       
     }else{
echo "<td>$entry</td>";
}
 
}
#$entry=pfamcall($proid,$query_data2['position']);
#echo "<td>$entry</td>";
echo "</tr>";

while($query_data2 =mysql_fetch_array($results2)){
echo "<tr  bgcolor='E6E6FA'>";
$n++;

echo "<td>$n</td>";

foreach ($displaynew as $term){
$entry=$query_data2[$term];
if (ereg ('pubmed',$term)){
echo  "<td>"; #PMID:";
$pt=0;
$page="";
$terms=split (', ', $entry);
  foreach($terms as $entrys){
   $pt++;
   $p=fmod($pt,3);
   if($p==1 and $pt >3) {
    echo "<br>";
  }
      ereg ('([0-9]+)$', $entrys, $pid); #$pid is a array
     
     $page="http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=$pid[1][uid]&log$=activity";
 if(!is_null($terms[$pt])){
     echo "<a href=$page target='_blank'>$pid[1]</a>&nbsp&nbsp";
  }else{
    echo "<a href=$page target='_blank'>$pid[1]</a>";
  }
 }
echo "</td>";


}elseif(ereg('var', $term)){
echo "<td align=center width=35><b>$entry</b></td>";

   $score=blosum($entry);
     echo "<td align=center>$score</td>";
     $entry=pfamcall($proid,$query_data2['position']);
      echo "<td>$entry</td>";
      

}elseif(ereg('sample',$term)){
 echo "<td width=100>$entry</td>";
}elseif(ereg ('resource', $term)){

  $entry=sourcelink($proid, $query_data2['variation'], $entry);
  echo "<td>$entry</td>";

}elseif(ereg('dbsnp', $term)){
 $page="http://www.ncbi.nlm.nih.gov/SNP/snp_ref.cgi?type=rs&rs=$entry";
      echo "<td><a href=$page target='_blank'>$entry</a></td>";
     
 }else{
echo "<td>$entry</td>";
}
}
#$entry=pfamcall($proid,$query_data2['position']);
 #  echo "<td>$entry</td>";
    

echo "</tr>" ; 
}
// echo "<tr><td>*Cross-reference Database:<a href='http://ca.expasy.org/sprot/hpi/'>The Human Proteome Initiative (HPI)</a>; <a href='http://www.ncbi.nlm.nih.gov/projects/SNP/'>dbSNP</a></td></tr>";
}
echo "</table>";
if (!is_null ($displaynew[0])){

echo "<table width=80% align=center><tr><td><font size='1'><br><sup>+</sup>Conservation of amino acid substitutions are defined here according to the BLOSUM62 matrix, conservative changes were those having a positive or neutral sign in the matrix, whereas non-conservative changes were those having a negative value <a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=10391209[uid]&log$=activity' target='_blank'>(Cargill, et al. 1999)</a>. </br><sup>++</sup>Data sources:&nbsp;&nbsp;<a href='http://ca.expasy.org/sprot/hpi/' target='_blank'>HPI</a>,&nbsp;&nbsp;<a href='http://www.sanger.ac.uk/genetics/CGP/cosmic/' target='_blank'>COSMIC</a>,&nbsp;&nbsp;<a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=omim' target='_blank'>OMIM</a>,&nbsp;&nbsp;<a href='http://cancergenome.nih.gov/about/index.asp' target='_blank'>TCGA</a>,&nbsp;&nbsp;<a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=17344846[uid]&log$=activity' target='_blank'>Greenman2007</a>,&nbsp;&nbsp;<a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=16959974[uid]&log$=activity' target='_blank'>Sjoblom2006</a>,&nbsp;&nbsp;<a href='http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&cmd=DetailsSearch&term=18948947[uid]&log$=activity' target='_blank'>Ding2008</a><br>*Cross-reference databases: <a href='http://www.ncbi.nlm.nih.gov/projects/SNP/'>dbSNP</a></font></td></tr></table>";
}

//  echo "<hr color='4169E1' width=80% align=center><tr><td><br><br></td><tr>";


// display the information in dbSNP

// if(!in_array('onlyc',$display)){                                             testing 8.18.10
if (sizeof($display) == 0 || !in_array('onlyc', $display)){
echo "<br><br><table width=90% align=center><tr><td><li><b><font color='darkred'>Non-cancer specific variations derived from database dbSNP:</font></b></li><br></td></tr></table>";

$query3="select * from dbsnp53 where protein='$proid' order by position";
$results3=db_query($connection, $query3);
$query_data3=mysql_fetch_array($results3);

echo "<table width=80% align=center  class=\"sortable\" style=\"width: 800px;\">";
if (!is_null($query_data3['dbsnp'])){
// echo "<table width=80% align=center>";


echo"<tr align=center bgcolor='4169E1'>\n<th height=32>NO.</th><th>dbSNP_ID</th>";
$display2[0]="dbsnp";
$display2[]="variation";
echo "<th>variation</th>";
echo"<th>validated</th>";
$display2[]="validated";
echo "</tr>";
$entry=NULL;
$n=1;

echo "<tr bgcolor='E6E6FA'><td>$n</td>";
//      $query_data3=mysql_fetch_array($results3);
foreach ($display2 as $term){
$entry=$query_data3[$term];
if (ereg ('rs([0-9]+)$', $entry, $rid)){
$page="http://www.ncbi.nlm.nih.gov/SNP/snp_ref.cgi?type=rs&rs=$rid[1]";

echo "<td><a href=$page target='_blank'>$entry</a></td>";  


}elseif(ereg('var',$term)){
 echo "<td><font color='0000FF'>$entry</font></td>";
}else{
echo "<td>$entry</td>";
}
}
echo "</tr>";

while($query_data3 =mysql_fetch_array($results3)){
echo "<tr bgcolor='E6E6FA'>";
$n++;

echo "<td>$n</td>";

foreach ($display2 as $term){
$entry=$query_data3[$term];
if (ereg ('rs([0-9]+)$', $entry, $rid)){
$page="http://www.ncbi.nlm.nih.gov/SNP/snp_ref.cgi?type=rs&rs=$rid[1]";
  echo "<td><a href=$page target='_blank'>$entry</a></td>";
}elseif(ereg ('var', $term)){
  echo "<td><font color='0000FF'>$entry</font></td>";
}else{
		  
echo "<td>$entry</td>";
}
}

echo "</tr>";
}



}else{

echo "<tr><td><br>No entry in dbSNP was found</td></tr>";
}

echo "</table>";
} #onlyc


 echo "<br><br><br><table align='center'><tr><td><font color='red'><b><a href='http://5ht.accre.vanderbilt.edu/canprovar/search.php'>[&nbsp;continue search&nbsp;]</a></b></font></td></tr></table>";
  }
}
db_disconnect($conection);
?>
</table>
<br><br><br>
<?
include("foot.html");
?>
</body></html>

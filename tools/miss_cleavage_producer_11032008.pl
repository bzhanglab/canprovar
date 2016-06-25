#!/user/bin/perl/ -w
#Nov 3, 2008
#Author: Jing Li
#Produce the peptides with n miss-tryptic-cleavages from fullly-digested ones.
use strict;
#use warnings;

use Getopt::Std;

my %args;
my $usage = "Subject: produce the peptides with n miss-tryptic-cleavages from fullly-digested ones.
             Usage:
             miss_cleavage_producer_11032008.pl
                           -i <non-miss-cleavage peptide file> 
                              e.g. >ENSP00000251296|346-352|
                                       IVMTPSR
                           -s  <maximal number of miss-cleavage, [1 (default),]>  
                           -r <wheather only keep the peptides with the maximun miss-cleavage(s) , y->yes, n->no (default)>  \n";

getopt("i:s:r", \%args);

my $ifile=$args{i};
my $sfile=$args{s};
my $rfile=$args{r};
$sfile=1 unless defined $sfile;
$rfile="n" unless defined $rfile;
die $usage unless defined $ifile;
my $ofile="$ifile\_mc$sfile\.fa";

###############################################
sub read_pep{
	print "read the original peptide file\n";

#read the peptide file which contains the positon and variaiton information of peptides
############################################	
	my @pep=@_;
	my %from;
	my $num=0;
	for($num=0; $num <= $#pep; $num++){
		 chomp $pep[$num];		 		 
		if ($pep[$num]=~/^\>(\w+)\|(\d+)\-(\d+)\|/){
			chomp $pep[$num+1];
	#	print "$num\t$pep[$num]\n$pep[$num+1]\n";
				 
    
  		$from{$1}{$2}{$3}{"$'"} = $pep[$num+1];
  	
  		}
	
     }
	return %from;
	}
#--------------------------------------------







#######################################
sub miss_cleavage{  
	
	#add the miss-cleavage peptides
#######################################
 my %from=%{$_[0]};
 
 my $mc=$_[1];#the maxium cleavage-number
 my $r=$_[2]; # keep less miss-cleavage peptide or not
  my %tonew;
  my %to;
  for my $t(1..$mc){
  	print "miss_cleasvage $t\n";
     %to=%from if $t==1; 
    undef %tonew;
 	 for my $protein(keys %to){
 	 	 for my $f1 (sort {$a<=>$b} keys %{$to{$protein}}){
 	 	  for my $e1 (sort {$a<=>$b} keys %{$to{$protein}{$f1}}){
 	 	  	my $f2=$e1+1;
 	 	  	 for my $m1 (keys %{$to{$protein}{$f1}{$e1}}){
 	 	  	 	 print OUT ">$protein|$f1-$e1|$m1\n$to{$protein}{$f1}{$e1}{$m1}\n" if ($r eq "n"); # print less-miss-cleavage
 	 	  	 	 for my $e2 (sort {$a<=>$b} keys %{$from {$protein}{$f2}}){ #%from is original non-miss-cleavage peptide
 	 	  	 	 	 for my $m2 (keys %{$from{$protein}{$f2}{$e2}}){
 	 	  	 	 	 	my $m22="";
 	 	  	 	 	 	my @m2=split /\|/, $m2;
 	 	  	 	 	 	for (@m2){
 	 	  	 	 	 		next unless /\w+/;
 	 	  	 	 	 		next if ($m1=~/$_/); # remove redundancy
 	 	  	 	 	 		$m22.="\|$_";
 	 	  	 	 	 		}
 	 	  	 	 	 	  $tonew{$protein}{$f1}{$e2}{$m1.$m22}="$to{$protein}{$f1}{$e1}{$m1}$from{$protein}{$f2}{$e2}{$m2}";
 	 	  	 	 	 	}
 	 	  	 	 		 	  	 	 	
 	 	  	 	 	}#e2

 	 	  	 	  	 	 	  	 
 	 	  	 }
 	 	    }
 	 	  }
 	 	}
   %to=%tonew;
 
 	
 	}# the permitted miss cleavage number

 for my $protein3(keys %tonew){ #final peptides with $r miss-cleavage
	  for my $f3  (sort {$a<=>$b}keys %{$tonew{$protein3}}){
	   for my $e3 (sort {$a<=>$b} keys %{$tonew{$protein3}{$f3}}){
	    for my $m3 ( keys %{$tonew{$protein3}{$f3}{$e3}}){
	      print OUT ">$protein3|$f3-$e3|$m3\n$tonew{$protein3}{$f3}{$e3}{$m3}\n";
	     
	     }
	   }
	  }  
 }
}
#--------------------------------------------------

#****************************************************
open (IN, $ifile)||die "$!";
open (OUT,">$ofile");
my @ifile=<IN>;
close IN;
my %from=&read_pep(@ifile);
&miss_cleavage(\%from, $sfile, $rfile);
print "The updated peptides were printed in $ofile\n";

close OUT;
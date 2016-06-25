#!/user/bin/perl/ -w
#Nov 10, 2008
#Author: Jing Li
#Reverse the fasta sequences.
use strict;
#use warnings;

use Getopt::Std;

my %args;
my $usage = "Subject: Reverse the fasta sequences.
             Usage:
             dbreverser11102008.pl
                           -i < FASTA file *.fasta> 
                              e.g. >ENSP00000251296|346-352|
                                   IVMTPSR
                           -r  <only reverse seqences? y->yes, n->no(default)>\n";

getopt("i:r", \%args);

my $ifile=$args{i};
my $r=$args{r};
$r="n" unless defined $r;

die $usage unless defined $ifile;



open (IN, $ifile)||die "$!";
$ifile=~s/(\.fa|\.fasta)$//g;
my $ofile="$ifile\-reverse.fasta";
open (OUT, ">$ofile");
my $head="";
my $rseq="";
my $seq="";
my $n=0;
while(<IN>){
	chomp;
	if(/^\>(.+)$/){
		if (($head ne "") and ($seq ne "")){
		print OUT ">$head\n$seq\n" if ($r eq "n");
		$rseq=reverse ($seq);
	  print OUT ">rev_$head\n$rseq\n";
	   }
		$head=$1;
		$n++;
		print "$n\n";
		$seq="";		
	}else{
	  
	 $seq.=$_;
	  
	
	 }
		
	}
print OUT ">$head\n$seq\n" if ($r eq "n");
		$rseq=reverse ($seq);
	  print OUT ">rev_$head\n$rseq\n";	
print "the revese seqences were printed into $ofile\n";
close IN;
close OUT;
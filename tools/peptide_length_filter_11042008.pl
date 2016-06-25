#!/user/bin/perl/ -w
#Nov 4, 2008
#Author: Jing Li
#Filter peptides based on the requirment of length.
use strict;
#use warnings;

use Getopt::Std;

my %args;
my $usage = "Subject: Filter peptides based on the requirment of length.
             Usage:
             miss_cleavage_producer_11032008.pl
                           -i <peptide file in FASTA > 
                              e.g. >ENSP00000251296|346-352|
                                   IVMTPSR
                           -a  <minimal length of peptide>  
                           -b <maximal length of peptide>  \n";

getopt("i:a:b", \%args);

my $ifile=$args{i};
my $a=$args{a};
my $b=$args{b};

die $usage unless defined $ifile and defined $a and defined $b;
my $ofile="$ifile\_$a\-$b\.fa";

open (IN, $ifile)||die "$!";
my @input=<IN>;
close IN;

open (OUT, ">$ofile");
for (my $num=0; $num<=$#input; $num++){
	chomp $input[$num];
	if ($input[$num]=~/^\w+/){
		my $len=length ($input[$num]);
		
	  print OUT "$input[$num-1]\n$input[$num]\n" if ($len >= $a and $len<= $b);
		
		
		}
	}
print "the filtered data is printed into $ofile\n";
close OUT;
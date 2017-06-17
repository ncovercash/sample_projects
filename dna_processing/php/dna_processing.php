<?php

$codons = Array(
"GCU" => "Ala",
"GCC" => "Ala",
"GCA" => "Ala",
"GCG" => "Ala",
"CGU" => "Arg",
"CGC" => "Arg",
"CGA" => "Arg",
"CGG" => "Arg",
"AGA" => "Arg",
"AGG" => "Arg",
"AAU" => "Asn",
"AAC" => "Asn",
"GAU" => "Asp",
"GAC" => "Asp",
"UGU" => "Cys",
"UGC" => "Cys",
"GAA" => "Glu",
"GAG" => "Glu",
"CAA" => "Gln",
"CAG" => "Gln",
"GGU" => "Gly",
"GGC" => "Gly",
"GGA" => "Gly",
"GGG" => "Gly",
"CAU" => "His",
"CAC" => "His",
"AUU" => "Ile",
"AUC" => "Ile",
"AUA" => "Ile",
"UUA" => "Leu",
"UUG" => "Leu",
"CUU" => "Leu",
"CUC" => "Leu",
"CUA" => "Leu",
"CUG" => "Leu",
"AAA" => "Lys",
"AAG" => "Lys",
"AUG" => "Met",
"UUU" => "Phe",
"UUC" => "Phe",
"CCU" => "Pro",
"CCC" => "Pro",
"CCA" => "Pro",
"CCG" => "Pro",
"UCU" => "Ser",
"UCC" => "Ser",
"UCA" => "Ser",
"UCG" => "Ser",
"AGU" => "Ser",
"AGC" => "Ser",
"UAA" => "STOP",
"UAG" => "STOP",
"UGA" => "STOP",
"ACU" => "Thr",
"ACC" => "Thr",
"ACA" => "Thr",
"ACG" => "Thr",
"UGG" => "Trp",
"UAU" => "Tyr",
"UAC" => "Tyr",
"GUU" => "Val",
"GUC" => "Val",
"GUA" => "Val",
"GUG" => "Val");

function toRNA(string $dna) : string {
	$strArr = str_split($dna);
	$newArr = Array();
	foreach ($strArr as $acid) {
		switch ($acid) {
			case "A":
				$newArr[] = "U";
				break;
			case "T":
				$newArr[] = "A";
				break;
			case "G":
				$newArr[] = "C";
				break;
			case "C":
				$newArr[] = "G";
				break;
		}
	}
	return implode("", $newArr	);
}

function getCodon(string $in) : string {
	global $codons;
	return $codons[$in];
}

function toSeparateStrands(string $in) : array {
	$strands = Array();
	for ($i=0; $i < strlen($in); $i+=3) { 
		echo getCodon(substr($in, $i, 3))."\n";
		if (getCodon(substr($in, $i, 3)) == "STOP") {
			$strands[] = substr($in, 0, $i+3);
			$in = substr($in, $i+3);
		}
	}
	$strands[] = $in;
	return $strands;
}

$input = "TACGTACCAGTATAGACCATAGATAGATAGGGATAGTAAATTTACATGCGAGCTAGATATATAGGTAGTGATAGATTAGGGCTAATCTACATATGCGCCGAGCGCTAGCGATAGAGAGTAGTAGCGATGTAGATTTACATAGCGGGCCGTCTCACATACGCATATTACGACGATTGGATTTACCGCGATACGGTCAGAGTAGGCGCAGGAATCTACTTATATTTATAGCGCCACGGATGTGGTAGACAGATAACT";

var_dump(toSeparateStrands(toRNA($input)));

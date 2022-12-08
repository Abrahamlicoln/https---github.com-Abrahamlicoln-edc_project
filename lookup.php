<?php
$string = "DSTV (90 => DSTV Padi - N2150, 91 => DSTV Yanga - N2950, 92 => DSTV Confam - N5300, 93 => DSTV Compact - N9000, 105 => DSTV Compact Plus - N14,250, 106 => DSTV Premium - N21,000, 107 => DSTV Padi + ExtraView - N5,050, 108 => DSTV Yanga + ExtraView - N5,850, 109 => DSTV Confam + ExtraView - N8,200, 110 => DSTV Compact + Extra View - N11,900, 111 => DSTV Premium + Extra View - N23,900, 113 => DStv Premium-French N29,300, 114 => DStv Compact + French Touch N11,650, 115 => DStv Compact + French Touch + ExtraView N14,550, 116 => DStv Compact Plus + French Plus N23,550, 117 => DStv Compact Plus + French Touch N16,900, 118 => DStv Compact Plus + FrenchPlus + Extra View N26,450, 119 => DStv Compact + French Plus N18,300, 120 => DStv Premium + French + Extra View N28,000, 121 => DStv French Plus Add-on N9,300, 122 => DStv French Touch Add-on N2,650, 123 => DStv French 11 N4,100).
GOTV (94 => GOTV Smallie - N900, 95 => GOTV Max - N4150, 96 => GOTV Jolli - N2800, 97 => GOTV Jinja - N1900, 98 => GOTV Smallie-Quaterly - N2400, 99 => GOTV Smallie-Yearly - N7000, 112 => GOTV Supa - N5,500).
STARTIMES (100 => StarTimes Nova - N900, 101 => StarTimes Basic - N1850, 102 => StarTimes Smart - N2600, 103 => StarTimes Classic - N2750, 104 => StarTimes Super - N4900).";
$string = str_replace(",", ".", $string);
$main_string = preg_split("/\./", $string);
echo "<pre>";
var_dump($main_string);
echo "</pre>";

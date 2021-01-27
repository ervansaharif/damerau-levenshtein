<?php
require_once('DL.php');

//subtitution 
echo "jarak antara kata merah dengan merxh adalah ".$dl->get_distance('merah','merxh');
echo "<br>";

//insertion
echo "jarak antara kata kuning dengan kunings adalah ".$dl->get_distance('kuning','kunings');
echo "<br>";

//deletion
echo "jarak antara kata hijau dengan hija adalah ".$dl->get_distance('hijau','hija');
echo "<br>";

//transposition
echo "jarak antara kata jingga dengan jingag adalah ".$dl->get_distance('jingga','jingag');
echo "<br>";



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApisController extends Controller
{
    // Sort string function: Sorts any string in this form "aAbB...zZ12...9"
    // Note: Can be implemented in a more efficient way 
    function sortString($string) {
        $sorted = "";
        $lower = "";
        $capital = "";

        // Ascii value of letter "a"
        $small_letter = 97;
        // Ascii value of letter "A"
        $capital_letter = 65;
        // Ascii value of number "0"
        $number_asci = 48;
        // Length of the input string
        $length = strlen($string);

        // This loop sorts the characters first "aAbB...zZ"
        // Fisrt loop to iterate over every letter in the alphabet in order
        for($j=0; $j<26; $j++) {
            // Second loop tpo iterate over every character in the string and compare it to the current alphabatical character
            for($i=0; $i<$length; $i++) {
                $asci = ord($string[$i]);
                if($asci == $small_letter) {
                    $lower .= $string[$i];
                }
                else if($asci == $capital_letter) {
                    $capital .= $string[$i];
                }
            }
            $sorted .= $lower.$capital;
            $small_letter +=1;
            $capital_letter+=1;
            $lower = "";
            $capital = ""; 
        }
        
        // This loop sorts the numbers inside the string and adds them to the end of the sorted string
        for($k=0; $k<10;$k++) {
            for($z=0; $z<$length; $z++) {
                $asci = ord($string[$z]);
                if($asci == $number_asci) {
                    $sorted .= $string[$z];
                }
            }
            $number_asci +=1;
        }

        return response()->json([
            $string => $sorted
        ]);
    }
} 

        
     
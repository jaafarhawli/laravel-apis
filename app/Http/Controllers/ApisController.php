<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApisController extends Controller
{
    function sortString($string) {
        $sorted = "";
        $lower = "";
        $capital = "";

        $small_letter = 97;
        $capital_letter = 65;
        $length = strlen($string);

        for($j=0; $j<26; $j++) {
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
        

        return response()->json([
            $string => $sorted
        ]);
    } 
}

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
            $small_letter++;
            $capital_letter++;
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
            $number_asci++;
        }

        return response()->json([
            $string => $sorted
        ]);
    }

    // Num to array function: Transforms any number into an array containing it's digits
    function numToArray($num) {
        
        $array = [];
        $digit = $num;
        $order = 1;

        // Adds each digit to the array 
        while($digit>9) {
            $lastDigit = $digit%10;
            $digit-=$lastDigit;
            $lastDigit*=$order;
            array_push($array, $lastDigit);
            $order*=10;
            $digit/=10;
        }

        // Push the first digit 
        array_push($array, $digit*$order);
        // Reverse the array
        $array=array_reverse($array);

        return response()->json([
            $num => $array
        ]);
    }

    // Num to binary function: Transforms any number inside a string into it's binary form
    function numToBinary($string) {
        
        $length = strlen($string);
        $counter = 0;
        $number = "";
        $int = 0;
        $outputString = "";
        $isNumber = false;

        // Loops over the string
        while($counter<$length) {
            $asci = ord($string[$counter]);
            // If a number is found, find all the following numbers and transform the whole final number into binary and add it to the output string
            if($asci>=48 && $asci<=57) {
                // Get the whole number
                while($asci>=48 && $asci<=57) {
                    $number.= $string[$counter];
                    $counter++;
                    $asci = ord($string[$counter]);
                }
                // Tramsform the number into binary
                $binary = decbin($number);
                $outputString.=$binary;
                $isNumber = true;
                $number = "";
            }
            // If the character is'nt a number
            if($isNumber == false) {
                $outputString.= $string[$counter];
                $counter++;
            }
            else $isNumber=false;
        }

        return response()->json([
            $string => $outputString
        ]);
    }

    // Prefix function: Evaluates the prefix notation expression of the given string for operators +,*
    function prefix($prefix) {

        $operation = $prefix[0];
        $length = strlen($prefix);
        $prefixChar = $prefix[2];
        $counter = 2;
        $result = 0;
        $number = "";

        // Case of adding operation
        if($operation=="+") {
            // Loop over the prefix string
            while($counter<$length) {
                $prefixChar = $prefix[$counter];
                // When there's no space, find the number
                if($prefixChar!= " ") {
                    // If the number is negative
                    if($prefixChar=="-") {
                        $counter++;
                        $prefixChar=$prefix[$counter];
                        $number.="-";
                        while($prefixChar!=" ") {
                            $prefixChar = $prefix[$counter];
                            $number .= $prefixChar;
                            $counter++;
                            // If the number is the last character in the string
                            if($counter>=$length) {
                                $result += $number;
                                return response()->json([
                                    $prefix => $result
                                ]);  
                            }
                        }
                    }
                    // If the number is positive
                    else {
                        while($prefixChar!=" ") {
                            $prefixChar = $prefix[$counter];
                            $number .= $prefixChar;
                            $counter++;
                            if($counter>=$length) {
                                $result += $number;
                                return response()->json([
                                    $prefix => $result
                                ]);  
                            }
                        }
                    }
                    
                    $result += $number;
                    $number = "";
                }
                // If there is a space, skip to the next character
                else {
                    $counter++;
                }                
            }
        }

        // Case of multiply operation 
        if($operation=="*") {
            
            $result = 1;
            while($counter<$length) {
                $prefixChar = $prefix[$counter];
                if($prefixChar!= " ") {
                    if($prefixChar=="-") {
                        $counter++;
                        $prefixChar=$prefix[$counter];
                        $number.="-";
                        while($prefixChar!=" ") {
                            $prefixChar = $prefix[$counter];
                            $number .= $prefixChar;
                            $counter++;
                            if($counter>=$length) {
                                $result *= $number;
                                return response()->json([
                                    $prefix => $result
                                ]);  
                            }
                        }
                    }
                    else {
                        while($prefixChar!=" ") {
                            $prefixChar = $prefix[$counter];
                            $number .= $prefixChar;
                            $counter++;
                            if($counter>=$length) {
                                $result *= $number;
                                return response()->json([
                                    $prefix => $result
                                ]);  
                            }
                        }
                    }
                    $result *= $number;
                    $number = "";
                }
                else {
                    $counter++;
                }                
            }
        }
        // Case of incorrect form (No + or * operator in the beginning of the string or there are other characters than integers inside the prefix string)
        return response()->json([
            $prefix => "Incorrect form"
        ]);
    }
} 

        
     
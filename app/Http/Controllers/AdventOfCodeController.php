<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AdventOfCodeController extends Controller
{
    public function index()
    {
        return view('advent-of-code.index');
    }

    public function day1()
    {
        $input = file_get_contents(storage_path('app/advent-of-code/day1.txt'));
    
        $lines = explode("\n", trim($input));
    
        $array1 = [];
        $array2 = [];
    
        foreach ($lines as $line) {
            list($num1, $num2) = explode('   ', $line);
            $array1[] = intval($num1);
            $array2[] = intval($num2);
        }
    
        sort($array1);
        sort($array2);
    
        $solution1 = 0;
        for ($i = 0; $i < count($array1); $i++) {
            $solution1 += abs($array1[$i] - $array2[$i]);
        }


        $countArray2 = array_count_values($array2);
        $solution2 = 0;
        foreach ($array1 as $num) {
            if (isset($countArray2[$num])) {
                $solution2 += $num * $countArray2[$num];
            }
        }
    
        return view('advent-of-code.day1', compact('solution1', 'solution2'));
    }

    public function day2()
    {
        $solution = 0;
        $input = file_get_contents(storage_path('app/advent-of-code/day2.txt'));
    
        $lines = explode("\n", trim($input));
        $values = [];
    
        foreach ($lines as $line) {
            $line = array_map('intval', explode(' ', trim($line)));
            $values[] = $line;
        }
    
        foreach ($values as $value) {
            $isValid = true;
            $isIncreasing = true;
            $isDecreasing = true;
    
            for ($i = 1; $i < count($value); $i++) {
                $difference = $value[$i] - $value[$i - 1];
                $absDifference = abs($difference);
    
                if ($absDifference < 1 || $absDifference > 3) {
                    $isValid = false;
                    break;
                }
    
                if ($difference < 0) {
                    $isIncreasing = false;
                } elseif ($difference > 0) {
                    $isDecreasing = false;
                }
            }
    
            if ($isValid && ($isIncreasing || $isDecreasing)) {
                $solution++;
                continue;
            }
    
            for ($j = 0; $j < count($value); $j++) {
                $temp = $value;
                array_splice($temp, $j, 1);
    
                $isValid = true;
                $isIncreasing = true;
                $isDecreasing = true;
    
                for ($i = 1; $i < count($temp); $i++) {
                    $difference = $temp[$i] - $temp[$i - 1];
                    $absDifference = abs($difference);
    
                    if ($absDifference < 1 || $absDifference > 3) {
                        $isValid = false;
                        break;
                    }
    
                    if ($difference < 0) {
                        $isIncreasing = false;
                    } elseif ($difference > 0) {
                        $isDecreasing = false;
                    }
                }
    
                if ($isValid && ($isIncreasing || $isDecreasing)) {
                    $solution++;
                    break;
                }
            }
        }
    
        return view('advent-of-code.day2', compact('solution'));
    }
}

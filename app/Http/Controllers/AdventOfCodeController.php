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
}

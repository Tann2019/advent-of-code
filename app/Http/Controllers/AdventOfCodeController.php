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
    
        $solution = 0;
        for ($i = 0; $i < count($array1); $i++) {
            $solution += abs($array1[$i] - $array2[$i]);
        }
    
        return view('advent-of-code.day1', compact('solution'));
    }
}

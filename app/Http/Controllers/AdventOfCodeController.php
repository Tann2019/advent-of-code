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
        $startTime = microtime(true);
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
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        $executionTime = $executionTime * 1000;

        return view('advent-of-code.day1', compact('solution1', 'solution2', 'executionTime'));
    }

    public function day2()
    {
        $startTime = microtime(true);
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
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        $executionTime = $executionTime * 1000;

        return view('advent-of-code.day2', compact('solution', 'executionTime'));
    }

    public function day3()
    {
        $startTime = microtime(true);

        //part 1
        $solution = 0;
        $input = file_get_contents(storage_path('app/advent-of-code/day3.txt'));

        preg_match_all('/(mul)\((\d+),(\d+)\)/', $input, $matches);

        for ($i = 0; $i < count($matches[0]); $i++) {
            $solution += $matches[2][$i] * $matches[3][$i];
        }

        //part 2
        $solution = 0;

        preg_match_all('/(do\(\))|don\'t\(\)|(mul)\((\d+),(\d+)\)/', $input, $matches, PREG_SET_ORDER);

        $isValid = true;

        foreach ($matches as $match) {
            if (isset($match[0]) && $match[0] == 'do()') {
                $isValid = true;
                continue;
            } elseif (isset($match[0]) && $match[0] == 'don\'t()') {
                $isValid = false;
            } elseif ($isValid) {
                $solution += $match[3] * $match[4];
            }
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        $executionTime = $executionTime * 1000;

        return view('advent-of-code.day3', compact('solution', 'executionTime'));
    }
}

<?php

require_once 'Euler.php';

// capped at 1000000000 instead of 1000
class ExtremeEulerSolution001 extends AbstractEulerSolution {
    // amateur solution, checks all numbers 0-100000000
    public static function solution0() : float {
        $total = 0.0;

        for ($i=0; $i < 100000000; $i++) { 
            if ($i % 3 == 0 || $i % 5 == 0) {
                $total += $i;
            }
        }
        
        return $total;
    }

    // checks if % 15 on 3 loop
    public static function solution1() : float {
        $total = 0.0;

        for ($i=3; $i<100000000; $i+=3) { 
            if ($i % 15 != 0) {
                $total += $i;
            }
        }

        for ($i=5; $i<100000000; $i+=5) {
            $total += $i;
        }

        return $total;
    }

    // checks if % 15 on 5 loop
    public static function solution2() : float {
        $total = 0;

        for ($i=3; $i<100000000; $i+=3) { 
            $total += $i;
        }

        for ($i=5; $i<100000000; $i+=5) {
            if ($i % 15 != 0) {
                $total += $i;
            }
        }

        return $total;
    }

    // subtracts 15 at end, as modulo is expensive
    public static function solution3() : float {
        $total = 0;

        for ($i=3; $i<100000000; $i+=3) { 
            $total += $i;
        }

        for ($i=5; $i<100000000; $i+=5) {
            $total += $i;
        }

        for ($i=15; $i<100000000; $i+=15) {
            $total -= $i;
        }

        return $total;
    }

    // helper for solution 5
    public static function helperSumDivisibleBy(int $n, int $cap) : float {
        $p = (int)(($cap+$n-1)/$n);
        return $n*($p*($p-1)) / 2;
    }

    // uses project euler's analysis
    public static function solution4() : float {
        return self::helperSumDivisibleBy(3, 100000000)+self::helperSumDivisibleBy(5, 100000000)-self::helperSumDivisibleBy(15, 100000000);
    }

    public static function getKnownCorrectAnswer() : float { return 2333333316666668; }
}

new ExtremeEulerSolution001();

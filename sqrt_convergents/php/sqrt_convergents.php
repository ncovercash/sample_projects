<?php
$start = microtime(true);
$total = 0;
$num = gmp_init(0);
$den = gmp_init(1);

/*
 * Proof this works:
 * ln       |   num     |   denom   |   oldNum
 * 33       |   0       |   1       |   0
 * 34       |   1       |   1       |   0
 * 35       |   1       |   2       |   0
 * 36       |   1       |   2       |   0 
 * 
 * // 1/2 + 1 = 3/2
 *          |           |           |
 * 33       |   1       |   2       |   1
 * 34       |   2       |   2       |   1
 * 35       |   2       |   4       |   1
 * 36       |   2       |   5       |   1 
 * 
 * // 2/5 + 1 = 7/5
 *          |           |           |
 * 33       |   2       |   5       |   2
 * 34       |   5       |   5       |   2
 * 35       |   5       |   10      |   2
 * 36       |   5       |   12      |   2 
 *
 * // 5/12 + 1 = 17/12
 */

for ($i=0; $i < 1000; $i++) { 
    $oldNum = gmp_init(gmp_strval($num));
    $num = $den;
    $den = gmp_mul($den, gmp_init(2));
    $den = gmp_add($den, $oldNum);
    $realNum = gmp_add($den, $num);
    if (strlen(gmp_strval($realNum)) > strlen(gmp_strval($den))) {
        $total++;
    }
}

var_dump($total);
echo microtime(true) - $start;

<?php

abstract class AbstractEulerSolution {
    public const MAX_TESTS = 100;
    public const MAX_TIME_FOR_TESTS = 20;

    public static abstract function getKnownCorrectAnswer() : float;

    public static function getAllSolutions() : array {
        $allFunctions = get_class_methods(get_called_class());

        $solutions = Array();

        foreach ($allFunctions as $funcname) {
            if (strpos($funcname, "solution") === 0) {
                $solutions[] = get_called_class()."::".$funcname;
            }
        }

        return $solutions;
    }

    public static function findBestSolution() : ?callable {
        $results = benchmarkSolutions(false);

        $fastest = null;

        for ($i=0;$i<count($results);$i++) {
            if (!$results[$i][2]) {
                continue;
            }
            if ($results[$i][0] < $results[$i][0]) {
                $fastest = $i;
            }
        }

        return ($fastest === null ? null : self::getAllSolutions()[$fastest]);
    }

    public static function benchmarkSolutions(bool $print=true) : array {
        $results = Array();
        $solutions = self::getAllSolutions();

        if ($print) {
            echo "# | Correct | Average Time    | Number of Tests\n";
        }

        for ($i=0; $i<count($solutions); $i++) {
            $solutionOverallStartTime = microtime(true);
            $numTests = 0;

            $tests = Array();

            $correct = true;

            $answer;

            while ($correct && ($numTests < 2 || microtime(true) - $solutionOverallStartTime < self::MAX_TIME_FOR_TESTS) && $numTests < self::MAX_TESTS) { // must be correct to do more
                $start = microtime(true);

                $answer = $solutions[$i]();

                $tests[] = microtime(true) - $start;

                $correct = self::checkAnswer($answer);

                $numTests++;

                if ($print) {
                    echo "#";
                }
            }

            $averageTime = array_sum($tests)/count($tests);

            $results[$i] = Array($averageTime, $tests, $correct);

            if ($print) {
                $fullLine = $i." | ".($correct ? "true   " : "false  ")." | ".self::padTimeToLength($averageTime, 15)." | ".$numTests;
                if (!$correct) {
                    $fullLine .= str_repeat(" ", 15-strlen($numTests))." - answer: ".$answer;
                }
                echo "\r\033[K\r".$fullLine."\n";
            }
        }

        return $tests;
    }

    public static function padTimeToLength(float $time, int $length) : string {
        $time = number_format($time, 4, ".", "")."s";
        if (strlen($time) == $length) {
            // do nothing
        } else if (strlen($time) < $length) {
            do {
                $time .= " ";
            } while (strlen($time) < $length);
        } else {
            $time = substr($time, 0, $length);
        }
        return $time;
    }

    public static function checkAnswer(float $test) : bool {
        return abs(static::getKnownCorrectAnswer() - $test) < static::getEpsilon();
    }

    public function __construct() {
        echo "Expecting result: ".static::getKnownCorrectAnswer()."\n";
        self::benchmarkSolutions(true);
    }

    public static function getEpsilon() : float {
        return 0.00001; // 5 dec
    }
}


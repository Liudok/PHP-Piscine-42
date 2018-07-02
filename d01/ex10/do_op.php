#!/usr/bin/php
<?php

function not_valid($n)
{
    $i = 0;
    if ($n[$i] == '-' || $n[$i] == '+')
        $i++;
    while ($n[$i])
    {
        if (ord($n[$i]) < 48 || ord($n[$i]) > 57)
            return (1);
        $i++;
    }
    return (0);
}

if ($argc != 4)
{
    echo "Incorrect Parameters\n";
    exit (0);
}
else
{
    $n1 = trim($argv[1]);
    $n2 = trim($argv[3]);
    if (not_valid($n1) || not_valid($n1))
    {
        echo "Incorrect Parameters\n";
        exit (0);
    }
    $sign = trim($argv[2]);
	if ($sign == "+")
        print($n1 + $n2);
    else if ($sign == "-")
        print($n1 - $n2);
    else if ($sign == "*")
        print($n1 * $n2);
    else if ($sign == "/")
    {
        if ($n2 == 0)
        {
            echo "divicion by 0 is not allowed!\n";
            exit(-1);
        }
        print($n1 / $n2);
    }
    else if ($sign == "%")
    {
        if ($n2 < 1 && $n2 > -1)
        {
            echo "Invalid modulo arguments!\n";
            exit(-1);
        }
        print($n1 % $n2);
    }
    else
    {
        echo "Incorrect Parameters\n";
        exit(-1);
    }
    print("\n");
}

?>
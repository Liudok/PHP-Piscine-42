#!/usr/bin/php
<?php
 
function remove_empty_members($value)
{
  return $value || is_numeric($value);
}

function ft_split($line)
{
	$trimmed = trim($line, " ");
	$arr = explode(" ", $trimmed);
	$arr = array_filter($arr, "remove_empty_members");
	return ($arr);
}

function is_letter($str)
{
    if ((ord($str[0]) >= 65 && ord($str[0]) <= 90) ||
        (ord($str[0]) >= 97 && ord($str[0]) <= 122))
        return (true);
    return (false);
}

function    priority($char)
{
    if (is_letter($char))
        return (3);
    if (is_numeric($char))
        return (2);
    return (1);
}

function    cmp($s1, $s2)
{
    $i = 0;
    $s1 = strtolower($s1);
    $s2 = strtolower($s2);
    while ($s1[$i] == $s2[$i] && $s1[$i] && $s1[$i])
        $i++;
    if ($s1[$i] == $s2[$i])
        return (0);
    $a = priority($s1[$i]);
    $b = priority($s2[$i]);
    if ($a == $b)
        return (strcmp($s1[$i], $s2[$i]));
    if ($a > $b)
        return (-1);
    else
        return (1);
}

if ($argc < 2)
    exit (0);

if ($argc > 1)
{
	$i = 2;
	$ret = ft_split($argv[1]);
	while ($i < $argc)
	{
	 	$arr = ft_split($argv[$i]);
	 	$ret = array_merge($ret, $arr);
		$i++;
	}
	usort($ret, "cmp");
	foreach ($ret as $value) {
			print($value."\n");
	}
}
?>
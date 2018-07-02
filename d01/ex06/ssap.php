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
		sort($ret);
		foreach ($ret as $value) {
			print($value."\n");
		}
	}
?>
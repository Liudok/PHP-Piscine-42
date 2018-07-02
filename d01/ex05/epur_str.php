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

	if ($argc == 2)
	{
	 	$arr = ft_split($argv[1]);
		$line = implode(" ", $arr);
		print($line."\n");
	}
?>
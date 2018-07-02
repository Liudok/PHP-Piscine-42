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
		$ret = ft_split($argv[1]);
		foreach ($ret as $value) {
			if ($value != $ret[0])
				print($value." ");
		}
		print($ret[0]."\n");
	}
?>
<?PHP

function remove_empty_members($value)
{
  return $value || is_numeric($value);
}

function ft_split($line)
{
	$trimmed = trim($line, " ");
	$arr = explode(" ", $trimmed);
	$arr = array_filter($arr, "remove_empty_members");
	sort($arr);
	return($arr);
}

?>
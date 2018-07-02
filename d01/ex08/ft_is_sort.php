<?php
 
	function ft_is_sort($arr)
	{
		$sorted = $arr;
		sort($sorted);
		foreach ($arr as $key=>$value) {
			if ($value != $sorted[$key])
				return (0);
		}
		return (1);
	}
	
?>
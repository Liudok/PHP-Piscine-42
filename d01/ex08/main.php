#!/usr/bin/php
<?php

// include("ft_split.php");
// print_r(ft_split("  Hello 8    World  oiu "));

include("ft_is_sort.php");
$tab = array("10", "42", "132");
// $tab = array("!/@#;^", "42", "Hello World", "hi", "zZzZzZz");
$tab[] = "What are we doing now ?";
if (ft_is_sort($tab))
	echo "The array is sorted\n";
else
	echo "The array is not sorted\n";


?>
#!/usr/bin/php
<?php
for ($i=0; $i > -1; $i++) {
	echo "Enter a number: ";
	 $line=trim(fgets(STDIN));
	if (feof(STDIN))
    {
        print("\n");
        break;
    }
    else
    {
		if (!is_numeric($line))
			echo "'".$line."' is not a number \n";
		else if ($line % 2 == 0)
			echo "The number ".$line." is even\n";
		else
			echo "The number ".$line." is odd\n";    	
    }
}
?>

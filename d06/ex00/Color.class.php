<?php

class Color {

	public $red = 255;
	public $green = 255;
	public $blue = 255;
	public static $verbose = False;

	function __construct($arr) {
		if (isset($arr['red']) && isset($arr['green']) && isset($arr['blue']))
		{
			$this->red = intval($arr['red']);
			$this->green = intval($arr['green']);
			$this->blue = intval($arr['blue']);
		
		}
		else if (isset($arr['rgb']))
		{
			$this->red = intval(($arr['rgb'] >> 16) & 255);
			$this->green = intval(($arr['rgb'] >> 8) & 255);
			$this->blue = intval($arr['rgb'] & 255);
		}
		else
			print("Bad call\n");
		if (self::$verbose == True)
			print ($this . " constructed." . PHP_EOL );
		return;
	}

	function __destruct () {
		if (self::$verbose == True)
			print ($this . " destructed." . PHP_EOL );
		return ;
	}

	function __toString()
	{
		$str = sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green,  $this->blue);
		return $str;
	}

	static function doc() {
		$file = file_get_contents('./Color.doc.txt', true);
		return $file;
	}

	function add( Color $rhs ) {
		$ret = new Color(array("red" => ($this->red + $rhs->red), "green" => ($this->green + $rhs->green), "blue" => ($this->blue + $rhs->blue)));
		return $ret;
	}

	function mult( $f ) {
		$ret = new Color(array("red" => ($this->red * $f), "green" => ($this->green * $f), "blue" => ($this->blue * $f)));
		return $ret;
	}

	function sub( Color $rhs ) {
		$ret = new Color(array("red" => ($this->red - $rhs->red), "green" => ($this->green - $rhs->green), "blue" => ($this->blue - $rhs->blue)));
		return $ret;
	}
}

?>
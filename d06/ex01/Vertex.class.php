<?php

require_once 'Color.class.php';

class Vertex {

	private $_x = 0.0;
	private $_y = 0.0;
	private $_z = 0.0;
	private $_w = 1.0;
	private $_color;
	public static $verbose = False;

	function __construct($arr) {

	    if (isset($arr['color']))
        {
            $this->setColor($arr['color']);
        }
        else
        {
            $this->_color  = new Color(array("rgb" => 0xffffff));
        }
        if (isset($arr['x']) && isset($arr['y']) && isset($arr['z']))
        {
            $this->setX($arr['x']);
            $this->setY($arr['y']);
            $this->setZ($arr['z']);
        }
        else
        {
            print ("In this case behavior is undefined" . PHP_EOL );;
        }
        if (isset($arr['w']))
        {
            $this->setW($arr['w']);
        }
        if (self::$verbose == True)
			print ($this . " constructed" . PHP_EOL );
		return;
	}

	function __destruct () {
		if (self::$verbose == True)
			print ($this . " destructed" . PHP_EOL );
		return ;
	}

    public function setX($x)
    {
        $this->_x = $x;
    }

    public function setY($y)
    {
        $this->_y = $y;
    }

    public function setZ($z)
    {
        $this->_z = $z;
    }

    public function setW($w)
    {
        $this->_w = $w;
    }

    public function setColor($color)
    {
        $this->_color = $color;
    }

	function __toString()
	{
        if (self::$verbose == True)
        {
            $str = sprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) )", $this->getX(), $this->getY(), $this->getZ(), $this->getW(), $this->getColor()->red, $this->getColor()->green,  $this->getColor()->blue);
        }
        else
        {
            $str = sprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f )", $this->getX(), $this->getY(), $this->getZ(), $this->getW());
        }
		return $str;
	}

	static function doc() {
		$file = file_get_contents('./Vertex.doc.txt', true);
		return $file;
	}

    public function getX()
    {
        return $this->_x;
    }

    public function getY()
    {
        return $this->_y;
    }

    public function getZ()
    {
        return $this->_z;
    }

    public function getW()
    {
        return $this->_w;
    }

    public function getColor()
    {
        return $this->_color;
    }
}

?>
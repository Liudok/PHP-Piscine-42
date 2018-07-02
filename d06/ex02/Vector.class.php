<?php

require_once 'Vertex.class.php';

class Vector {

	private $_x = 0.0;
	private $_y = 0.0;
	private $_z = 0.0;
	private $_w = 0.0;
	public static $verbose = False;

	function __construct($arr) {

        if (isset($arr['dest']) && isset($arr['orig']))
        {
            $this->_x = $arr['dest']->getX() - $arr['orig']->getX();
            $this->_y = $arr['dest']->getY() - $arr['orig']->getY();
            $this->_z = $arr['dest']->getZ() - $arr['orig']->getZ();
        }
        else if (isset($arr['dest']))
        {
            $ori = new Vertex(array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 ));
            $this->_x = $arr['dest']->getX() - $ori->getX();
            $this->_y = $arr['dest']->getY() - $ori->getY();
            $this->_z = $arr['dest']->getZ() - $ori->getZ();
        }
        else
        {
            print ("In this case behavior is undefined" . PHP_EOL );
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

   	function __toString()
	{
        $str = sprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", $this->getX(), $this->getY(), $this->getZ(), $this->getW());
		return $str;
	}

	static function doc() {
		$file = file_get_contents('./Vector.doc.txt', true);
		return $file;
	}

	function magnitude()
    {
        $ret = sqrt($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z);
	    return $ret;
    }

    function normalize()
    {
        $f = 1.0 / $this->magnitude();
        $ver = new Vertex( array( 'x' => ($this->_x * $f), 'y' => ($this->_y * $f), 'z' => ($this->_z * $f) ) );
        $ret = new Vector(array('dest' => $ver));
        return $ret;
    }

    function add( Vector $rhs )
    {
        $ver = new Vertex( array( 'x' => ($this->_x  + $rhs->_x), 'y' => ($this->_y + $rhs->_y), 'z' => ($this->_z + $rhs->_z) ) );
        $ret = new Vector(array('dest' => $ver));
        return $ret;
    }

    function sub( Vector $rhs )
    {
        $ver = new Vertex( array( 'x' => ($this->_x - $rhs->_x), 'y' => ($this->_y - $rhs->_y), 'z' => ($this->_z - $rhs->_z) ) );
        $ret = new Vector(array('dest' => $ver));
        return $ret;
    }

    function opposite()
    {
        $ver = new Vertex( array( 'x' => ($this->_x * (-1)), 'y' => ($this->_y * (-1)), 'z' => ($this->_z * (-1)) ) );
        $ret = new Vector(array('dest' => $ver));
        return $ret;
    }

    function scalarProduct( $k )
    {
        $ver = new Vertex( array( 'x' => ($this->_x * $k), 'y' => ($this->_y * $k), 'z' => ($this->_z * $k) ) );
        $ret = new Vector(array('dest' => $ver));
        return $ret;
    }

    function dotProduct( Vector $rhs )
    {
        $ret = ($this->_x * $rhs->_x ) + ($this->_y * $rhs->_y) + ($this->_z * $rhs->_z);
        return $ret;
    }

    function crossProduct( Vector $rhs )
    {
        $ver = new Vertex( array( 'x' => ($this->_y * $rhs->_z - $this->_z * $rhs->_y), 'y' => ($this->_z * $rhs->_x - $this->_x * $rhs->_z), 'z' => ($this->_x * $rhs->_y - $this->_y * $rhs->_x) ) );
        $ret = new Vector(array('dest' => $ver));
        return $ret;
    }

    function cos( Vector $rhs )
    {
        $ret = $this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude());
        return $ret;
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

}

?>
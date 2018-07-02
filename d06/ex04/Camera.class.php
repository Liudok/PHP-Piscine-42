<?php

require_once 'Matrix.class.php';

class Camera {

    private $_origin;
    private $_ori_vec;
    private $_tR;
    private $_tT;
    private $_orientation;
    private $_width;
    private $_height;
    private $_fov;
    private $_ratio;
    private $_near;
    private $_far;
    private $_projection;
    protected $matrix = array();
	public static $verbose = False;

	function __construct($arr) {
        $this->b_zero();
        if (isset($arr['origin']) && isset($arr['orientation']) && isset($arr['width']) && isset($arr['height']) && isset($arr['fov']) && isset($arr['near']) && isset($arr['far']))
        {
            $this->_origin = $arr['origin'];
            $this->_orientation = $arr['orientation'];
            $this->_width = $arr['width'] / 2;
            $this->_height = $arr['height'] / 2;
            $this->_fov = $arr['fov'];
            $this->_near = $arr['near'];
            $this->_far = $arr['far'];
            $this->_ori_vec = new Vector(array ('dest' => $this->_origin));
            $this->_ratio = $this->_width / $this->_height;
            $this->_projection = new Matrix(array('preset' => Matrix::PROJECTION, 'fov' => $arr['fov'],
                'ratio' => $this->_ratio, 'near' => $arr['near'], 'far' => $arr['far']));
        }
        else
            print ("In this case behavior is undefined" . PHP_EOL );

        $this->apply();

        if (self::$verbose == True)
        {
                print ("Camera instance constructed" . PHP_EOL );
        }
		return;
	}

	function __destruct () {
        Matrix::$verbose = False;
		if (self::$verbose == True)
			print ("Camera instance destructed" . PHP_EOL );
		return ;
	}

   	function __toString()
	{
        $str = sprintf("Camera( 
+ Origine: %s
+ tT:
%s
+ tR:
%s
+ tR->mult( tT ):
%s
+ Proj:
%s
)", $this->_origin, $this->_tT, $this->_tR, $this->_tR->mult($this->_tT), $this->_projection);
        return $str;
	}

	public static function doc() {
		$file = file_get_contents('./Camera.doc.txt', true);
		return $file;
	}

	function b_zero()
    {
        for($i = 0; $i < 16; $i++)
        {
            $this->matrix[$i] = 0;
        }
    }

    function apply()
    {
        $this->_tT = new Matrix( array( 'preset' => Matrix::TRANSLATION, 'vtc' => $this->_ori_vec->opposite() ) );
        $res = array();
        $j = 0;
        for($i = 0; $i < 16; $i++)
        {
            $res[$i] = $this->_orientation->getMatrix()[$j];
            $j += 4;
            if ($i == 3 || $i == 7 || $i == 11)
                $j = $j - 15;
        }
        $this->_tR = new Matrix(array('preset' => Matrix::FROM_ARRAY, 'matrix' => $res));
    }

    public function getFov()
    {
        return $this->_fov;
    }

    public function getRatio()
    {
        return $this->_ratio;
    }

    public function getNear()
    {
        return $this->_near;
    }

    public function getFar()
    {
        return $this->_far;
    }

    public function getMatrix()
    {
        return $this->matrix;
    }
}

?>
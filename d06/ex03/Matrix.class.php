<?php

require_once 'Vector.class.php';

class Matrix {

    const IDENTITY = "IDENTITY";
    const SCALE = "SCALE";
    const RX = "Ox ROTATION";
    const RY = "Oy ROTATION";
    const RZ = "Oz ROTATION";
    const TRANSLATION = "TRANSLATION";
    const PROJECTION = "PROJECTION";
    const FROM_ARRAY = "FROM_ARRAY";

    private $_preset;
    private $_scale;
    private $_angle;
    private $_vtc;
    private $_fov;
    private $_ratio;
    private $_near;
    private $_far;
    protected $matrix = array();
	public static $verbose = False;

	function __construct($arr) {

        if (!isset($arr['preset']))
            print ("In this case behavior is undefined" . PHP_EOL );
        else
            $this->_preset = $arr['preset'];
        $this->b_zero();
        if (isset($arr['vtc']))
            $this->_vtc = $arr['vtc'];
        if (isset($arr['scale']))
            $this->_scale = $arr['scale'];
        if (isset($arr['angle']))
            $this->_angle = $arr['angle'];
        if (isset($arr['fov']))
            $this->_fov = $arr['fov'];
        if (isset($arr['ratio']))
            $this->_ratio = $arr['ratio'];
        if (isset($arr['near']))
            $this->_near = $arr['near'];
        if (isset($arr['far']))
            $this->_far = $arr['far'];
        if (isset($arr['matrix']))
            $this->matrix = $arr['matrix'];
        $this->apply();
        if (self::$verbose == True)
        {
            if ($this->_preset == self::IDENTITY)
                print ("Matrix " . $this->_preset . " instance constructed" . PHP_EOL );
            else
                print ("Matrix " . $this->_preset . " preset instance constructed" . PHP_EOL );
        }
		return;
	}

	function __destruct () {
		if (self::$verbose == True)
			print ("Matrix instance destructed" . PHP_EOL );
		return ;
	}

   	function __toString()
	{
        $str = sprintf("M | vtcX | vtcY | vtcZ | vtxO
-----------------------------
x | %0.2f | %0.2f | %0.2f | %0.2f
y | %0.2f | %0.2f | %0.2f | %0.2f
z | %0.2f | %0.2f | %0.2f | %0.2f
w | %0.2f | %0.2f | %0.2f | %0.2f", $this->matrix[0], $this->matrix[1], $this->matrix[2], $this->matrix[3],  $this->matrix[4], $this->matrix[5], $this->matrix[6], $this->matrix[7],  $this->matrix[8], $this->matrix[9], $this->matrix[10], $this->matrix[11],  $this->matrix[12], $this->matrix[13], $this->matrix[14], $this->matrix[15]);
		return $str;
	}

	public static function doc() {
		$file = file_get_contents('./Matrix.doc.txt', true);
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
        if ($this->_preset == self::IDENTITY || $this->_preset == self::SCALE)
        {
            $this->_scale = isset($this->_scale) ? $this->_scale : 1;
            $this->identity($this->_scale);
        }
        else if ($this->_preset == self::TRANSLATION && isset($this->_vtc))
            $this->translation();
        else if ($this->_preset == self::RX && isset($this->_angle))
            $this->rotateX();
        else if ($this->_preset == self::RY && isset($this->_angle))
            $this->rotateY();
        else if ($this->_preset == self::RZ && isset($this->_angle))
            $this->rotateZ();
        else if ($this->_preset == self::PROJECTION && isset($this->_fov) && isset($this->_ratio) && isset($this->_near) && isset($this->_far))
            $this->projection();
    }

    private function identity($scale)
    {
        $this->matrix[0] = $scale;
        $this->matrix[5] = $scale;
        $this->matrix[10] = $scale;
        $this->matrix[15] = 1;
    }

    private function translation()
    {
        $this->identity(1);
        $this->matrix[3] = $this->_vtc->getX();
        $this->matrix[7] = $this->_vtc->getY();
        $this->matrix[11] = $this->_vtc->getZ();
    }

    private function rotateX()
    {
        $this->identity(1);
        $this->matrix[5] = cos($this->_angle);
        $this->matrix[6] = -sin($this->_angle);
        $this->matrix[9] = sin($this->_angle);
        $this->matrix[10] = cos($this->_angle);
    }
    private function rotateY()
    {
        $this->identity(1);
        $this->matrix[0] = cos($this->_angle);
        $this->matrix[2] = sin($this->_angle);
        $this->matrix[8] = -sin($this->_angle);
        $this->matrix[10] = cos($this->_angle);
    }
    private function rotateZ()
    {
        $this->identity(1);
        $this->matrix[0] = cos($this->_angle);
        $this->matrix[1] = -sin($this->_angle);
        $this->matrix[4] = sin($this->_angle);
        $this->matrix[5] = cos($this->_angle);
    }
    private function projection()
    {
        $this->matrix[0] = 1/tan(deg2rad($this->_fov / 2)) / $this->_ratio;
        $this->matrix[5] = 1/tan(deg2rad($this->_fov / 2));
        $this->matrix[10] = -(($this->_far + $this->_near) / ($this->_far - $this->_near));
        $this->matrix[11] = -2 * ($this->_far * $this->_near) / ($this->_far - $this->_near);
        $this->matrix[14] = -1;
    }
    public function mult(Matrix $rhs)
    {
        $ret = array();
        for ($i = 0; $i < 16; $i += 4)
        {
            for ($j = 0; $j < 4; $j++)
            {
                $ret[$i + $j] = 0;
                $ret[$i + $j] += $this->matrix[$i + 0] * $rhs->matrix[$j + 0];
                $ret[$i + $j] += $this->matrix[$i + 1] * $rhs->matrix[$j + 4];
                $ret[$i + $j] += $this->matrix[$i + 2] * $rhs->matrix[$j + 8];
                $ret[$i + $j] += $this->matrix[$i + 3] * $rhs->matrix[$j + 12];
            }
        }
        $tmp = Matrix::$verbose;
        Matrix::$verbose = False;
        $ret_mat = new Matrix(array('preset' => Matrix::FROM_ARRAY, 'matrix' => $ret));
        Matrix::$verbose = $tmp;
        return ($ret_mat);
    }
    public function transformVertex(Vertex $a)
    {
        $x = $this->matrix[0] * $a->getX() + $this->matrix[1] * $a->getY() + $this->matrix[2] * $a->getZ() + $this->matrix[3] * $a->getW();
        $y = $this->matrix[4] * $a->getX() + $this->matrix[5] * $a->getY() + $this->matrix[6] * $a->getZ() + $this->matrix[7] * $a->getW();
        $z = $this->matrix[8] * $a->getX() + $this->matrix[9] * $a->getY() + $this->matrix[10] * $a->getZ() + $this->matrix[11] * $a->getW();
        $w = $this->matrix[12] * $a->getX() + $this->matrix[13] * $a->getY() + $this->matrix[14] * $a->getZ() + $this->matrix[15] * $a->getW();

        $ret = new Vertex(array( 'x' => $x, 'y' => $y, 'z' => $z, 'w' => $w));
        return $ret;
    }

    public function getPreset()
    {
        return $this->_preset;
    }

    public function getScale()
    {
        return $this->_scale;
    }

    public function getAngle()
    {
        return $this->_angle;
    }

    public function getVtc()
    {
        return $this->_vtc;
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
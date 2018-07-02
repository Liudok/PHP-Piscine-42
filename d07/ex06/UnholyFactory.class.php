<?php

class UnholyFactory {

    private $_army = array();
    private $_flag = 0;

    public function absorb($recruit)
    {
        $this->_flag = 0;
        if (get_parent_class($recruit) == Fighter)
        {
            if (array_key_exists ( $recruit->getType() , $this->_army))
            {
                print ("(Factory already absorbed a fighter of type " . $recruit->getType() . ")\n");
                $this->_flag = 1;
            }
            if ($this->_flag == 0)
            {
                $tmp = $recruit->getType();
                $this->_army[$tmp] = $recruit;
                print ("(Factory absorbed a fighter of type " . $recruit->getType() . ")\n");
            }
        }
        else
        {
            print ("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
        }
    }

    public function fabricate($rf)
    {
        if (isset($this->_army[$rf]))
        {
            print ("(Factory fabricates a fighter of type " . $rf . ")" . PHP_EOL);
            return (new $this->_army[$rf]);
        }
        else
        {
            print ("(Factory hasn't absorbed any fighter of type " . $rf . ")" . PHP_EOL);
        }
    }
}

?>
<?php

class NightsWatch {

    private $_nw = array();

    public function recruit($person)
    {
        if ($person instanceof IFighter)
        {
            $this->_nw[] = $person;
        }
    }

    public function fight()
    {
        foreach ($this->_nw as $warior)
            $warior->fight();
    }
}

?>
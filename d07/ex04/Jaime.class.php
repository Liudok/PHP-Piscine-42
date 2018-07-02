<?php

class Jaime extends Lannister {

    public function sleepWith($rhs) {
        if ($rhs instanceof Lannister && $rhs instanceof Cersei)
            print("With pleasure, but only in a tower in Winterfell, then.");
        else if ($rhs instanceof Lannister)
            print("Not even if I'm drunk !");
        else if ($rhs instanceof Stark)
            print("Let's do this.");
        print(PHP_EOL);
    }
}

?>
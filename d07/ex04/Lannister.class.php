<?php

class Lannister {

    public function sleepWith($rhs) {
        if ($rhs instanceof Lannister)
            print("Not even if I'm drunk !");
        else if ($rhs instanceof Stark)
            print("Let's do this.");
        print(PHP_EOL);
    }
}

?>
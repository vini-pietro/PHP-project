<?php

namespace Viniciuspietro\Task2;

class Author {
    private $name;
    private $birthdate;

    public function __construct($name, $birthdate) {
        $this->name = $name;
        $this->birthdate = $birthdate;
    }

    public function getBiography() {
        return "{$this->name} (Born: {$this->birthdate})";
    }
}
echo "██╗    ██╗███████╗██╗     ██╗      ██████╗ ██████╗ ███╗   ███╗███████╗\n";
echo "██║    ██║██╔════╝██║     ██║     ██╔════╝██╔═══██╗████╗ ████║██╔════╝\n";
echo "██║ █╗ ██║█████╗  ██║     ██║     ██║     ██║   ██║██╔████╔██║█████╗  \n";
echo "██║███╗██║██╔══╝  ██║     ██║     ██║     ██║   ██║██║╚██╔╝██║██╔══╝  \n";
echo "╚███╔███╔╝███████╗███████╗███████╗╚██████╗╚██████╔╝██║ ╚═╝ ██║███████╗\n";
echo " ╚══╝╚══╝ ╚══════╝╚══════╝╚══════╝ ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚══════╝\n";
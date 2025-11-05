<?php

namespace App\Helpers;

class RandomHelper{
    /**
     * Make a random code string, by defaults return 8 character
     * 
     * @param int $length
     * @return string
     */
    static public function code($length=8) {
        $code   = random_bytes($length/2);
        $code   = bin2hex($code);
        
        return $code;
    }
}
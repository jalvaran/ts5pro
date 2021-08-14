<?php

namespace App\Libraries;

class TS5{
    function getUniqueId($prefix="")
    {
        return(uniqid($prefix,true));
    }
}
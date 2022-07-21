<?php

use \Models;
use \Controllers;

spl_autoload_register(function ($clase) {
    if (file_exists(str_replace('\\', '/', $clase))) {
        require_once(str_replace('\\', '/', $clase));
    } else {
        
    }
});

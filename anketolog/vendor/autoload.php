<?php

namespace vendor;

spl_autoload_register(
    function ($className) {

        require_once "{$className}.php";
    }
);




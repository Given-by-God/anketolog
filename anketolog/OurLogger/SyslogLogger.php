<?php
/**
 * Created by PhpStorm.
 * User: UMBRELLA
 * Date: 02.12.2017
 * Time: 15:21
 */

namespace OurLogger;


class SyslogLogger
{
    public $filename;
    public  $date;
    function __construct($filename)
    {
            $this->filename = $filename;
            $this->date = date('c');
//        print_r($filename);

    }
}
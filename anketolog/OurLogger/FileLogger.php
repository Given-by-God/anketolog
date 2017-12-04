<?php

namespace OurLogger;


class FileLogger
{

    /**
     *
     * @var
     */
    public $filename; //асоц массив в котором лежит путь к логу
    public $date;

    function __construct($filename)
    {
        $this->filename = $filename;
        $this->date = date('c');
    }

    /**
     * application.log
     *
     * Метод,который создает(если нет) файл и записывает в него данные.
     *
     * В данный лог будут записываться все данные
     *
     * @param $level - собственно,уровень лога.Что будет записано в лог,при
     * обращении к этому методу.
     *
     * @param $message - сообщение,которое будет записано в лог
     */

    function ApplicationLog($level, $message)
    {
        $this->addInfoToFile($level, $message);
    }

    /**
     * application.error.log
     *
     * В данный лог будут записываться только ошибки
     *
     */


    function ApplicationErrorLog($level, $message)
    {
        $this->addInfoToFile($level, $message);
    }

    /**
     * application.info.log
     *
     * Собственно,инфо лог.Только информационный данные
     *
     */

    function ApplicationInfoLog($level, $message)
    {

        $this->addInfoToFile($level, $message);
    }


    /**Дабы избежать повторения кода - вынес все в отдельный метод
     * 
     * 
     * 
     * @param $level
     * @param $message
     */
    function addInfoToFile($level, $message)
    {
        /*
         * Создание файла
         * $this->filename['filename'] - указывает путь к файлу
         * a - только для записи.Записывает данные и ставит каретку в конце строки
         */

        $handle = fopen($this->filename['filename'], 'a');


        fwrite($handle, "\r\n".$this->date." ".$level." ".$message);//Запись
        fclose($handle);//Закрываем файл (считаеся хорошим тоном)
    }


    /** При обращении к данному методу,данные будут записываться в application.log
     *
     * Метод log ,который вызавает свой же метод ApplicationLog.
     *
     *
     * @param $level
     * @param $message
     */
    function log($level, $message)
    {
        $this->ApplicationLog($level, $message);
    }


    /** При обращении к данному методу,данные будут записываться в application.log
     *
     * Метод info ,который вызавает свой же метод ApplicationLog.
     *
     * В принципе, вместо метода ApplicationLog можно было бы вызвать метод log
     * ( $this->log(LogLevel::INFO, $message)) - все осталось бы так же(работало)
     *
     *
     * @param $level
     * @param $message
     */

    function info($message)
    {
        $this->ApplicationLog(LogLevel::INFO, $message);
    }

}


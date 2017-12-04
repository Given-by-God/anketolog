<?php

namespace OurLogger;

/**Класс для распределения логов
 *
 * Class Component
 * @package OurLogger
 */
class Component extends LogLevel
{

    /**
     * @var array
     */
    public $fileLogger = []; //Массив обьектов


    function addLogger($fileLogger)
    {
        $this->fileLogger[] = $fileLogger; //Записываем в массив все логгеры
    }

    /**
     * @param $level - уровень лога: const  ERROR = 'LOG_LEVEL_ERROR';
     *                               const  INFO = 'LOG_LEVEL_INFO';
     *                               const  DEBUG ='LOG_LEVEL_DEBUG';
     *                               const  NOTICE='LOG_LEVEL_NOTICE';
     *
     * @param $message - сообщение для записи в лог
     */

    function log($level, $message)
    {

        $this->fileLogger[0]->ApplicationLog($level, $message); // все логи (независимо от уровня) записываем в application.log
        for ($i = 0; $i < count($this->fileLogger); $i++) { //идем по массиву обьектов и проверяем


            if ($level == $this->fileLogger[$i]->filename['levels'][0]) {   //в какой лог будем записывать


//                echo "<pre>";
//                print_r($this->fileLogger[$i]);
//                echo "</pre>";

                switch ($this->fileLogger[$i]->filename['levels'][0]) {
                    case LogLevel::ERROR :
                        $this->fileLogger[$i]->ApplicationErrorLog($level,$message); //если ERROR то записываем в application.error.log
                        break;
                    case LogLevel::INFO :
                        $this->fileLogger[$i]->ApplicationInfoLog($level,$message );  //если INFO то записываем в application.info.log
                        break;
                }
            }
        }
    }


    /**
     * @param $message
     */

    public function error($message)
    {
        $this->log(LogLevel::ERROR, $message);

    }

    /**
     * @param $message
     */

    public function info($message)
    {
        $this->log(LogLevel::INFO, $message);
    }

    /**
     * @param $message
     */

    public function debug($message)
    {
        $this->log(LogLevel::DEBUG, $message);
    }

    /**
     * @param $message
     */

    public function notice($message)
    {
        $this->log(LogLevel::NOTICE, $message);
    }

}
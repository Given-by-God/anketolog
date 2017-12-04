<?php


require_once ('./vendor/autoload.php');


/**
 * Компонент для логирования
 */
$logger = new OurLogger\Component();

/**
 * Логгер который все логи будет писать в файл application.log
 */
$fileLogger = new OurLogger\FileLogger([
    'filename' => __DIR__ . '/application.log',
]);

$logger->addLogger($fileLogger); //add logger


/**
 * Логгер который все ошибки будет писать в файл application.error.log
 */
$logger->addLogger(new OurLogger\FileLogger([
    'filename'  => __DIR__ . '/application.error.log',
    'levels'    => [
        OurLogger\LogLevel::ERROR,
    ],
]));

/**
 * Логгер который все информационные логи будет писать в файл application.info.log
 */
$logger->addLogger(new OurLogger\FileLogger([
    'filename'  => __DIR__ . '/application.info.log',
    'levels'    => [
        OurLogger\LogLevel::INFO,
    ],
]));


/**
 * Логгер который все debug логи записывает в syslog
 *
 * @see http://php.net/manual/ru/function.syslog.php
 */
$logger->addLogger(new OurLogger\SyslogLogger([
    'levels'    => [
        OurLogger\LogLevel::DEBUG,
    ],
]));


/**
 * Логгер который ничего не делает
 */
$logger->addLogger(new OurLogger\NullLogger([

]));

$logger->log(OurLogger\LogLevel::ERROR, 'Error message');
$logger->error('Error message');

$logger->log(OurLogger\LogLevel::INFO, 'Info message');
$logger->info('Info message');
$logger->log(OurLogger\LogLevel::DEBUG, 'Debug message');
$logger->debug('Debug message');
$logger->log(OurLogger\LogLevel::NOTICE, 'Notice message');
$logger->notice('Notice message');
$fileLogger->log(OurLogger\LogLevel::INFO, 'Info message from FileLogger');
$fileLogger->info('Info message from FileLogger');


echo "it's work!!!";
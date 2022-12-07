<?php


namespace core;

class ErrorHandler
{

    public function __construct() {
        if(DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function errorHandler($errorNumber, $errorStr, $errorFile, $errorLine) {
        $this->logErrors($errorStr, $errorFile, $errorLine);
        $this->displayErrors($errorNumber, $errorStr, $errorFile, $errorLine);
    }

    public function fatalErrorHandler() {
        $error = error_get_last();
        if(!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            $this->logErrors($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayErrors($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    public function exceptionHandler(\Throwable $exception) {
        $this->logErrors($exception->getMessage(), $exception->getFile(), $exception->getLine());
        $this->displayErrors('Exception', $exception->getMessage(), $exception->getFile(), $exception->getLine(), $exception->getCode());
    }

    protected function logErrors($message = '', $file = '', $line = '') {
        file_put_contents(
            LOGS . '/errors.log',
            "[" . date('Y-m-d H:i:s') .
            "] Error Message: {$message} | File: {$file} |
            Line: {$line}\n=================\n",
            FILE_APPEND);
    }

    protected function displayErrors($errorNumber, $errorStr, $errorFile, $errorLine, $responce = 500) {
        if($responce == 0) {
            $responce = 404;
        }
        http_response_code($responce);
        if($responce == 404 && !DEBUG) {
            require_once WWW . '/errors/404.php';
            die;
        }
        if(DEBUG) {
            require_once WWW . '/errors/development.php';
        } else {
            require_once WWW . '/errors/production.php';
        }
        die;
    }

}
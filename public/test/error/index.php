<?php

define("DEBUG", 1);

class NotFoundException extends Exception {

    public function __construct(string $message = "", int $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class ErrorHandler
{
    public function __construct()
    {
        if(DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this,'fatalErrorHandler']);
        set_exception_handler([$this,'exceptionHandler']);
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        error_log("[" . date('Y-m-d H:i:s') . "] Error text: $errstr | File: $errfile | Line: $errline \n==================\n", 3, __DIR__ . "/errors.log");
        $this->displayError($errno, $errstr, $errfile, $errline);
    }

    public function fatalErrorHandler()
    {
        $error = error_get_last();
        if(!empty($error && $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR))) {
            error_log("[" . date('Y-m-d H:i:s') . "] Error text: {$error['message']} | File: {$error['file']} | Line: {$error['line']} \n==================\n", 3, __DIR__ . "/errors.log");
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line'] );
        } else {
            ob_end_flush();
        }
    }

    public function exceptionHandler($e)
    {
        error_log("[" . date('Y-m-d H:i:s') . "] Error text: {$e->getMessage()} | File: {$e->getFile()} | Line: {$e->getLine()} \n==================\n", 3, __DIR__ . "/errors.log");
        $this->displayError('Exception', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $response = 500)
    {
        http_response_code($response);
        if(DEBUG) {
            require_once 'views/dev.php';
        } else {
            require_once 'views/prod.php';
        }
        die();
    }
}

new ErrorHandler();



//test123();
// echo $test;

/*try {
    if(empty($test)){
        throw new Exception('Oops! Exception');
    }
} catch (Exception $e) {
    echo '<pre>';
    print_r($e);
    echo '</pre>';
}*/

//throw new Exception('Oops! Exception', 404 );

throw new NotFoundException('Page Not Found' );

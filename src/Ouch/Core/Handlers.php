<?php

/**
 * Ouch error handler for PHP
 *
 * @package     Ouch
 * @author      Lotfio Lakehal <lotfiolakehal@gmail.com>
 * @copyright   2018 Lotfio Lakehal
 * @license     MIT
 * @link        https://github.com/lotfio-lakehal/ouch
 */

namespace Ouch\Core;

use Ouch\Exceptions;

class Handlers implements HandlersInterface
{

    /**
     * errors repo
     * 
     * @var array
     */
    private $errors = array();


    /**
     * custom error handler 
     * 
     * @param  int    $type [description]
     * @param  string $msg  [description]
     * @param  string $file [description]
     * @param  int    $line [description]
     * @return [type]       [description]
     */
    public function errorHandler(int $type, string $message, string $file, int $line)
    {
        $this->setErrors($type, $message, $file, $line);

        //TODO render template on error
        print_r($this->errors);
    }

    /**
     * exceptions handler
     *
     * @param $exception
     */
    public function exceptionHandler($e)
    {   
        $this->setErrors(
            $e->getCode(),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTrace()
        );

        //TODO render template on exception error
        print_r($this->errors);
    }

    /**
     * Errors seter method
     * 
     * @param int    $type    error type
     * @param string $message error message
     * @param string $file    error file
     * @param int    $line    error line
     */
    public function setErrors(int $type, string $message,  string $file, int $line, array $trace) : array
    {   

       return $this->errors = array(

            "type"    => $this->whichError($type),
            "message" => $message,
            "file"    => $file,
            "line"    => $line,
            "trace"   => $trace
        );
    }


    /**
     * [whichError description]
     * @param  int    $type [description]
     * @return [type]       [description]
     */
    public function whichError(int $type)
    {
        switch ($type) {
            case E_ERROR            : return "Error";              break;
            case E_WARNING          : return "Warning";            break;
            case E_PARSE            : return "Parce Error";        break;
            case E_NOTICE           : return "Notice";             break;
            case E_CORE_ERROR       : return "Core Error";         break;
            case E_CORE_WARNING     : return "Core warning";       break;
            case E_COMPILE_ERROR    : return "Compile Error";      break;
            case E_COMPILE_WARNING  : return "Compile warning";    break;
            case E_USER_ERROR       : return "User Error";         break;
            case E_USER_WARNING     : return "User Warning";       break;
            case E_USER_NOTICE      : return "User notice";        break;
            case E_STRICT           : return "Strict";             break;
            case E_RECOVERABLE_ERROR: return "Recoverable Error";  break;
            case E_DEPRECATED       : return "Depricated";         break;
            case E_USER_DEPRECATED  : return "User Depricated";    break;
            default                 : return "Error";              break;
        }
    }

}
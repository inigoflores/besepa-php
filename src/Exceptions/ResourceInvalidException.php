<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 18/4/15
 * Time: 18:47
 */

namespace Besepa\Exceptions;

class ResourceInvalidException extends \Exception{

    public $error_messages = array();

    function getErrorMessages(){
        return $this->error_messages;
    }





} 
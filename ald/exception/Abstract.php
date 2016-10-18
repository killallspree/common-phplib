<?php
/**
 * @name 
 * @desc 
 * @author huangpeng
 * @date 2016/8/16 10:09
 */

abstract class Ald_Exception_Abstract extends Exception{
    /**
     * 
     * @var unknown
     */
    private $data;
    /**
     * 
     * @var unknown
     */
    private $inner;

    public function __construct($errno, $error='', $inner='', $data = null){
        $this->inner = $inner;
        if(empty($error)){
            $error = $this -> getErrMsg($errno);
        }
        if(empty($inner)){
            $inner = $error;
        }
        parent::__construct($error, $errno);
        $this -> errorLog($inner);
        $this->data = $data;
    }

    protected abstract function errorLog($inner);

    protected abstract function getErrMsg($errno);
    
    public function getInternalError(){
        return $this->inner;
    }
    public function getExceptionData(){
        return $this->data;
    }

} 
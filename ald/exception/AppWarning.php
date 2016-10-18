<?php

/**
 * Class Ald_Exception_AppWarning
 * @author: huangpeng
 * @date: 2016年8月14日 下午4:39:34
 * phplib的错误码，对应错误文件phplib/ald/const/error.php
 */

class Ald_Exception_AppWarning extends Ald_Exception_Abstract {

    /**
     * 日志记录
     */
    protected function errorLog($inner){
        Ald_Log::warning(sprintf('file[%s] line[%s] errno[%s] error[%s]',
            $this->getFile(), $this->getLine(), $this->getCode(), $inner));
    }

    protected function getErrMsg($errno){
        $errorClass = ucfirst(APP_NAME) . '_Const_Error';
        if(!class_exists($errorClass) || !method_exists($errorClass, 'error')){
            Ald_Log::warning(sprintf('class not exist! class_name[%s]', $errorClass));
        }
        return $errorClass::error($errno);
    }

}
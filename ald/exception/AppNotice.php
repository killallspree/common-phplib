<?php

/**
 * Class Ald_Exception_AppNotice
 * @author: huangpeng
 * @date: 2016年8月15日 下午21:39:34
 * 业务的错误码，对应错误文件APP_DIR/library/APP_NAME/const/error.php
 */

class Ald_Exception_AppNotice extends Ald_Exception_Abstract {

    /**
     * 日志记录
     */
    protected function errorLog($inner){
        Ald_Log::notice(sprintf('file[%s] line[%s] errno[%s] error[%s]',
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
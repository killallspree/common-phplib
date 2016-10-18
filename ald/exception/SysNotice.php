<?php

/**
 * Class Ald_Exception_SysNotice
 * @author: huangpeng
 * @date: 2016年8月14日 下午4:39:34
 * phplib的错误码，对应错误文件phplib/ald/const/error.php
 */

class Ald_Exception_SysNotice extends Ald_Exception_Abstract {

    /**
     * 日志记录
     */
    protected function errorLog($inner){
        Ald_Log::notice(sprintf('file[%s] line[%s] errno[%s] error[%s]',
            $this->getFile(), $this->getLine(), $this->getCode(), $inner));
    }

    protected function getErrMsg($errno){
        return Ald_Const_Error::error($errno);
    }

}
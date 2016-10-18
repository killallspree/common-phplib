<?php
/**
 * @name Login.php
 * @desc 
 * @author huangpeng
 * @date 2016/8/18 14:23
 */

class Ald_Action_Login extends Ald_Action{

    protected function _before(&$inputData){
        if(is_null(Ald_Lib_Pass::getUserInfo()->getUserId())){
            if(IS_AJAX || IS_APP){
                throw new Ald_Exception_SysNotice(Ald_Const_Errno::NO_LOGIN);
            }else{
                echo "<script type='text/javascript'>location.href='" . Ald_Const_Define::LOGIN_URL ."'</script>";
                exit();
            }
        }
    }

    protected function _after(&$retData){
        if($this->_outputType == self::OUTPUT_TYPE_HTML){
            $retData = (array) $retData;
            $retData['userInfo'] = Ald_Lib_Pass::getUserInfo()->getUserInfo();
        }
    }

}
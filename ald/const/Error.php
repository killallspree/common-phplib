<?php
/**
 * @author: jianguo
 * @date: 2016年8月11日 下午9:20:53
 */
class Ald_Const_Error{
    public static $MAP = array(
        Ald_Const_Errno::SUCCESS => 'success',
        Ald_Const_Errno::ERROR => 'error',
        Ald_Const_Errno::PARAMS_INVALID => 'invalid params',
        Ald_Const_Errno::NO_LOGIN => '未登陆',
        Ald_Const_Errno::NO_AUTH_IP => '非法IP',
        Ald_Const_Errno::SMS_FAILED => '短信发送失败',
        Ald_Const_Errno::INVALID_TOKEN => 'token校验失败',
    );

    public static function error($errno){
        if(isset(self::$MAP[$errno])){
            return self::$MAP[$errno];
        }
        return '';
    }
}

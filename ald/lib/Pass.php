<?php
/**
 * @name Pass.php
 * @desc 
 * @author huangpeng
 * @date 2016/9/6 21:35
 */

class Ald_Lib_Pass {
    const LOGIN_COOKIE_EXPIRE = 86400; //cookie
    private static $hasInitUser = false;
    private static $userInfo = null;

    /**
     * 获取uss
     * @return null
     */
    private static function getUss(){
        $ald_uss = null;
        if(isset($_COOKIE['ALDUSS']) && !empty($_COOKIE['ALDUSS'])){
            $ald_uss = $_COOKIE['ALDUSS'];
        }elseif(isset($_REQUEST['ALDUSS']) && !empty($_REQUEST['ALDUSS'])){
            $ald_uss = $_REQUEST['ALDUSS'];
            if(!IS_APP){
                self::setAldUss($ald_uss);
            }
        }
        if(is_null($ald_uss)){
            return null;
        }
        return $ald_uss;
    }

    /**
     * 检查uss有效性
     * @param $ald_uss
     * @return bool
     */
    public static function checkUss($ald_uss){
        //检查uss是否有效
        $ret = Ald_Lib_Curl::fetch(Ald_Const_Define::LOGIN_CHECK, Ald_Lib_Curl::METHOD_POST, array('ALDUSS' => $ald_uss));
        $ret = json_decode($ret, true);
        if(!isset($ret['errno']) || $ret['errno'] != 0){
            return false;
        }else{
            return $ret['data'];
        }
    }

    /**
     * 获取用户信息
     * @return Ald_Context_User|null
     */
    public static function getUserInfo(){
        if(self::$hasInitUser == false){
            self::$userInfo = new Ald_Context_User();
            $ald_uss = self::getUss();
            if(!empty($ald_uss)){
                $userInfo = self::checkUss($ald_uss);
                if(!empty($userInfo)){
                    self::$userInfo -> setUserInfo($userInfo);
                }
            }
            self::$hasInitUser = true;
        }
        return self::$userInfo;
    }

    /**
     * 设置登陆cookie
     * @param $uss
     */
    public static function setAldUss($uss, $expire = self::LOGIN_COOKIE_EXPIRE){
        setcookie('ALDUSS', $uss, time() + $expire, '/');
    }

    /**
     * 删除cookie
     * @param $uss
     */
    public static function delAldUss(){
        setcookie('ALDUSS');
    }

}
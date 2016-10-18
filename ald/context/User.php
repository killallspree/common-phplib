<?php
/**
 * @name UserInfo.php
 * @desc
 * @author huangpeng
 * @date 2016/9/11 16:04
 */

class Ald_Context_User {
    protected static $userInfo = null;

    public static function setUserInfo($userInfo){
        self::$userInfo = $userInfo;
    }

    public static function getUserInfo(){
        return self::$userInfo;
    }

    public static function getUserId(){
        return isset(self::$userInfo['user_id']) ? self::$userInfo['user_id'] : null;
    }

    public static function getTelPhone(){
        return isset(self::$userInfo['telphone']) ? self::$userInfo['telphone'] : null;
    }

    public static function getHead(){
        return isset(self::$userInfo['head']) ? self::$userInfo['head'] : null;
    }

    public static function getNick(){
        return isset(self::$userInfo['nick']) ? self::$userInfo['nick'] : null;
    }

    public static function getName(){
        return isset(self::$userInfo['name']) ? self::$userInfo['name'] : null;
    }

    public static function getSex(){
        return isset(self::$userInfo['sex']) ? self::$userInfo['sex'] : null;
    }

} 
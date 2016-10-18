<?php
/**
 * @name Ald_Config
 * @desc
 * @author huangpeng
 * @date 2016/8/14 11:40
 */

class Ald_Config{
    protected static $config = array();

    /**
     * @param $key
     * @param string $file
     * @param bool $tag
     * @return mixed
     */
    public static function getAppConfigByKey($key, $file = 'application', $tag = YAF_ENVIRON){
        if(false === strrpos($file, '.ini')){
            $file .= '.ini';
        }
        $file_path = CONF_DIR . DS . APP_NAME . DS . $file;
        $dbConfig = self::getConfig($file_path, $tag);
        return $dbConfig -> get($key);
    }

    /**
     * @param $file
     * @param bool $tag
     * @return mixed
     */
    public static function getAppConfig($file = 'application', $tag = false){
        if(false === strrpos($file, '.ini')){
            $file .= '.ini';
        }
        $file_path = CONF_DIR . DS . APP_NAME . DS . $file;
        $dbConfig = self::getConfig($file_path, $tag);
        return $dbConfig -> toArray();
    }

    /**
     * @param $file
     * @param bool $tag
     * @return mixed
     */
    public static function getSysConfig($file, $tag = false){
        if(false === strrpos($file, '.ini')){
            $file .= '.ini';
        }
        $file_path = CONF_DIR . DS . $file;
        $dbConfig = self::getConfig($file_path, $tag);
        return $dbConfig -> toArray();
    }

    /**
     * @param $file_path
     * @param $tag
     * @return mixed
     */
    private static function getConfig($file_path, $tag){
        if(!isset(self::$config[md5($file_path.$tag)])){
            if($tag){
                $objConfig = new Yaf_Config_Ini($file_path, $tag);
            }else{
                $objConfig = new Yaf_Config_Ini($file_path);
            }
            self::$config[md5($file_path.$tag)] = $objConfig;
        }
        return self::$config[md5($file_path.$tag)];
    }

}
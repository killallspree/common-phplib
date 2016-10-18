<?php
/**
 * @author: jianguo
 * @date: 2016年8月14日 下午5:36:41
 */
class Ald_Sington{
    /**
     * 
     * @var array
     */
    private static $instances = array();
    
    /**
     * 
     */
    private function __construct(){}
    
    /**
     * 
     */
    private function __clone(){}
    
    /**
     * 
     * @param unknown $className
     * @return mixed
     */
    public static function getInstance($className){
        if(!isset(self::$instances[$className])){
            self::$instances[$className] = new $className();
        }
        return self::$instances[$className];
    }
    
    /**
     * 
     * @param unknown $psName
     */
    public static function getPs($psName){
        $className = 'Service_Page_' . $psName . 'Model';
        return self::getInstance($className);
    }
    
    /**
     * 
     * @param unknown $dsName
     * @return mixed
     */
    public static function getDs($dsName){
        $className = 'Service_Data_' . $dsName . 'Model';
        return self::getInstance($className);
    }
    
    /**
     * 
     * @param unknown $daoName
     * @return mixed
     */
    public static function getDao($daoName, $namespace = 'db'){
        if(!empty($namespace)){
            $className = 'Dao_' . strtoupper($namespace) . '_' . $daoName . 'Model';
        }else{
            $className = 'Dao_' . $daoName . 'Model';
        }
        return self::getInstance($className);
    }
}
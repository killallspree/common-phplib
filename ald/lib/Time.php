<?php
/**
 * @author: jianguo
 * @date: 2016年8月18日 下午5:48:44
 */
class Ald_Lib_Time{
    /**
     * 
     * @return number
     */
    public static function getCurrTime(){
        //static $time = isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time();
        static $time = 0;
        if(empty($time)){
            $time = time();
        }
        return $time;
    }
    
    /**
     * 
     * @param unknown $start
     * @param unknown $end
     * @param unknown $time
     * @return boolean
     */
    public static function between($start, $end, $time = null){
        if($start > $end){
            return false;
        }
        if(empty($time)){
            $time = self::getCurrTime();
        }
        if($time <= $start){
            return false;
        }
        if($time > $end){
            return false;
        }
        return true;
    }
}
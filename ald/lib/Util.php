<?php
/**
 * @name Util.php
 * @desc 
 * @author huangpeng
 * @date 2016/8/18 11:14
 */

class Ald_Lib_Util{
    /**
     * 格式化文件大小
     * @param unknown $size
     * @return string
     */
    public static function fileSizeFormat($size){
        $size = intval($size);
        $oneKb = 1024;
        if($size < $oneKb){
            return $size . 'B';
        }
        $oneMb = $oneKb * 1024;
        if($size < $oneMb){
            return round($size / $oneKb, 2) . 'KB';
        }
        $oneGb = $oneMb * 1024;
        if($size < $oneGb){
            return round($size / $oneMb, 2) . 'MB';
        }
        return round($size / $oneGb, 2) . 'GB';
    }
    
    /**
     * 
     * @param unknown $money
     */
    public static function moneyFormat($money){
        $money = floatval($money);
        return $money;
    }
    
    /**
     * 
     * @param unknown $phone
     * @return number
     */
    public static function phoneMask($phone){
        return substr($phone, 0, 3) . '****' . substr($phone, -4);
    }
} 
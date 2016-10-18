<?php
/**
 * @author: jianguo
 * @date: 2016年8月17日 下午3:27:15
 */
class Ald_Lib_Arr{
    /**
     * 
     * @param unknown $arr
     * @param unknown $fields
     */
    public static function buildMap($arr, $keyField, $valField = null){
        if(!is_array($arr)){
            return array();
        }
        $result = array();
        foreach($arr as $v){
            $key = $v[$keyField];
            if(is_array($valField)){
                $val = array();
                foreach($valField as $vf){
                    $val[$vf] = isset($v[$vf]) ? $v[$vf] : null;
                }
            }else{
                $val = is_null($valField) ? $v : $v[$valField];
            }
            $result[$key] = $val;
        }
        return $result;
    }
    
    /**
     * 
     * @param unknown $data
     * @param unknown $fields
     * @return unknown|unknown[]
     */
    public static function fetch($data, $fields){
        if(!is_array($fields) || !is_array($data)){
            return array();
        }
        $ret = array();
        foreach($fields as $field){
            if(isset($data[$field])){
                $ret[$field] = $data[$field];
            }
        }
        return $ret;
    }
    
    /**
     * 
     * @param unknown $arr
     * @param unknown $key
     * @param unknown $default
     * @return string|string|unknown
     */
    public static function get($arr, $key, $default = null){
        if(!is_array($arr)){
            return $default;
        }
        return isset($arr[$key]) ? $arr[$key] : $default;
    }
}
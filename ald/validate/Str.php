<?php
/**
 * @name Ald_Validate_Str
 * @desc
 * @author huangpeng
 * @date 2016/8/16 14:35
 */

class Ald_Validate_Str extends Ald_Validate_Abstract {

    /**
     * 初始化检查
     */
    public function _init(){
        if(!is_scalar($this -> data)) return false;
        if (strlen($this -> data) >= 10 && self::isSqlInject($this -> data)){
            return false;
        }
        $this->result = trim($this -> data);
    }

    /**
     * 最小值检查
     */
    public function _min($param){
        if(strlen($this -> data) < $param) return false;
        return true;
    }

    /**
     * 最大值检查
     */
    public function _max($param){
        if(strlen($this -> data) > $param) return false;
        return true;
    }

    /**
     * UTF-8编码字符长度
     */
    public function _utf8min($param){
        if(mb_strlen($this -> data, 'UTF-8') < $param) return false;
        return true;
    }

    /**
     * UTF-8编码字符长度
     */
    public function _utf8max($param){
        if(mb_strlen($this -> data, 'UTF-8') > $param) return false;
        return true;
    }

    /**
     * 是否为url
     */
    public function _url($param = null){
        if(!preg_match('/^http:\/\//', $this -> data)){
            return false;
        }
        return true;
    }

    /**
     * URL是否可访问
     */
    public function _urlaccessible($param = null){
        if(!$this->_url($this -> data)) return false;
        //TODO access through http
        return true;
    }

    /**
     * 联系方式是否为手机或者电话
     */
    public function _contact($param = null){
        return $this->_phone($this -> data) || $this->_tel($this -> data);
    }

    /**
     * 手机号码验证
     */
    public function _phone($param = null){
        return preg_match('/^1[34578]\d{9}$/', $this -> data);
    }

    /**
     * 座机号码验证
     */
    public function _tel($param = null){
        return preg_match('/^0\d{2,3}-\d{7,8}$/', $this -> data) || preg_match('/^400\d{7,}$/', $this -> data);
    }

    /**
     * email验证
     */
    public function _email($param = null){
        return preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i', $this -> data);
    }

    /**
     * 密码
     * @param null $param
     * @return bool
     */
    public function _passwd($param = null){
        $this -> res = base64_decode($this -> data);
        return strlen($this -> res) >= 6 && strlen($this -> res) <= 20;
    }

    public function _passwdrev($param = null){
        $this -> res = base64_decode(strrev($this -> data));
        return strlen($this -> res) >= 6 && strlen($this -> res) <= 20;
    }

    /**
     * 验证码
     * @param null $param
     * @return int
     */
    public function _veri_code($param = null){
        return preg_match('/[0-9]{4}/', $this -> data);
    }

    /**
     * 血型
     * @param null $param
     */
    public function _blood($param = null){
        return in_array($this -> data, Ald_Const_Define::$blood_types);
    }

    /**
     * 星座
     * @param null $param
     * @return bool
     */
    public function _constellation($param = null){
        return in_array($this -> data, Ald_Const_Define::$constellations);
    }

    /**
     * 星座
     * @param null $param
     * @return bool
     */
    public function _nation($param = null){
        return in_array($this -> data, Ald_Const_Nation::$nations);
    }

}

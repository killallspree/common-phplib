<?php
/**
 * @name Login.php
 * @desc 
 * @author huangpeng
 * @date 2016/8/18 14:23
 */

class Ald_Action_Api extends Ald_Action{

    protected function _before(&$inputData){
        //验证ip
        return true;
    }
}
<?php
/**
 * @name Ald_Validate
 * @desc 
 * @author huangpeng
 * @date 2016/8/16 10:35
 */

class Ald_Validate {

    private $data = array();
    private $rules = array();
    private $res = array();

    public function __construct($data,$rules){
        $this -> data = $data;
        $this -> rules = $rules;
    }

    /**
     * @return array
     * @throws Ald_Exception_Phplib
     */
    public function validate(){
        if(empty($this ->  rules)){
            return $this -> data;
        }
        foreach($this -> rules as $rule){
            $this -> vali($rule);
        }
        return $this -> res;
    }

    /**
     * @param $rule
     * @throws Ald_Exception_Phplib
     */
    private function vali($rule){
        if(!isset($rule[3])){
            $rule[3] = null; //防止报notice
        }
        list($res_key, $req_key, $vali, $errmsg) = $rule;
        $vali_rules = explode('|', $vali);

        $className = 'Ald_Validate_' . ucfirst(array_shift($vali_rules));
        if(!class_exists($className)){
            throw new Ald_Exception_SysWarning(Ald_Const_Errno::ERROR,
                sprintf('validate class not found[%s]', $className));
        }
        $objValidate = new $className(isset($this -> data[$req_key]) ? $this -> data[$req_key] : null, $vali_rules);
        $res = $objValidate -> validate();
        if($res === false){
            $fieldValue = isset($this->data[$req_key]) ? $this->data[$req_key] : '';
            $errmsg = is_null($errmsg) ? sprintf('validate failed! filed[%s] value[%s]', $req_key, $fieldValue) : $errmsg;
            throw new Ald_Exception_SysNotice(Ald_Const_Errno::PARAMS_INVALID,
                $errmsg,
                sprintf('validate failed! filed[%s] value[%s] error_func[%s]', $req_key, $fieldValue, $objValidate -> getError()));
        }
        if(!is_null($res)){
            $this -> res[$res_key] = $res;
        }
    }

} 

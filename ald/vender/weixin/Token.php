<?php
/**
 * @name Token.php
 * @desc 
 * @author huangpeng
 * @date 2016/10/18 18:03
 */
class Ald_Vender_Weixin_Token{
    const CLUSTER_NAME = 'common';
    protected $key = 'weixin:token';
    protected $tokenUrl = 'https://api.weixin.qq.com/cgi-bin/token';

    public function __construct(){
        $this->objRedis =  Ald_Redis::getInstance(self::CLUSTER_NAME);
    }

    /**
     * 获取token
     * @return mixed
     * @throws Ald_Exception_AppWarning
     */
    public function getToken(){
        $token = $this->objRedis->get($this -> key);
        if(empty($token)){
            $token = $this -> genToken();
        }
        return $token;
    }

    /**
     * 生成token
     * @return mixed
     * @throws Ald_Exception_AppWarning
     */
    protected function genToken(){
        $param = array(
            'grant_type' => 'client_credential'
        );
        $conf = Ald_Config::getAppConfig('weixin');
        if(empty($conf)){
            throw new Ald_Exception_AppWarning(Ald_Const_Errno::ERROR, 'get weixin app config faild!');
        }
        $param['appid'] = $conf['appid'];
        $param['secret'] = $conf['secret'];
        $retJson = Ald_Lib_Curl::fetch($this -> tokenUrl, Ald_Lib_Curl::METHOD_GET, $param);
        if(empty($retJson)){
            throw new Ald_Exception_AppWarning(Ald_Const_Errno::ERROR, 'get weixin token faild!');
        }
        $data = json_decode($retJson, true);
        if(empty($data) || isset($data['errcode'])){
            throw new Ald_Exception_AppWarning(Ald_Const_Errno::ERROR, 'get weixin token faild!');
        }
        $ret = $this -> objRedis -> setex($this -> key, $data['expires_in'], $data['access_token']);
        if($ret == false){
            Ald_Log::warning(sprintf('set weixin token to redis faild!'));
        }
        return $data['access_token'];
    }

}
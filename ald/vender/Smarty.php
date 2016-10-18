<?php
/**
 * @author: jianguo
 * @date: 2016-08-10 10:32:20
 */
//Zend_Loader_Autoloader::getInstance()->pushAutoloader(NULL, 'Smarty_');
//require_once __DIR__ . '/smarty/Smarty.class.php';
/**
 * add yaf.use_spl_autoload = 1; in yaf.ini file
 */
//Yaf_Loader::import(__DIR__ . '/smarty/sysplugins/smarty_internal_templatecompilerbase.php');
//Yaf_Loader::import(__DIR__ . '/smarty/sysplugins/smarty_internal_templatelexer.php');
//Yaf_Loader::import(__DIR__ . '/smarty/sysplugins/smarty_internal_templateparser.php');
//Yaf_Loader::import(__DIR__ . '/smarty/sysplugins/smarty_internal_compilebase.php');
//Yaf_Loader::import(__DIR__ . '/smarty/sysplugins/smarty_internal_write_file.php');
//Yaf_Loader::import(__DIR__ . '/smarty/sysplugins/smarty_internal_data.php');
Yaf_Loader::import(__DIR__ . '/smarty/smarty-3.1.27/libs/Smarty.class.php');
class Ald_Vender_Smarty implements Yaf_View_Interface{
    /**
     * 
     * @var unknown
     */
    private $smarty;
    
    /**
     * $config = array(
     *  'template_dir' => '',
     *  'config_dir' => '',
     *  'plugins_dir' => '',
     *  'compile_dir' => '',
     *  'cache_dir' => '',
     * );
     */
    public function __construct($config){
        $this->smarty = new Smarty();
        $config->template_dir && $this->smarty->setTemplateDir($config->template_dir);
        $config->config_dir && $this->smarty->setConfigDir($config->config_dir);
        $config->plugin_dir && $this->smarty->addPluginsDir($config->plugin_dir);
        $config->compile_dir && $this->smarty->setCompileDir($config->compile_dir);
        $config->cache_dir && $this->smarty->setCacheDir($config->cache_dir);
        $config->left_delimiter && $this->smarty->setLeftDelimiter($config->left_delimiter);
        $config->right_delimiter && $this->smarty->setRightDelimiter($config->right_delimiter);
        return $this->smarty;
    }
    
    /**
     * 
     * @param unknown $name
     * @param unknown $value
     */
    public function assign($name, $value = null){
        $this->smarty->assign($name, $value);
        return $this->smarty;
    }
    
    /**
     * 
     * @param unknown $name
     * @param unknown $value
     */
    public function render($viewPath, $tplVars = null){
        return $this->smarty->fetch($viewPath);
    }
    
    /**
     * 
     * @param unknown $viewPath
     * @param unknown $tplVars
     */
    public function display($viewPath, $tplVars = null){
        return $this->smarty->display($viewPath);
    }
    
    /**
     * 
     * @param unknown $viewDirectory
     */
    public function setScriptPath($viewDirectory){
        if(is_readable($viewDirectory)){
            $this->smarty->setTemplateDir($viewDirectory);
        }
    }
    
    /**
     * 
     */
    public function getScriptPath(){
        return $this->smarty->getTemplateDir();
    }
    
    /**
     * 
     * @param unknown $name
     * @param unknown $value
     */
    public function __set($name, $value = null){
        return $this->smarty->assign($name, $value);
    }
    
    /**
     * 
     * @param unknown $name
     * @return boolean
     */
    public function __get($name){
        if(isset($this->smarty->global_tpl_vars[$name])){
            return $this->smarty->global_tpl_vars[$name];
        }
        return false;
    }
    
    ///**
    // * 
    // * @param unknown $name
    // */
    //public function get($name){
    //    return $this->smarty->get($name);
    //}
}

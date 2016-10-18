<?php
/**
 * @name Ald_Db_Mysql
 * @desc 
 * @author huangpeng
 * @date 2016/8/12 18:43
 */

class Ald_Db_Connect {

    const DB_MATER = 'master';
    const DB_SLAVE = 'slave';

    private static $objPDO;
    private static $dbConfig;

    /**
     * 数据库连接，主库
     * @param $cluster
     * @param string $slave 可选值：slave/master
     * @return mixed
     */
    public static function getMasterPDO($cluster){
        if(!isset(self::$objPDO[$cluster . self::DB_MATER]) || self::$objPDO[$cluster . self::DB_MATER] === false){
            self::$objPDO[$cluster . self::DB_MATER] = self::getMasterConnect($cluster, self::DB_MATER);
        }
        return self::$objPDO[$cluster . self::DB_MATER];
    }

    /**
     * 数据库连接，从库
     * @param $cluster
     * @param string $slave 可选值：slave/master
     * @return mixed
     */
    public static function getSlavePDO($cluster){
        if(!isset(self::$objPDO[$cluster . self::DB_SLAVE]) || self::$objPDO[$cluster . self::DB_SLAVE] === false){
            self::$objPDO[$cluster . self::DB_SLAVE] = self::getSlaveConnect($cluster, self::DB_SLAVE);
        }
        return self::$objPDO[$cluster . self::DB_SLAVE];
    }

    /**
     * @param $cluster
     * @return mixed
     * @throws Exception
     * 获取连接配置
     */
    private static function getDbConfig($cluster){
        if(isset(self::$dbConfig[$cluster])){
            return self::$dbConfig[$cluster];
        }
        $dbConf = Ald_Config::getSysConfig(DS . 'db' . DS . $cluster . '.ini', YAF_ENVIRON);
        if(empty($dbConf)){
            throw new Exception(sprintf('no db server found[%s]', $cluster));
        }
        self::$dbConfig[$cluster] = $dbConf;
        return self::$dbConfig[$cluster];
    }

    /**
     * @param $cluster
     * @return bool|PDO
     * @throws Exception
     * 连接主库
     */
    private static function getMasterConnect($cluster){
        $dbConfig = self::getDbConfig($cluster);
        $host = $dbConfig['db_master']['ip'] . ':' . $dbConfig['db_master']['port'];
        $dbname = $dbConfig['db_name'];
        $dbuser = $dbConfig['db_user'];
        $dbpass = $dbConfig['db_pass'];
        try{
            return new PDO("mysql:host={$host};dbname={$dbname}", $dbuser, $dbpass, array(
                PDO::ATTR_TIMEOUT => 3, //设置连接时间，防止php进程被打死
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ));
        }catch(PDOException $ex){
            Ald_Log::warning(sprintf('db connect failed! db_config[%s,%s,%s,%s] error[%s]', $host, $dbname, $dbuser, $dbpass, $ex -> getMessage()));
            return false;
        }
    }

    /**
     * @param $cluster
     * @return bool|PDO
     * @throws Exception
     * 连接从库
     */
    private static function getSlaveConnect($cluster){
        $dbConfig = self::getDbConfig($cluster);
        $dbname = $dbConfig['db_name'];
        $dbuser = $dbConfig['db_user'];
        $dbpass = $dbConfig['db_pass'];
        $db_slaves = $dbConfig['db_slaves'];
        while(!empty($db_slaves)){  //失败循环重试
            $host_key = array_rand($db_slaves, 1);
            $host = $db_slaves[$host_key]['ip'] . ':' . $db_slaves[$host_key]['port'];
            try{
                return new PDO("mysql:host={$host};dbname={$dbname}", $dbuser, $dbpass, array(
                    PDO::ATTR_TIMEOUT => 2, //设置连接时间，防止php进程被打死
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ));
            }catch(PDOException $ex){
                unset($db_slaves[$host_key]);
                Ald_Log::warning(sprintf('db connect failed! db_config[%s,%s,%s,%s] error[%s]', $host, $dbname, $dbuser, $dbpass, $ex -> getMessage()));
            }
        }
        return false;
    }

} 
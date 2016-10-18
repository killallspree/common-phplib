<?php
/**
 * @name Result.php
 * @desc
 * @author huangpeng
 * @date 2016/8/18 14:23
 */

class Ald_Action_Result {
    public $errno = 0;
    public $error = '操作成功';
    public $data = null;

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param null $data
     */
    public function setData($data)
    {
        if(!empty($data)){
            $this->data = $data;
        }
    }

    /**
     * @return int
     */
    public function getErrno()
    {
        return $this->errno;
    }

    /**
     * @param int $errno
     */
    public function setErrno($errno)
    {
        $this->errno = $errno;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

}
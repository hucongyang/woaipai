<?php
namespace frontend\controllers;

use yii\base\Object;

class NotAndGate extends Object     // 实现属性 第一步：继承自 yii\base\Object
{
    private $_key1;                 // 第二步：声明一个私有成员变量
    private $_key2;

    public function getKey1()       // 第三步：提供getter和setter
    {
        return isset($this->_key1) ? $this->_key1 : null;
    }

    public function getKey2()
    {
        return isset($this->_key2) ? $this->_key2 : null;
    }

    public function setKey1($value)
    {
        $this->_key1 = $value;
    }

    public function setKey2($value)
    {
        $this->_key2 = $value;
    }

    public function getOutput()
    {
        if( $this->_key1 && $this->_key2) {
            return false;
        } elseif ( !($this->_key1) || !($this->_key2) ) {
            return true;
        }
    }

}
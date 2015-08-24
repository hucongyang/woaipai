<?php
namespace frontend\controllers;

use yii\base\Event;

/**
 * 定义事件的关联数据
 * Class MsgEvent
 * @package frontend\controllers
 */
class MsgEvent extends Event
{
    public $dateTime;       // 微博发布的时间
    public $author;         // 微博的作者
    public $content;        // 微博的内容
}

// 在发布新的微博时，准备好要传递给handler的数据
$event = new MsgEvent;
$event->title = $title;
$event->author = $author;

// 触发事件
$msg->trigger(Msg::EVENT_NEW_MESSAGE, $event);
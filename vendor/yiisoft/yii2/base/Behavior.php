<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\base;

/**
 * Behavior is the base class for all behavior classes.
 *
 * A behavior can be used to enhance the functionality of an existing component without modifying its code.
 * In particular, it can "inject" its own methods and properties into the component
 * and make them directly accessible via the component. It can also respond to the events triggered in the component
 * and thus intercept the normal code execution.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Behavior extends Object
{
    /**
     * @var Component the owner of this behavior
     */
    public $owner;              // 指向行为本身所绑定的Component对象
                                // 成员变量，用于指向行为的依附对象

    /**
     * Declares event handlers for the [[owner]]'s events.
     *
     * Child classes may override this method to declare what PHP callbacks should
     * be attached to the events of the [[owner]] component.
     *
     * The callbacks will be attached to the [[owner]]'s events when the behavior is
     * attached to the owner; and they will be detached from the events when
     * the behavior is detached from the component.
     *
     * The callbacks can be any of the followings:
     *
     * - method in this behavior: `'handleClick'`, equivalent to `[$this, 'handleClick']`
     * - object method: `[$object, 'handleClick']`
     * - static method: `['Page', 'handleClick']`
     * - anonymous function: `function ($event) { ... }`
     *
     * The following is an example:
     *
     * ~~~
     * [
     *     Model::EVENT_BEFORE_VALIDATE => 'myBeforeValidate',
     *     Model::EVENT_AFTER_VALIDATE => 'myAfterValidate',
     * ]
     * ~~~
     *
     * @return array events (array keys) and the corresponding event handler methods (array values).
     */
    public function events()            // Behavior 基类本身没用，主要是子类使用，重载这个函数返回一个数组表示行为所关联的事件
    {
        return [];                      // 用户表示行为所有要响应的事件
    }

    /**
     * Attaches the behavior object to the component.
     * The default implementation will set the [[owner]] property
     * and attach event handlers as declared in [[events]].
     * Make sure you call the parent implementation if you override this method.
     * @param Component $owner the component that this behavior is to be attached to.
     */
    public function attach($owner)      // 绑定行为到 $owner；用于将行为与Component绑定起来
    {
        $this->owner = $owner;                                 // 设置好行为的$owner, 使得行为可以访问，操作所依附的对象
        foreach ($this->events() as $event => $handler) {      // 遍历行为中得events()返回的数组，将准备响应的事件，通过所依附类的on()绑定到类上
            $owner->on($event, is_string($handler) ? [$this, $handler] : $handler);
        }
    }

    /**
     * Detaches the behavior object from the component.
     * The default implementation will unset the [[owner]] property
     * and detach event handlers declared in [[events]].
     * Make sure you call the parent implementation if you override this method.
     */
    public function detach()            // 解除绑定；用于将行为从Component上解除
    {
        if ($this->owner) {             // 指定行为名称
            foreach ($this->events() as $event => $handler) {       // 遍历行为定义的事件，一一解除
                $this->owner->off($event, is_string($handler) ? [$this, $handler] : $handler);      // 通过Component的off()将绑定到类的事件handler解除下来
            }
            $this->owner = null;        // 将$owner设置为null，表示这个行为没有依附到任何类上
        }
    }
}

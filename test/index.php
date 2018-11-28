<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/28
 * Time: 20:25
 */
trait Hello
{
    public function sayHello()
    {
        echo 'Hello';
    }
}

trait World
{
    public function sayWorld()
    {
        echo 'World!';
    }
}

trait HelloWorld
{
    use Hello, World;
}

class MyHelloWorld
{
    use HelloWorld;
}

$o = new MyHelloWorld();
$o->sayHello();





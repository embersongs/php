<?php
class A
{
    public static function who()
    {
        echo "A";
    }

    public static function test()
    {
        static::who();
    }
}

class B extends A
{
    public static function who()
    {
        echo "B";
    }

}

B::test();
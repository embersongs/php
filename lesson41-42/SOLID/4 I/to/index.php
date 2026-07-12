<?php

interface WorkAbleInterface {
    public function work();
}

interface SleepAbleInterface {
    public function sleep();
}



class HumanWorker implements WorkAbleInterface, SleepAbleInterface {
    public function work()
    {
        // TODO: Implement work() method.
    }
    public function sleep()
    {
        // TODO: Implement sleep() method.
    }
}



class RobotWorker implements WorkAbleInterface {
    public function work()
    {
        // TODO: Implement work() method.
    }

}
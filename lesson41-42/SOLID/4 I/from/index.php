<?php

interface workerInterface {
    public function work();
    public function sleep();
}



class HumanWorker implements workerInterface {
    public function work()
    {
        // TODO: Implement work() method.
    }
    public function sleep()
    {
        // TODO: Implement sleep() method.
    }
}














class RobotWorker implements workerInterface {
    public function work()
    {
        // TODO: Implement work() method.
    }
    public function sleep()
    {
        // TODO: not needed!
    }
}
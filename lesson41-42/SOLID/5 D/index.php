<?php
include "IFoodProvider.php";
include "Wife.php";
include "Restaurant.php";

//сильная зависимость от wife
//сложно менять архитектуру

class LowRankingMale {
    public function eat() {
        $wife = new Wife();
        $food = $wife->getFood();
        return $food;
    }
}





//код гибче, можно использовать разных жен
//но все равно зависимость от жены есть
//зависимость построена от деталей

class AverageRankingMale {
    private $wife;

    public function __construct(Wife $wife)
    {
        $this->wife = $wife;
    }

    public function eat() {
        $food = $this->wife->getFood();
        return $food;
    }

}
//не важно кто готовит еду, жена или ресторан
//главное он должен обеспечивать нужный интерфейс
//не зависим от класса, а зависим от абстракции

class HighRankingMale {
    private $foodProvider;

    public function __construct(IFoodProvider $foodProvider)
    {
        $this->foodProvider = $foodProvider;
    }
    public function eat() {
        $food = $this->foodProvider->getFood();
        return $food;
    }

}





















$prov = new Restaurant();
$wife = new Wife();
$man = new HighRankingMale($prov);
echo $man->eat();
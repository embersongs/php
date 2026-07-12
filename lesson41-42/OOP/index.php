<?php
//Способы взаимодействие классов (внедрения функционала)
//1. наследование (полная зависимость)

abstract class Vehicle
{
    protected string $brand;

    public function __construct(string $brand)
    {
        $this->brand = $brand;
    }

    public function move(): void
    {
        echo "$this->brand едет...\n";
    }
}

class Car extends Vehicle
{
    private int $doors;

    public function __construct(string $brand, int $doors)
    {
        parent::__construct($brand);
        $this->doors = $doors;
    }

    public function honk(): void
    {
        echo "Би-бип!\n";
    }
}

$car = new Car("Toyota", 4);
$car->move();  // Toyota едет...
$car->honk();


//2. Ассоциация
//классы связаны, но не зависимы
class Student
{
    private string $name;

    private array $courses = []; // ассоциация "многие ко многим"

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function enroll(Course $course): void
    {
        $this->courses[] = $course;
        $course->addStudent($this); // двусторонняя ассоциация
    }
}

class Course
{
    private string $title;
    /** @var Student[] */
    private array $students = [];

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function addStudent(Student $student): void
    {
        $this->students[] = $student;
    }
}

// Использование
$student = new Student("Алексей");
$course = new Course("PHP Advanced");
$student->enroll($course);

//3. Агрегация
//слабая связь
class Wheel
{
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}

class Car
{
    private array $wheels = [];

    public function addWheel(Wheel $wheel): void
    {
        $this->wheels[] = $wheel;
    }

    public function getWheelsInfo(): void
    {
        foreach ($this->wheels as $wheel) {
            echo "Колесо: {$wheel->getType()}\n";
        }
    }
}

// Колёса существуют независимо от машины
$wheel1 = new Wheel("Зимняя");
$wheel2 = new Wheel("Зимняя");

$car = new Car();
$car->addWheel($wheel1);
$car->addWheel($wheel2);

unset($car); // машина уничтожена, колёса остались

//4. Композиция
//сильная связь, часть не может существовать без целого
class Engine
{
    private string $model;
    private bool $running = false;

    public function __construct(string $model)
    {
        $this->model = $model;
    }

    public function start(): void
    {
        $this->running = true;
        echo "Двигатель $this->model запущен\n";
    }
}

class Car
{
    private Engine $engine; // Композиция — двигатель создаётся внутри

    public function __construct(string $engineModel)
    {
        $this->engine = new Engine($engineModel); // сильная связь
    }

    public function startCar(): void
    {
        $this->engine->start();
    }
}

// Двигатель нельзя создать отдельно осмысленно вне машины в этой модели
$car = new Car("V8 Turbo");
$car->startCar();
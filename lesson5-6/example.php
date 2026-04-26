<?php
//Массивы

//объявление массива
$arr = [1, 2];

if(isset($arr[4])) {
    $result = "нет такого элемента";
}

$result = $arr[4] ?? "нет такого элемента";

var_dump($result);



$arr = [1, 2, 3];
//      0  1  2
//добавление элемента в массив
$arr[] = 4;

$arr[15] = 15;

print_r($arr);



$arr[55] = 4;
//перебор элементов массива (не предпочтительно)
for ($i = 0; $i < count($arr); $i++) {
    echo $arr[$i] . PHP_EOL;
}

//предпочтительно
foreach ($arr as $key => $value) { //мутабельная иммутабельная
    //$value = $arr[0]
    echo $key . " => " . $value . PHP_EOL;
}

print_r($arr);

//Массивы словарь, ассоиотивный массив

$translate = [
    'red' => 'красный',
    'green' => 'зеленый',
    'yellow' => 'желтый',
    null => 2
];

$translate['black'] = 'черный';

//перевод
$eng = 'red';
var_dump($translate);

print_r($translate['red']);


//Массивы как данные

$users = [
    [
        'name' => 'Alex',
        'age' => 25,
        'skills' => ['php', 'html', 'css'],
        'photo' => 'bill.webp'
    ],
    [
        'name' => 'Bob',
        'age' => 11,
        'skills' => ['php'],
        'photo' => '2.webp'
    ],
    [
        'name' => 'Joe',
        'age' => 35,
        'skills' => ['php', 'html', 'css', 'javascript'],
        'photo' => '3.jpg'
    ],

];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>hh</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<h2>Список кандидатов</h2>


<?php foreach ($users as $user): ?>
    <div style="background-color: silver;padding: 10px; margin: 10px">
        <h3><?= $user['name'] ?></h3>
        <img src="/images/<?=$user['photo']?>" alt="" width="100"><br>
        Возраст: <?= $user['age'] ?><br>
        Навыки: <br>
        <ol>
            <?php foreach ($user['skills'] as $skill): ?>
                <li><?= $skill ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
<?php endforeach; ?>

</body>
</html>
<?php
//ФУНКЦИИ работы с массивами

$prices = [100, 200, 300, 400, 500];

// Применить скидку 10% ко всем ценам
$withDiscount = array_map(fn($price) => $price * 0.9, $prices);

// Оставить только товары дороже 250
$expensive = array_filter($withDiscount, fn($price) => $price > 250);

// Посчитать итоговую сумму
$total = array_reduce($expensive, fn($sum, $price) => $sum + $price, 0);

echo "Сумма дорогих товаров со скидкой: $total"; // 810 (300*0.9 + 400*0.9 + 500*0.9)

//синтаксис функций
//синтаксис функций
$name = "Alex";
$skills = ['php', 'js'];

hello(
    age: 25,
);


function hello($name = 'guest', $age = 0, $skills = [])
{
    echo "Hello $name, age = $age\n";
    print_r($skills);
}


//типизация и возврат значений

$result = add(2.2, 3);


function add(int $x, int $y): int
{
    return $x + $y;
}

//анонимные функции замыкание

$name = 'Alex';

$foo = function () use ($name) {
    echo "hello $name\n";
};
$name = 'Bob';

$foo();

//стрелочные функции

$name = 'Alex';

$foo = function ($x) {
    return $x * 2;
};

$foo2 = fn($x) => $x * 2;

//пример массива
$cart = [
    [
        'name' => 'Кофемашина',
        'price' => 100,
        'count' => 1,
    ],
    [
        'name' => 'Блендер',
        'price' => 2,
        'count' => 2
    ],

];

function calculatePrice(array $cart): int
{
    $sum = 0;
    foreach ($cart as $item) {
        $sum += $item['price'] * $item['count'];
    }
    return $sum;
}

echo calculatePrice($cart);

//генераторы

function getLargeDataSet(int $count): Generator
{

    for ($i = 0; $i < $count; $i++) {
        yield ['id' => $i, 'data' => str_repeat('a', 1000)];
    }

}

foreach (getLargeDataSet(100_000_000) as $row) {
    if ($row['id'] % 1000_000 === 0) {
        echo "Processed {$row['id']}\n";
    }
}

echo 'Пиковое потребление: ' . memory_get_peak_usage() . " байт\n";

//деструктуризация массивов
$arr = [1, 2];

[$first, $second] = $arr;

echo $first;

$user = [
    'name' => 'John Doe',
    'email' => 'john@doe.com',
];

['name' => $userName, 'email' => $userEmail] = $user;

echo $userName;
echo $userEmail;

//spread оператор ...

$arr1 = [1, 2, 3];
$arr2 = [1, 2, 3];
$merged = [...$arr1, ...$arr2];

echo foo2(...$arr1);

function foo2($a, $b, $c)
{
    return $a . $b . $c;
}


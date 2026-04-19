<?php
//Взятие адреса
$x = 1;

$y = &$x;

$y = 2;

echo $x;

//переменные переменных, динамические переменные
$x1 = 11;
$x2 = 22;
$x3 = 33;

$number = 3;
$name = "x" . $number;

var_dump($x);

//преобразование типов явное и не явное
echo (int)"38попугаев" + "2";

$x = (int)1.5;

var_dump($x);

//метки
{
    echo 1;
    echo 2;
    goto a;
    echo 3;
    a:
    echo 4;
    echo 5;
}

//Условия
$x = 2;

if ($x === "a") {
    echo "true";
} else {
    echo "false";
}

//Составные условия

if ($x == 1 && $y === "a") {} //И
if ($x == 1 || $y === "a") {} //ИЛИ

//тернарник
$x = 2;

if ($x === 2) {
    $result = true;
} else {
    $result = false;
}

$result = $x === 2;

//if альтернативыный синтаксис
$auth = false;
$name = "Админ";
?>
<div>
    <?php if ($auth): ?>
        Добро пожаловать <?= $name;?>
    <?php else: ?>
        <form action="">
            <input type="text" placeholder="Введите логин пароль">
        </form>
    <?php endif; ?>
</div>

<?php
//switch
$x = 3;

if ($x == 1) echo 1;
if ($x == 2) echo 2;
if ($x == 3) echo 3;
if ($x == 4) echo 4;

switch (true) {
    case ($x >1 && $x < 5):
        echo 1;
        break;
    case 2:
        echo 2;
        break;
    case 3:
        echo 3;
        break;
    case 4:
        echo 4;
        break;
    default: //должен быть всегда
        echo "пусто";
}

$result = match ($x) { //$x === 1
    1,2 => 11,
    3 => 33,
};


//ЦИКЛЫ

$i = 1; //счетчик цикла
start:
if ($i <= 5) { //условие выхода или выполнения  тела
    echo $i;
    $i++; //инкремент
    goto start;
}

//цикл с предусловием while
//применяем, когда число итераций не известно или надо бесконечный цикл
$i = 0;
while ($i < 5) {
    $i++;
    if ($i == 3) {
        continue; //перейти на start к следующей итерации
    }
    echo $i;

}
set_time_limit(1); //php ini ставим время выполнения
//Бесконечный цикл
while (true) {
    $i++;
    if ($i > 5) {
        break; //прервать цикл
    }
}

//цикл с предусловием for

for ($i = 0;$i < 5;$i++) {
    echo $i;
}

//цикл с постусловием

$i = 1;
do {
    echo $i;
    $i++;
} while ($i <= 5);


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php include __DIR__ . '/components/menu.php' ?>
<h2>Калькулятор</h2>
<form action="" method="get">
    <input type="hidden" name="page" value="calculator">
    <input id="arg1" type="text" name="arg1" value="<?= htmlspecialchars($arg1) ?>">
    <button data-operation="+" class="calcButton" type="button" style="width: 50px;height: 30px; cursor:pointer">+
    </button>
    <button data-operation="-" class="calcButton" type="button" style="width: 50px;height: 30px; cursor:pointer">-
    </button>
    <button data-operation="*" class="calcButton" type="button" style="width: 50px;height: 30px; cursor:pointer">*
    </button>
    <button data-operation="/" class="calcButton" type="button" style="width: 50px;height: 30px; cursor:pointer">/
    </button>
    <br>

    <input style="width: 50px;height: 30px; cursor:pointer;border: 2px solid <?= $operation === '+' ? 'green' : 'white' ?>"
           type="submit" name="operation"
           value="+">
    <input style="width: 50px;height: 30px; cursor:pointer;border: 2px solid <?= $operation === '-' ? 'green' : 'white' ?>"
           type="submit" name="operation"
           value="-">
    <input style="width: 50px;height: 30px; cursor:pointer;border: 2px solid <?= $operation === '*' ? 'green' : 'white' ?>"
           type="submit" name="operation"
           value="*">
    <input style="width: 50px;height: 30px; cursor:pointer;border: 2px solid <?= $operation === '/' ? 'green' : 'white' ?>"
           type="submit" name="operation"
           value="/">
    <input id="arg2" type="text" name="arg2" value="<?= htmlspecialchars($arg2) ?>">
    =
    <input id="result" type="text" readonly value="<?= htmlspecialchars($result) ?>">
</form>
<?php if (!$errors): ?>
    <p id="textResult">Результат: <?= htmlspecialchars($textResult) ?></p>
<?php else: ?>
    <?php foreach ($errors as $error): ?>
        <p style="color:red">Ошибка: <?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>
<?php endif; ?>
<p style="color:red" id="errors"></p>
<script>
    window.onload = function () {
        document.querySelectorAll('.calcButton').forEach(button => {
            button.onclick = function () {
                const arg1 = document.getElementById('arg1').value;
                const arg2 = document.getElementById('arg2').value;
                const operation = this.getAttribute('data-operation');
                //сделать запрос calculator.php?arg1=2&operation=%2B&arg2=3
                (
                    async () => {
                        try {
                            const response = await fetch(`?page=calculator&arg1=${arg1}&operation=${encodeURIComponent(operation)}&arg2=${arg2}&ajax`);
                            const result = await response.json();
                            switch (result.status) {
                                case 'success':
                                    document.getElementById('errors').innerText = '';
                                    document.getElementById('result').value = result.data.result;
                                    document.getElementById('textResult').innerText = 'Результат: ' + result.data.textResult;
                                    break;
                                case 'error':
                                    document.getElementById('result').value = '';
                                    document.getElementById('textResult').innerText = 'Результат: ';
                                    document.getElementById('errors').innerText = 'Ошибка: ' + result.errors;
                                    break;
                                default:
                                    console.error('Ошибка: не верный формат ответа');
                            }

                        } catch (error) {
                            console.error('Ошибка:', error);
                        }
                    }
                )();
            }
        });

    }
</script>
</body>
</html>


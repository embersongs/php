<?php

//чертеж инкапсуляция (объединение свойств и методов и сокрытие данных)
class Post
{
    //поля объекта, свойства
    protected int $id;
    protected string $title;
    protected string $content;

    public function __construct($id, $title, $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }


    public function show()
    {
        echo "ID: " . $this->id . PHP_EOL;
        echo "Title: " . $this->title . PHP_EOL;
        echo "Content: " . $this->content . PHP_EOL;
    }
}

//Наследование
class Article extends Post
{
    //поля объекта, свойства

    private string $author;

    public function __construct($id, $title, $content, $author)
    {
        parent::__construct($id, $title, $content);
        $this->author = $author;

    }


    public function show()
    {
        parent::show();
        echo $this->title . PHP_EOL;
        echo "Author: " . $this->author . PHP_EOL;

    }
}



//объект
$post1 = new Post(1, "Заголовок", "Текст поста");
$article = new Article(2, "Заголовок2", "Текст поста2", "Петя");

show($article);


//Полиморфизм
function show(Post $post)
{
    $post->show();
}

//попробуйте создать класс Product где хранится 1 товар
//и класс Cart  где будет метод getPrice и addProduct
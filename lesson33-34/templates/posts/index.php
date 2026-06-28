<h2>Все посты</h2>
<?php foreach ($posts as $post): ?>
    <a href="/posts/<?=$post['id']?>">
        <?=$post['title']?>
    </a><br>
<?php endforeach; ?>

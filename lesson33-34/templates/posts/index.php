<h2>Все посты</h2>
<?php foreach ($posts as $post): ?>
    <a href="/post/?id=<?=$post['id']?>">
        <?=$post['title']?>
    </a><br>
<?php endforeach; ?>

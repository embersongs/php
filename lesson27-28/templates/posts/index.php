<a href="/posts/create"> <button>Создать пост</button></a>
<h2>Посты</h2>
<?php if (!empty($success)): ?>
    <p style="color:green"><?=$success?></p>
<?php endif; ?>

<?php if (!isset($error)): ?>
    <?php foreach ($posts as $post): ?>
        <div id="<?=$post['id']?>">
            <h3>
                <a href="/post/<?= $post['id'] ?>">
                    <?= htmlspecialchars($post['title']) ?>
                </a>
                &nbsp;&nbsp;&nbsp;
                <a href="/post/edit/<?=$post['id']?>">[edit]</a>
                &nbsp;&nbsp;&nbsp;
                <a href="/post/delete/<?=$post['id']?>">[X]</a>
                <button data-id="<?=$post['id']?>" type="button" class="deleteBtn" style="width: 50px;height: 30px; cursor:pointer">[x]</button>
            </h3>
            <p><?= htmlspecialchars($post['date']) ?></p>
            <p><?= htmlspecialchars($post['author']) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <?= htmlspecialchars($error) ?>
<?php endif; ?>
<script>
    window.onload = function () {
        document.querySelectorAll('.deleteBtn').forEach(button => {
            button.onclick = function () {
                const id = this.getAttribute('data-id');

                //сделать запрос ?action=delete&id=3
                (
                    async () => {
                        try {
                            const response = await fetch(`/post/delete/${id}/?ajax`);
                            const result = await response.json();
                            switch (result.status) {
                                case 'success':
                                    document.getElementById(id).remove();
                                    break;
                                case 'error':
                                    console.error('Ошибка: не могу удалить');
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

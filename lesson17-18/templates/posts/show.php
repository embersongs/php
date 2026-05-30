<h2>Пост</h2>
<?php if (!empty($success)): ?>
    <p style="color:green"><?=$success?></p>
<?php endif; ?>
<?php if (!isset($error)): ?>
    <div>
        <h3><?= htmlspecialchars($post['title']) ?></h3>

        <p>
            <?php if (isset($post['image'])):?>
                <img src="/upload/<?=htmlspecialchars($post['image'] ?? '')?>" alt="" style="float:left;padding-right:10px;width: 200px">
            <?php endif;?>
            <?= htmlspecialchars($post['content']) ?></p>
        <br style="clear: both">
        <span><?= htmlspecialchars($post['date']) ?></span>
        <span><?= htmlspecialchars($post['author']) ?></span>
        <br>
        <button data-id="<?=$post['id']?>" style="cursor: pointer" id="likes">Likes: <?=htmlspecialchars($post['likes'] ?? 0)?></button>
    </div>
<?php else: ?>
    <?= htmlspecialchars($error) ?>
<?php endif; ?>
<script>
    window.onload = function () {
        document.getElementById('likes').onclick = function () {
            const id = this.getAttribute('data-id');
            //сделать запрос ?action=addlike&id=3
            (
                async () => {
                    try {
                        const response = await fetch(`?page=post&action=addlike&id=${id}&ajax`);
                        const result = await response.json();
                        switch (result.status) {
                            case 'success':
                                document.getElementById('likes').innerText = 'Likes: ' + result.likes;
                                break;
                            case 'error':
                                console.error('Ошибка: не могу поставить лайк');
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
    }
</script>
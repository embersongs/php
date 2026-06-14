-- Добавление новой записи
INSERT INTO posts (title, content, likes)
VALUES ('Мой первый пост', 'Текст содержимого...', 0);

-- Получение всех постов
SELECT * FROM posts;

-- Получение одного поста по id
SELECT * FROM posts WHERE id = 1;

-- Обновление заголовка и содержимого
UPDATE posts
SET title = 'Новый заголовок', content = 'Обновленный текст'
WHERE id = 1;

-- Удаление поста по id
DELETE FROM posts WHERE id = 1;

-- Общее количество постов
SELECT COUNT(id) AS total_posts FROM posts;

-- Количество постов с лайками > 100
SELECT COUNT(*) AS popular_posts FROM posts WHERE likes > 100;

-- Общее количество лайков всех постов
SELECT SUM(likes) AS total_views FROM posts;

-- Среднее количество лайков на пост
SELECT AVG(likes) AS avg_views FROM posts;

-- Самый популярный и наименее популярный пост
SELECT
    MAX(likes) AS max_views,
    MIN(likes) AS min_views
FROM posts;


--Количество постов в каждой категории
SELECT
    c.name category_name,
    COUNT(p.id) post_count
FROM categories c
         LEFT JOIN posts p ON c.id = p.category_id
GROUP BY c.id;

--Количество постов у каждого пользователя
SELECT
    u.name AS user_name,
    COUNT(p.id) AS posts_written
FROM users u
         LEFT JOIN posts p ON u.id = p.user_id
GROUP BY u.id;

--Общее количество лайков у каждого пользователя
SELECT
    u.name AS user_name,
    SUM(ps.likes) AS total_likes
FROM users u
         JOIN posts p ON u.id = p.user_id
         JOIN post_stats ps ON p.id = ps.post_id
GROUP BY u.id;

--Группировка по пользователям и категориям
SELECT
    u.name AS user_name,
    c.name AS category_name,
    COUNT(p.id) AS posts_count
FROM users u
         JOIN posts p ON u.id = p.user_id
         JOIN categories c ON p.category_id = c.id
GROUP BY u.id, c.id;

--HAVING
--Категории с менее чем 4 постами
SELECT
    c.name AS category_name,
    COUNT(p.id) AS post_count
FROM categories c
         LEFT JOIN posts p ON c.id = p.category_id
GROUP BY c.name
HAVING post_count < 4;

--Пользователи с 5 и более постами
SELECT
    u.name AS user_name,
    COUNT(p.id) AS post_count
FROM users u
         LEFT JOIN posts p ON u.id = p.user_id
GROUP BY u.id
HAVING post_count >= 5;
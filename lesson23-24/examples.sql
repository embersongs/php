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
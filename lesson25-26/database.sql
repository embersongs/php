PRAGMA foreign_keys = ON;
--создание структуры таблиц
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;

CREATE TABLE IF NOT EXISTS categories
(
    id   INTEGER PRIMARY KEY NOT NULL UNIQUE,
    name VARCHAR(255)        NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS posts
(
    id          INTEGER PRIMARY KEY NOT NULL UNIQUE,
    title       TEXT                NOT NULL,
    content     TEXT                NOT NULL,
    category_id INTEGER             NOT NULL,
    user_id     INTEGER             NOT NULL,
    FOREIGN KEY (category_id)
        REFERENCES categories (id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
    FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS users
(
    id       integer primary key NOT NULL UNIQUE,
    name     VARCHAR(255),
    email    VARCHAR(255)        NOT NULL,
    password VARCHAR(255)        NOT NULL,
    hash     VARCHAR(255)
);


INSERT INTO `categories` (`id`, `name`)
VALUES (1, 'Спорт'),
       (2, 'Политика'),
       (3, 'Новости');

INSERT INTO users (`id`, `name`, `email`, password)
VALUES (1, 'admin', 'admin@admin.ru', '$2y$12$UMR/LsXwxOKPNufToUHYkOERPkdO3DkxNHsdv8oq0ZivR9hdIcGGq'),
       (2, 'user', 'maria@example.com', '$2y$12$UMR/LsXwxOKPNufToUHYkOERPkdO3DkxNHsdv8oq0ZivR9hdIcGGq');

INSERT INTO `posts` (`id`, `title`, `content`, `category_id`, `user_id`)
VALUES (1, 'Футбольный матч', 'Сегодня состоялся захватывающий футбольный матч между командами...', 1, 2),
       (2, 'Выборы президента', 'На этой неделе началась предвыборная кампания...', 2, 2),
       (3, 'Открытие нового парка', 'В центре города открылся новый парк для отдыха...', 3, 1),
       (4, 'Чемпионат по теннису', 'Российский теннисист вышел в финал турнира...', 1, 2),
       (5, 'Международные переговоры', 'Главы государств провели важные переговоры...', 2, 1),
       (6, 'Новый технологический прорыв', 'Ученые представили новое изобретение...', 3, 2),
       (7, 'Баскетбольные соревнования', 'Завершились национальные соревнования по баскетболу...', 1, 1),
       (8, 'Изменения в законодательстве', 'Приняты новые поправки в налоговом кодексе...', 2, 2),
       (9, 'Погодные аномалии', 'Метеорологи сообщают о необычных погодных явлениях...', 3, 1),
       (10, 'Олимпийские игры', 'Началась подготовка к следующим Олимпийским играм...', 1, 2);



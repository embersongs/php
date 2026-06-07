--создание структуры таблиц
CREATE TABLE IF NOT EXISTS "categories"
(
    "id"   INTEGER NOT NULL,
    "name" VARCHAR NOT NULL UNIQUE,
    "slug" VARCHAR NOT NULL UNIQUE,
    PRIMARY KEY ("id")
);

CREATE TABLE IF NOT EXISTS "posts"
(
    "id"          INTEGER NOT NULL,
    "title"       VARCHAR NOT NULL,
    "content"     TEXT,
    "category_id" INTEGER,
    PRIMARY KEY ("id")
);

--seeding заполнение данными таблиц
INSERT INTO categories (id, name, slug) VALUES (1, 'Политика', 'politics');
INSERT INTO categories (id, name, slug) VALUES (2, 'Спорт', 'sport');
INSERT INTO categories (id, name, slug) VALUES (3, 'Еда', 'food');

INSERT INTO posts (title, content, category_id) VALUES ('Пост 1', 'Пост о политике', 1);
INSERT INTO posts (title, content, category_id) VALUES ('Пост 2', 'Еще Пост о политике', 1);
INSERT INTO posts (title, content, category_id) VALUES ('Пост 2', 'Пост о спорте', 2);
INSERT INTO posts (title, content, category_id) VALUES ('Пост 3', 'Пост о еще', 3);
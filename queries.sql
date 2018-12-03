-- Вставляем значения существующих категорий
INSERT INTO
    categories(name, user_id)
VALUES
    ('Входящие', 1), ('Учеба', 2), ('Работа', 1), ('Домашние дела', 2), ('Домашние дела', 1);
INSERT INTO categories (name) VALUES ('Авто');
-- Вставляем данные пользователей
INSERT INTO
    users(email, name, password)
VALUES
    ('mymail@mail.ru','Иванушка','secret'),
    ('anothermail@gmail.com', 'Алёнушка', 'topsecret');
-- Вставляем значения существующих задач
INSERT INTO
    projects(name, period, user_id, category_id)
VALUES
    ('Собеседование в IT компании','2018.12.01',1 ,3),
    ('Выполнить тестовое задание','2018.12.25',1 ,3),
    ('Сделать задание первого раздела','2018.12.21',2 ,2),
    ('Встреча с другом','2018.12.22',1 ,1);
INSERT INTO
    projects(name, user_id, category_id)
VALUES
    ('Купить корм для кота', 2 ,4),
    ('Заказать пиццу', 1 ,5);
UPDATE projects SET status = 1 WHERE id = 3;
-- получить список из всех проектов для одного пользователя
SELECT * FROM categories WHERE user_id = 1;
-- получить список из всех задач для одного проекта
SELECT * FROM projects WHERE category_id = 3;
-- пометить задачу как выполненную
UPDATE projects SET status = 1 WHERE id = 4;
-- получить все задачи для завтрашнего дня
SELECT * FROM projects WHERE period = CURDATE() + INTERVAL 1 DAY;
-- обновить название задачи по её идентификатору
UPDATE projects SET name = 'Пиццу не хочу, заказать суши' WHERE id = 6;
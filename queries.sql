INSERT INTO `users` (`username`, `email`, `pass`) VALUES
    ('Петр', 'petr@mail.ru', '12345'),
    ('Саша', 'sasha@mail.ru', '54321');

INSERT INTO `project` (`category`, `userID`) VALUES
    ('Входящие', '1'),
    ('Учеба', '1'),
    ('Работа', '1'),
    ('Домашние дела', '2'),
    ('Авто', '2');

INSERT INTO `task` (`task_name`, `status_value`, `deadline`, `userID`, `projectID`) VALUES
    ('Собеседование в IT компании', '0', '2020.09.11.', '1', '3'),
    ('Выполнить тестовое задание', '0', '2020.07.11', '1', '3'),
    ('Встреча с другом', '0', '2020.08.11', '1', '1'),
    ('Сделать задание первого раздела', '1', '2020.06.11', '1', '2'),
    ('Купить корм для кота', '0', '2020.07.11', '2', '4'),
    ('Заказать пиццу', '0', '2020.08.11', '2', '4');


SELECT * FROM `таблица`;  //выбрать все из таблицы
SELECT * FROM `таблица` LIMIT 2;  выбрать все из таблицы но не больше 2 записей
SELECT * FROM `таблица` LIMIT 2, 3; выбрать все из таблицы но пропустить 2 записи и вывести 3 последующих
SELECT `поле`, `поле` FROM `таблица`; //выбрать несколько полей из таблицы 
SELECT `поле`, `поле` FROM `таблица` WHERE id > 3 AND id < 5; //выбрать несколько полей из таблицы у которых id больше 3 и меньше 5
SELECT `поле`, `поле` FROM `таблица` WHERE id <> 4; //... где id не равно 4
SELECT `поле` FROM `таблица` WHERE `category` IS NULL /// IS NOT NULL; в поле категория которой пустое или не пустое
SELECT `поле` FROM `таблица` WHERE `category` = 'Учеба'; где категория равно УЧЕБА
SELECT `поле` FROM `таблица` WHERE `category` = 'Учеба' OR `id` = 2; где категория равно УЧЕБА или id = 2
SELECT DISTINCT `поле` FROM `таблица`; выбрать чтобы значения полей не повторялись из таблицы
SELECT `поле`, `поле` FROM `таблица` WHERE id BETWEEN 2 AND 6; выбрать  поле из таблицы где id в диапазоне между 2 и 6
SELECT `поле` FROM `таблица` WHERE id IN (2, 4, 6); выбрать поле из таблицы где id равно 2, 4, 6
SELECT * FROM `таблица` WHERE `category` LIKE 'В%'; выбрать все поля из таблицы где значение категории начинается на букву В
SELECT * FROM `таблица` WHERE `category` LIKE '%маш%'; где в значении может быть МАШ

WHERE ORDER BY LIMIT // последовательность

SELECT * FROM `таблица` ORDER BY `id`; вывести все из таблицы в порядке возрастания id
SELECT * FROM `таблица` ORDER BY `id` DESC; вывести все из таблицы в порядке убывания id
SELECT * FROM `таблица` ORDER BY `category`; вывести все из таблицы в алфавитном порядке значения КАТЕГОРИИ

//показать все проекты Петра
SELECT p.id, category, username FROM project p  
JOIN users u
ON p.userID = u.id WHERE userID = 1;

//показать все проекты Саши
SELECT p.id, category, username FROM project p  
JOIN users u
ON p.userID = u.id WHERE userID = 2;

//показать все задачи  проекта "Входящие"
SELECT p.id, category, task_name FROM project p  
JOIN task t
ON p.id = t.projectID WHERE p.id = 1;

// в таблице task пометить статус задачи "выполнено" у которой id равно 1 (Собеседование в IT компании)
UPDATE `task` SET `status_value` = '1' WHERE id = 1;
// у этой же задачи поменять название
UPDATE `task` SET `task_name` = 'Собеседование в IT фирме' WHERE id = 1;







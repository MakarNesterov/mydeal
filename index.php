<?php
//подключение функций
include_once('helpers.php');

//подключение к базе данных mysql
$link = mysqli_connect("localhost", "root", "root", 'mydeal');

if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    print("Соединение установлено успешно");
}

// Установка кодировки
mysqli_set_charset($link, "utf8");

// запрос на редактирование
/*$sql = "UPDATE users SET 
username = 'Иван', 
email = 'ivan@mail.ru', 
pass = '11111' WHERE id = 3";*/

// выбрать категории задачи из бд
$sql = "SELECT category FROM project";
$result = mysqli_query($link, $sql);

if ($result == false) {
    print("Произошла ошибка при выполнении запроса");
}

$project = mysqli_fetch_all($result, MYSQLI_NUM);  //преобразование данных из бд в массив

// выбрать задачи из бд
$sql = "SELECT category FROM project";
var_dump($project);







// счетчик количества задач по категориям
function taskCount($project_item, $task) {
    $task_count = 0;                
    foreach ($task as $value) {           
        if ($project_item == $value["Категория"]) {
            $task_count++;                
        }         
    }   
    return $task_count;
}

// массив с названиями категорий задач
//$project = array( "Входящие", "Учеба", "Работа", "Домашние дела", "Авто");

// массив c описанием задач
$task = array (
    array( "Задача" => "Собеседование в IT компании", 
           "Дата выполнения" => "09.11.2020", 
           "Категория" => "Работа", 
           "Выполнен" => ""),
    
    array( "Задача" => "Выполнить тестовое задание", 
           "Дата выполнения" => "07.11.2020", 
           "Категория" => "Работа", 
           "Выполнен" => ""),

    array( "Задача" => "Встреча с другом", 
           "Дата выполнения" => "05.11.2020", 
           "Категория" => "Входящие", 
           "Выполнен" => ""),
           
    array( "Задача" => "Сделать задание первого раздела", 
           "Дата выполнения" => "03.11.2020", 
           "Категория" => "Учеба", 
           "Выполнен" => true),

    array( "Задача" => "Купить корм для кота", 
           "Дата выполнения" => "06.11.2020", 
           "Категория" => "Домашние дела", 
           "Выполнен" => ""),

    array( "Задача" => "Заказать пиццу", 
           "Дата выполнения" => "01.11.2020", 
           "Категория" => "Домашние дела", 
           "Выполнен" => "")
);

date_default_timezone_set('Europe/Moscow');



$show_complete_tasks = rand(0, 1);
$title = "Дела в порядке";
$content = include_template("main.php", array('project' => $project, 'task'=>$task, 'show_complete_tasks'=>$show_complete_tasks));
print (include_template("layout.php", array('title' => $title, 'content'=>$content, 'user_name'=>$user_name)));



?>
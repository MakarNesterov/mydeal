<?php
// Подключение функций.
include_once('helpers.php');

// Подключение к базе данных mydeal.
$link = mysqli_connect("localhost", "root", "root", 'mydeal');

if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
/*else {
    print("Соединение установлено успешно");
}*/

// Установка кодировки.
mysqli_set_charset($link, "utf8");



// ---ПОЛЬЗОВАТЕЛЬ---

// Выберем данные пользователя из БД.
$sql = "SELECT id, username FROM users WHERE id = 3"; // Для смены пользователя 'WHERE id = 1' на значения от 1 до 4.
$result = mysqli_query($link, $sql);

// Если запрос не выполнится.
if ($result == false) {
    print("Произошла ошибка при выполнении запроса");
}
// Преобразуем данные из БД в ассоциативный массив.
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// $userID присвоим id текущего пользователя из массива $users преобразованного из БД.
$userID = $users[0]['id'];
//var_dump($userID);




// ---КАТЕГОРИЯ-ПРОЕКТ---

// Выберем данные категорий из БД, соответствующие id текущего пользователя.
$sql = "SELECT category, id FROM project WHERE userID = $userID";
$result = mysqli_query($link, $sql);

// Если запрос не выполнится.
if ($result == false) {
    print("Произошла ошибка при выполнении запроса");
}

// Преобразуем данные из БД в ассоциативный массив.
$project = mysqli_fetch_all($result, MYSQLI_ASSOC); 




// ---ЗАДАЧИ---

// Выберем данные задач из БД, соответствующие id текущего пользователя.
$sql = "SELECT task_name, status_value, deadline, projectID FROM task WHERE userID = $userID";
$result = mysqli_query($link, $sql);

// Если запрос не выполнится.
if ($result == false) {
    print("Произошла ошибка при выполнении запроса");
}

// Преобразуем данные из БД в ассоциативный массив.
$task = mysqli_fetch_all($result, MYSQLI_ASSOC); 
//var_dump($task);



// Счетчик количества задач в категориях.
function taskCount($project_id, $task) {
    $task_count = 0;                
    foreach ($task as $value) {           
        if ($project_id == $value["projectID"]) {
            $task_count++;                
        }         
    }   
    return $task_count;
}

// массив с названиями категорий задач
//$project = array( "Входящие", "Учеба", "Работа", "Домашние дела", "Авто");

// массив c описанием задач
/*$task = array (
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
);*/

date_default_timezone_set('Europe/Moscow');



$show_complete_tasks = rand(0, 1);
$title = "Дела в порядке";
$content = include_template("main.php", array('project' => $project, 'task'=>$task, 'show_complete_tasks'=>$show_complete_tasks));
print (include_template("layout.php", array('title' => $title, 'content'=>$content, 'users'=>$users)));



?>
<?php
//подключение функций
include_once('helpers.php');

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
$project = array( "Входящие", "Учеба", "Работа", "Домашние дела", "Авто");

// массив c описанием задач
$task = array (
    array( "Задача" => "Собеседование в IT компании", 
           "Дата выполнения" => "05.11.2020", 
           "Категория" => "Работа", 
           "Выполнен" => ""),
    
    array( "Задача" => "Выполнить тестовое задание", 
           "Дата выполнения" => "04.11.2020", 
           "Категория" => "Работа", 
           "Выполнен" => ""),

    array( "Задача" => "Встреча с другом", 
           "Дата выполнения" => "03.11.2020", 
           "Категория" => "Входящие", 
           "Выполнен" => ""),
           
    array( "Задача" => "Сделать задание первого раздела", 
           "Дата выполнения" => "02.11.2020", 
           "Категория" => "Учеба", 
           "Выполнен" => true),

    array( "Задача" => "Купить корм для кота", 
           "Дата выполнения" => "01.11.2020", 
           "Категория" => "Домашние дела", 
           "Выполнен" => ""),

    array( "Задача" => "Заказать пиццу", 
           "Дата выполнения" => "31.10.2020", 
           "Категория" => "Домашние дела", 
           "Выполнен" => "")
);

date_default_timezone_set('Europe/Moscow');
$cur_date = date('d.m.Y');
echo $cur_date;


$show_complete_tasks = rand(0, 1);
$title = "Дела в порядке";
$content = include_template("main.php", array('project' => $project, 'task'=>$task, 'show_complete_tasks'=>$show_complete_tasks));
print (include_template("layout.php", array('title' => $title, 'content'=>$content, 'user_name'=>$user_name)));

include_template($content);

?>
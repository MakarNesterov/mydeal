 
          <div class="content">
            <section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>

                <nav class="main-navigation">
                    <ul class="main-navigation__list">
                        <?php foreach ($project as $value) {
                        $project_item = $value['category'];
                        $project_id = $value['id'];
                        //var_dump($project_id);
                        echo'<li class="main-navigation__list-item">
                            <a class="main-navigation__list-item-link" href="#">'
                             .$project_item.'</a>
                            <span class="main-navigation__list-item-count">'.taskCount($project_id, $task).'</span>
                        </li>'; } ?>
                    </ul>
                </nav>

                <a class="button button--transparent button--plus content__side-button"
                   href="pages/form-project.html" target="project_add">Добавить проект</a>
            </section>

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="index.php" method="post" autocomplete="off">
                    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                        <a href="/" class="tasks-switch__item">Повестка дня</a>
                        <a href="/" class="tasks-switch__item">Завтра</a>
                        <a href="/" class="tasks-switch__item">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                        <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
                        <input class="checkbox__input visually-hidden show_completed" type="checkbox" <? if ($show_complete_tasks == 1)  {echo "checked";} ?>>
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

                <table class="tasks"> <?php foreach ($task as $value) {                   
                    if ($value["status_value"] == true && $show_complete_tasks == 0) continue;                    
                    else if ($value["status_value"] == true) {
                        $task_completed = "task--completed";
                    }
                    else {$task_completed = "";}
                    
                    // Преобразуем текстовое представление даты (время сейчас) в метку времени UNIX.
                    $date_now = strtotime('now');
                    
                    // Форматируем дату дедлайнов из БД в формат 'd.m.Y'.                
                    $date = date_create_from_format('Y-d-m', $value["deadline"]);
                    $date = date_format($date, 'd.m.Y');
                    
                    // Преобразуем форматированную дату дедлайна в UNIX.
                    $date_future = strtotime($date);
                    
                    // Если разница между датой дедлайна и текущей датой меньше или равно суткам -->
                    if ($date_future - $date_now <= 86400) {
                    // То переменная-класс присвоит класс "task--important", помечающий задачу с истекающими сроками выполнения.
                        $task_important = 'task--important';
                    }
                    else {
                        $task_important = '';
                    }
                    
                    echo '<tr class="tasks__item task '.$task_important.' '.$task_completed.' ">  
                        <td class="task__select">
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                                <span class="checkbox__text">'.$value["task_name"].'</span>
                            </label>
                        </td>

                        <td class="task__file">
                            <a class="download-link" href="#">Home.psd</a>
                        </td>

                        <td class="task__date">'.$date.'</td>
                        <td class="task__controls"></td>
                    </tr>';} ?>
                    <!--показывать следующий тег <tr/>, если переменная $show_complete_tasks равна единице-->
                    <?php if ($show_complete_tasks == 1) {
                        print '<tr class="tasks__item task task--completed">
                        <td class="task__select">
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden" type="checkbox" checked>
                                <span class="checkbox__text">Записаться на интенсив "Базовый PHP"</span>
                            </label>
                        </td>
                        <td class="task__date">10.10.2019</td>
                        <td class="task__controls"></td>
                    </tr>
                    ';
                    } ?>
                </table>
            </main>
        </div>

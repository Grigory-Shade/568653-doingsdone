<?php
// Функция шаблонизатор
function include_template($name, $data) {

$name = 'templates/' . $name;
$result = '';

if (!file_exists($name)) {
return $result;
}

ob_start();
extract($data);
require $name;

$result = ob_get_clean();

return $result;
};
// Функция для подсчёта количества задач в категории
function number_of_tasks ($task_list, $project_index) {
    $task_list = (array)$task_list;
    $j = 0;
    foreach ($task_list as $item) {
        if ($item['categories'] == $project_index) {
            $j++;
        }
    }
    return $j;
}
// Функция для фильтрации сторонних скриптов
function antiscript($str) {
    $text = htmlspecialchars($str);
    //$text = strip_tags($str); Альтернативный вариант

    return $text;
}
// Функция определения остатка 24 часов до окончания задания
function deadline($date_str) {
        $current_time = time();
        $execution_time = strtotime($date_str);
        $diff_time = $execution_time - $current_time;
        $hours = floor($diff_time/3600);
           if ($hours < 24 && $execution_time > 0) {
                return true;
            }
}

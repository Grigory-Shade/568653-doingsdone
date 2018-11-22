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
function number_of_tasks ($project, $catkey) {
    require('data.php');
    $j = 0;
    foreach ($project as $item) {
        if ($item['categories'] == $catkey) {
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
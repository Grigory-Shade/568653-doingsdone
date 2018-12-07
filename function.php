<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

// Часовой пояс по умолчанию
date_default_timezone_set("Europe/Moscow");

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
    $j = 0;
    foreach ($task_list as $item) {
        if ($item['category_id'] == $project_index) {
            $j++;
        }
    }
    return $j;
}
// Функция для фильтрации сторонних скриптов
function antiscript($str) {
    $text = htmlspecialchars($str);

    return $text;
}
// Функция определения остатка 24 часов до окончания задания
function deadline($date_str)
{
    $current_time = time();
    $execution_time = strtotime($date_str);
    $diff_time = $execution_time - $current_time;
    $hours = floor($diff_time / 3600);
    if ($hours > 0 && $hours < 24 && $execution_time > 0) {
        return true;
    }
}
/*Функцция для получения подготовленного выражения
@param $link mysqli Ресурс соединения
* @param $sql string SQL запрос с плейсхолдерами вместо значений
* @param array $data Данные для вставки на место плейсхолдеров
*
     * @return mysqli_stmt Подготовленное выражение
*/
function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = null;

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);
    }

    return $stmt;
}
// Функция получения записей из базы данных (использует пользовательскую функцию db_get_prepare_stmt)
function db_select_data($link, $sql, $data = []) {

 $result = [];
 $stmt = db_get_prepare_stmt($link, $sql, $data);
 mysqli_stmt_execute($stmt);
 $res = mysqli_stmt_get_result($stmt);

 if ($res) {
 $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
 }
 return $result;
}
// Функция добавления записи в базу данных (использует пользовательскую функцию db_get_prepare_stmt)
function db_insert_data($link, $sql, $data = []) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
        $result = mysqli_insert_id($link);
    }
    return $result;
}

// Функция определения максимального индекса категории для текущего пользователя
function max_category_id ($link, $user_id) {
    $array_max_category_id = db_select_data($link, 'SELECT MAX(category_id) FROM projects WHERE user_id = ?', [$user_id]);
    $max_category_id = $array_max_category_id[0]['MAX(category_id)'];
    return $max_category_id;
}
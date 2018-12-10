<?php

require_once('function.php');
require_once ('init.php');

$user_id = 1;

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', [
        'title' => 'Ошибка подключения',
        'error' => $error
    ]);
} else {
// Вывод названий категорий
    $sql = 'SELECT id, name FROM categories WHERE user_id = ?';
    $result = mysqli_query($link, $sql);
    $categories = db_select_data($link, $sql, [$user_id]);
// Вывод количества задач в каждой категории
    $sql = 'SELECT category_id FROM projects WHERE user_id = ?';
    $result = mysqli_query($link, $sql);
    $count_projects = db_select_data($link, $sql, [$user_id]);
    if (!$result) {
        $error = mysqli_error($link);
        $content = include_template('error.php', [
            'title' => 'Ошибка подключения',
            'error' => $error
        ]);
    }
// Показ конкретных задач в каждой категории или выпадение на 404
    if (isset($_GET['cat_id'])) {
        $selected_category = $_GET['cat_id'];
        $sql = 'SELECT status, name, file, period, category_id FROM projects WHERE user_id = ? AND category_id = ?';
        if ($_GET['cat_id'] > max_category_id($link, $user_id) || $_GET['cat_id'] < 0) {
            http_response_code(404);
            echo 'Что-то пошло не так';
            die();
        }
    } elseif (!isset($_GET['cat_id'])) {
        $sql = 'SELECT status, name, file, period, category_id FROM projects WHERE user_id = ?';
    }
    $project = db_select_data($link, $sql, [$user_id, $selected_category]);
    if (!$result) {
        $error = mysqli_error($link);
        $content = include_template('error.php', [
            'title' => 'Ошибка подключения',
            'error' => $error
        ]);
    }
}
// Шаблонизация
$main_content = include_template('index.php', [
    'project' => $project,
    'show_complete_tasks' => $show_complete_tasks
]);
$layout_content = include_template('layout.php', [
    'title' => 'Дела в порядке',
    'content' => $main_content,
    'categories' => $categories,
    'count_projects' => $count_projects
]);
print ($layout_content);

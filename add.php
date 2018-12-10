<?php
require_once ('init.php');
require_once('function.php');

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
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project = $_POST['project'];

    $filename = uniqid() . '.gif';
    $project['path'] = $filename;
    move_uploaded_file($_FILES['preview']['tmp_name'], 'uploads/' . $filename);
}

$sql = 'INSERT INTO projects (date_add, category_id, user_id, name, file) VALUES (NOW(), ?, 1, ?, ?)';
$insert_task = db_insert_data($link, $sql, [$project['category'], $project['name'], $project['path']]);
$result = mysqli_query($link, $sql);
if (!$result) {
    $error = mysqli_error($link);
    $content = include_template('error.php', [
        'title' => 'Ошибка подключения',
        'error' => $error
    ]);
}
$content = include_template('add.php', ['categories' => $categories]);
$layout_content = include_template('layout.php', [
    'title' => 'Дела в порядке',
    'content' => $content,
    'categories' => $categories,
    'count_projects' => $count_projects
]);
print $insert_task;
//print ($layout_content);
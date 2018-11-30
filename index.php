
<?php

//require_once('data.php');
require_once('function.php');
require_once ('init.php');

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', [
        'title' => 'Ошибка подключения',
        'error' => $error
    ]);
}
else {
    $sql = 'SELECT id, name FROM categories WHERE user_id = 1';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($link);
        $content = include_template('error.php', [
            'title' => 'Ошибка подключения',
            'error' => $error
        ]);
    }
}

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', [
        'title' => 'Ошибка подключения',
        'error' => $error
    ]);
}
else {
    $sql = 'SELECT status, name, file, period, category_id FROM projects WHERE user_id = 1';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $project = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($link);
        $content = include_template('error.php', [
            'title' => 'Ошибка подключения',
            'error' => $error
        ]);
    }
}

$main_content = include_template('index.php', [
    'project' => $project,
    'show_complete_tasks' => $show_complete_tasks
]);
$layout_content = include_template('layout.php', [
    'title' => 'Дела в порядке',
    'content' => $main_content,
    'categories' => $categories,
    'project' => $project,
]);
//print deadline($date_str);
print ($layout_content);

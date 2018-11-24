
<?php

require_once('data.php');
require_once('function.php');


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

print ($layout_content);

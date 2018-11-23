
<?php

//require_once('data.php');
require_once('function.php');


$main_content = include_template('index.php', ['project' => $project]);
$layout_content = include_template('layout.php', [
    'title' => 'Дела в порядке',
    'content' => $main_content,
    'categories' => $categories
]);

print ($layout_content);

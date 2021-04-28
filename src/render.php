<?php

function render_view(string $name, array $params = [], string $layout = 'layout') {
    extract($params);
    ob_start();
    require('views/' . $name . '.php');
    $route = $name;
    $content = ob_get_clean();
    require("views/$layout.php");
}

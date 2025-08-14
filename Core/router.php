<?php
function router($connection)
{
    $defaultController = 'site/home';
    $defaultAction = 'home';

    $controllerParam = $_GET['controller'] ?? $defaultController;
    $action = $_GET['action'] ?? $defaultAction;

    if (!$controllerParam) return error('Controlador no especificado');

    $controllerPath = 'controllers/' . $controllerParam . 'Controller.php';

    if (!file_exists($controllerPath)) return error("Archivo del controlador no encontrado: $controllerPath");

    include_once $controllerPath;

    $parts = explode('/', $controllerParam);
    $classBaseName = end($parts);
    $controllerClass = $classBaseName . 'Controller';

    if (!class_exists($controllerClass)) return error("Clase del controlador no encontrada: $controllerClass");

    $controller = new $controllerClass();

    if (!$action) return error("Acción no especificada");

    if (!method_exists($controller, $action)) return error("La acción no existe");

    $controller->$action($connection);
}

function error($msg)
{
    echo "<h3>Error: $msg</h3>";
}

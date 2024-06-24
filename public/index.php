<?php
include '../config/db.php';
include '../app/controllers/menuController.php';

$controller = new MenuController($conn);

$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$menu_id = $_GET['menu_id'] ?? null;

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'update':
        $controller->update();
        break;
    case 'delete':
        $controller->delete();
        break;
    case 'show_menus':
            $controller->showMenus();
            break;
    case 'show_menus2':
                $controller->showMenus2();
                break;
    default:
        $controller->index();
        break;
}
?>

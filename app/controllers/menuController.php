<?php
include_once '../app/models/Menu.php';

class MenuController {
    private $menu;

    public function __construct($db) {
        $this->menu = new Menu($db);
    }

    public function index($menu_id = null) {
        $menus = $this->menu->getAllMenus();
        $selected_menu = null;

        if ($menu_id) {
            $selected_menu = $this->menuModel->getMenuById($menu_id);
        }
        include '../app/views/index.php';
    }

    public function create() {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : NULL;
        $this->menu->createMenu($name, $description, $parent_id);
        header("Location: index.php");
    }

    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : NULL;
        $this->menu->updateMenu($id, $name, $description, $parent_id);
        header("Location: index.php");
    }

    public function delete() {
        $id = $_POST['id'];
        $this->menu->deleteMenu($id);
        header("Location: index.php");
    }

    public function showMenus() {
        $menus = $this->menu->getAllMenus();
        include '../app/views/show_menus.php';
    }
    public function showMenus2() {
        $menus = $this->menu->getAllMenus();
        include '../app/views/show_menus2.php';
    }
}
?>

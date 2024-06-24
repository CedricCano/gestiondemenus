<?php
class Menu {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllMenus() {
        $result = $this->conn->query("SELECT * FROM menus");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMenuById($id) {
        $query = "SELECT * FROM menus WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createMenu($name, $description, $parent_id) {
        if ($parent_id==null){
            $stmt = $this->conn->prepare("INSERT INTO menus (nombre_del_menu, descripcion_del_menu) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $description);
        }
        else
        {
            $stmt = $this->conn->prepare("INSERT INTO menus (nombre_del_menu, descripcion_del_menu, id_menu_padre) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $name, $description, $parent_id);
        }
        $stmt->execute();
    }

    public function updateMenu($id, $name, $description, $parent_id) {
        if ($parent_id==null){
            $stmt = $this->conn->prepare("UPDATE menus SET nombre_del_menu = ?, descripcion_del_menu = ? WHERE id = ?");
            $stmt->bind_param("ssi", $name, $description, $id);
        }
        else
        {
            $stmt = $this->conn->prepare("UPDATE menus SET nombre_del_menu = ?, descripcion_del_menu = ?, id_menu_padre = ? WHERE id = ?");
            $stmt->bind_param("ssii", $name, $description, $parent_id, $id);
        }
        $stmt->execute();
    }

    public function deleteMenu($id) {
        $stmt = $this->conn->prepare("DELETE FROM menus WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>

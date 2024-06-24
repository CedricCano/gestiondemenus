<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Menús</title>
    <!-- Incluir Bootstrap CSS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .dropdown-menu a {
            color: white;
        }
        .dropdown-menu {
            background-color: #333;
        }
        .dropdown-menu a:hover {
            background-color: #575757;
        }
        ul, ol {
            list-style:none;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a href="index.php?action=show_menus2" class="navbar-brand">Sistema de Gestión de Menús</a>
            <?php
                function renderMenu($menus, $parent_id = null) {
                    $result = array_filter($menus, function($menu) use ($parent_id) {
                        return $menu['id_menu_padre'] == $parent_id;
                    });



                    if (count($result) > 0) {
                            echo '<ul class="navbar-nav">';
                            foreach ($result as $item) {
                                $children = array_filter($menus, function($menu) use ($item) {
                                    return $menu['id_menu_padre'] == $item['id'];
                                });
                    
                                if (count($children) > 0) {
                                    echo '<li class="nav-item dropdown">';
                                    echo '<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown' . $item['id'] . '" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $item['nombre_del_menu'] . '</a>';
                                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown' . $item['id'] . '">';
                                    renderMenu($menus, $item['id']);
                                    echo '</div>';
                                } else {
                                    echo '<li class="nav-item">';
                                    echo '<a class="nav-link" href="#">' . $item['nombre_del_menu'] . '</a>';
                                    echo '</li>';
                                }
                            }

                    }

                }

                renderMenu($menus);
                ?>

        </div>
    </nav>


    <div class="container mt-4">
        
    <h1>Gestión de Menús</h1>
        <a href="index.php">Inicio</a>

        <form action="index.php?action=create" method="post" class="mt-4">
            <input type="text" name="name" placeholder="Nombre del Menú" required class="form-control mb-2">
            <input type="text" name="description" placeholder="Descripción del Menú" required class="form-control mb-2">
            <select name="parent_id" class="form-control mb-2">
                <option value="">Menú Principal</option>
                <?php foreach ($menus as $menu): ?>
                    <option value="<?php echo $menu['id']; ?>"><?php echo $menu['nombre_del_menu']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary">Añadir</button>
        </form>

        <h2 class="mt-4">Menús Existentes</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Menú Padre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menus as $menu):
                    $parent_menu = $menu['id_menu_padre'] ? array_column($menus, 'nombre_del_menu', 'id')[$menu['id_menu_padre']] : 'N/A';
                ?>
                <tr>
                    <form action="index.php?action=update" method="post">
                        <td><input type="text" name="name" value="<?php echo $menu['nombre_del_menu']; ?>" class="form-control"></td>
                        <td><input type="text" name="description" value="<?php echo $menu['descripcion_del_menu']; ?>" class="form-control"></td>
                        <td>
                            <select name="parent_id" class="form-control">
                                <option value="">Menú Principal</option>
                                <?php foreach ($menus as $m): ?>
                                    <option value="<?php echo $m['id']; ?>" <?php echo $m['id'] == $menu['id_menu_padre'] ? 'selected' : ''; ?>><?php echo $m['nombre_del_menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <button type="submit" formaction="index.php?action=delete" class="btn btn-danger">Eliminar</button>
                        </td>
                    </form>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

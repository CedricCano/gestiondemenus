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



#descripcion {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80%;
    height: 100px;
    border: 1px solid #ccc;
    border-radius: 10px;
    text-align: center;
}

.hidden {
    display: none;
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
                            echo '<ul class="navbar-nav" id="menu">';
                            foreach ($result as $item) {
                                $children = array_filter($menus, function($menu) use ($item) {
                                    return $menu['id_menu_padre'] == $item['id'];
                                });
                    
                                if (count($children) > 0) {
                                    echo '<li class="nav-item dropdown">';
                                    echo '<a href="#" data-description="' . $item['descripcion_del_menu'] . '" class="nav-link dropdown-toggle" id="navbarDropdown' . $item['id'] . '" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $item['nombre_del_menu'] . '</a>';
                                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown' . $item['id'] . '">';
                                    renderMenu($menus, $item['id']);
                                    echo '</div>';
                                } else {
                                    echo '<li class="nav-item">';
                                    echo '<a class="nav-link" href="#" data-description="' . $item['descripcion_del_menu'] . '">' . $item['nombre_del_menu'] . '</a>';
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
    <h1>Bienvenido</h1>
        <a href="index.php?action=show_menus2">Gestionar menú interactivo</a>

        <h1>Menú del Sitio</h1>
        <div class="menu">
            <?php
            function renderMenu2($menus, $parent_id = null) {
                $result = array_filter($menus, function($menu) use ($parent_id) {
                    return $menu['id_menu_padre'] == $parent_id;
                });

                if (count($result) > 0) {
                    echo '<ul>';
                    foreach ($result as $menu) {
                        echo '<li>' . $menu['nombre_del_menu'];
                        renderMenu2($menus, $menu['id']);
                        echo '</li>';
                    }
                    echo '</ul>';
                }
            }

            renderMenu2($menus);
            ?>
        </div>
        <div id="descripcion" class="hidden" style="display: flex; align-items: center; justify-content: center; width: 80%; height: 100px; border: 1px solid #ccc; border-radius: 10px; text-align: center;">
            Seleccione una opción del menú.</div>

        <?php if ($selected_menu): ?>
            <div class="alert alert-info mt-4" role="alert">
                <?php echo $selected_menu['descripcion_del_menu']; ?>
            </div>
        <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const menuItems = document.querySelectorAll("#menu a");
        const descripcionDiv = document.getElementById("descripcion");

        menuItems.forEach(item => {
            item.addEventListener("click", function(event) {
                event.preventDefault();  // Previene el comportamiento por defecto del enlace
                const descripcion = item.getAttribute("data-description");
                descripcionDiv.textContent = descripcion;

                descripcionDiv.classList.remove("hidden");
            });
        });
    });
</script>
</body>
</html>

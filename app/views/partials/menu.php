<?php
function renderMenu($menus, $parent_id = 0) {
    $items = array_filter($menus, function($menu) use ($parent_id) {
        return $menu['id_menu_padre'] == $parent_id;
    });

    if (count($items) > 0) {
        echo '<ul class="navbar-nav mr-auto">';
        foreach ($items as $item) {
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
        echo '</ul>';
    }
}
?>



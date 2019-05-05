<?php
    echo '<ul>';
    foreach ($users as $user) {
        echo '<li>
            <a href="#' . $user->UserId . '">' . $user->FullName . '</a>
            </li>';
    }
    echo '</ul>';
?>
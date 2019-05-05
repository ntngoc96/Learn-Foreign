<?php
    // if(!hasSession('userid')){
    //     redirectTo('../html/login.html');
    // }
?>

<link rel="stylesheet" href="assets/css/users/user_information.css">
<div class="container">
    <!-- <a href="./logout.php">Logout</a> -->
    <section class="section-information">
        <?php
                echo <<<_RENDER_INFORMATION
                <div class="information__header">
                    <div class="header__avatar">
                        <img src={$user->Avatar} alt="" class="header__avatar--img">
                    </div>
                    <div class="header__fullname">{$user->FullName}</div>
                    <nav class="navigation">
                        <ul class="nav__list">
                            <li class="nav__item"><a href="index.php?controller=words" class="nav__link">Mangager word library</a></li>
                            <li class="nav__item"><a href="index.php?controller=words&action=render_addWord" class="nav__link">Add new word</a></li>
                            <li class="nav__item"><a href="index.php?controller=words" class="nav__link">Make a test</a></li>
                            <li class="nav__item"><a href="#" class="nav__link">Ranking</a></li>
                            <li class="nav__item"><a href="index.php?controller=users&action=render_updateInformation" class="nav__link">Update Information</a></li>
                            <li class="nav__item"><a href="index.php?controller=account&action=logout" class="nav__link">Log out</a></li>
                        </ul>
                    </nav>
                </div>
                <table class="table__information">
                    <tr>
                        <th width="20%">Birthday</th>
                        <td>{$user->Dob}</td>
                    </tr>
                    <tr>
                        <th width="20%">Gender</th>
                        <td>{$user->Gender}</td>
                    </tr>
                    <tr>
                        <th width="20%">Address</th>
                        <td>{$user->Address}</td>
                    </tr>
                    <tr>
                        <th width="20%">School Id</th>
                        <td>{$user->SchoolId}</td>
                    </tr>
_RENDER_INFORMATION;
            ?>
        </table>
    </section>
</div>

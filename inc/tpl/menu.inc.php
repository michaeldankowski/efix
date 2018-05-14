<?php var_dump($menuRoles[$_SESSION['Rola']]) ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end fixed-top" id="navbar-top">
    <div class="container">
        <a class="navbar-brand" href="panel.php"><img src="img/logo.png" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto" >


                <?php foreach ($menuRoles[$_SESSION['Rola']] as $menu) : ?>


                    <?php if (isset($menu['submenu']) && !empty($menu['submenu'])) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?php echo $menu['url'] ?>" data-toggle="dropdown"><?php echo $menu['label']; ?></a>
                            <div class="dropdown-menu">
<?php foreach ($menu['submenu'] as $submenu) : ?>
                                <a class="dropdown-item" href="<?php echo $submenu['url'] ?>"><?php echo $submenu['label'] ?></a>
                                <?php endforeach; ?>

                            </div>

                        </li>                        
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $menu['url'] ?>"><?php echo $menu['label']; ?></a>
                        </li>
                    <?php endif; ?>

                <?php endforeach; ?>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Pojazdy</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="pojazdy.php">Pojazdy</a>
                        <a class="dropdown-item" href="dodawaniepojazdu.php">Dodawanie pojazdu</a>

                    </div>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#oferta">Oferta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Rejestracja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#galeria">Galeria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Wyloguj</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

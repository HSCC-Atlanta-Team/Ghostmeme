<?php
session_start();
?>


<div style="z-index:1000;" class="container col-md-12 p-0 m-0  sticky-top">
    <nav class="navbar navbar-expand-md navbar-light bg-light rounded-bottom">

        <!-- <img src="/web-assets/images/BDPA-Flights-Black.jpeg" class="rounded" width="44" height="44" alt="" loading="lazy"> -->

        <a href="<?=$_ENV['BASE_URL']?>" class="navbar-brand mb-0 h1 ml-3">Ghostmeme</a> <!-- Make name Airlanta -->
        <div class="col col-md w-100 justify-content-center">
            <form method='get' action="<?=$_ENV['BASE_URL']?>">
                <input name='search' type='search' placeholder='search'>
                <!-- <button class = 'btn btn-primary'type="submit"> Search </button> -->
            </form>
        </div>
            <div class="navbar-nav ml-auto">
            

                <?php
                    $session_status = session_status();
                    if(isset($_SESSION['user']) || isset($_COOKIE['user'])){
                        $status = 2;
                    } else{
                        $status = 1;
                    }
                    switch ($status) {
                        case 0:
                            echo "Session is disabled!";
                            break;
                        case 1:
                        $showSideBar = true;
                            ?>
                            <a class="nav-item nav-link" href="<?= $_ENV['BASE_URL'] .  '/signup.php'?>
                            ">Signup</a>
                            <a class="nav-item nav-link" href="<?= $_ENV['BASE_URL'] . '/login.php' ?>">Login</a>
                            <?php
                            break;
                        case 2:
                            $showSideBar = true;
                            ?>
                                 <a class="nav-item nav-link" href=""> Notifications </a>
                                 <a class="nav-item nav-link" href="<?= $_ENV['BASE_URL'] . '/logout.php' ?>"> Log Out </a>
                            <?php
                            break;
                    }?>
            </div>
        </div>
    </nav>
</div>
<?php 
if ($showSideBar == true) {
    include_once $_ENV['BASE_DIRECTORY'] . '/web-assets/app_nav/sidenav.php';
}
?>
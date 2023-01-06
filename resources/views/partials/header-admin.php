<?php

use Core\Helpers\Helper; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=$_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']?>/resources/css/styles.css">
    <link rel="stylesheet" href="<?=$_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']?>/resources/css/media.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prosto+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <link rel="icon" type="image/x-icon" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/icons8-pos-terminal-64.png">
    
</head>

<body class="admin-view">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Navbar brand -->
            
            <div class="site-logo">
                <img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']?>/resources/Images/pos_new_30.png" alt="Logo" class="img-fluid rounded-circle" style="width: 66px;border-radius: 50%;">
            </div>
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-light"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left links -->
                <ul class="navbar-nav ms-auto d-flex flex-row mt-3 mt-lg-0">
                    <li class="nav-item text-center mx-2 mx-lg-1">
                        <a class="nav-link active" href="/user/profile">
                            <div>
                                <i class="fa-solid fa-address-card mb-1"></i>
                            </div>
                            My Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="admin-area" class="row">
       <div class="col-3">
        <!-- Sidebar -->
        <div id="sidebarMenu" class="collapse d-lg-block sidebar collapse">
            <div class="position-sticky">
            <div class=" list-group-flush mx-3 mt-5">
                <?php if (Helper::check_permission(['user:read'])) : ?>
                <a
                href="/dashboard"
                class="list-group-item list-group-item-action py-2 ripple mt-3"
                aria-current="true"
                >
                <i class="fa-solid fa-house fa-fw me-3"></i><span>Main dashboard</span>
                </a>
                <a href="/users" class="list-group-item list-group-item-action py-2 ripple mt-3">
                <i class="fa-solid fa-users-gear fa-fw me-3"></i><span>Users</span>
                </a>
                <?php endif; ?>
                <?php if (Helper::check_permission(['user:create'])) : ?>
                <a href="/users/create" class="list-group-item list-group-item-action py-2 ripple mt-3"
                ><i class="fa-solid fa-user-plus fa-fw me-3"></i><span>add user</span></a
                >
                <?php endif; ?>
                <?php if (Helper::check_permission(['item:read'])) : ?>
                <a href="/items" class="list-group-item list-group-item-action py-2 ripple mt-3"
                ><i class="fa-solid fa-database fa-fw me-3"></i></i><span>Items</span></a
                >
                <?php endif; ?>
                <?php if (Helper::check_permission(['item:create'])) : ?>
                <a href="/items/create" class="list-group-item list-group-item-action py-2 ripple mt-3">
                <i class="fa-solid fa-plus fa-fw me-3"></i><span>add item</span>
                </a>
                <?php endif; ?>
                <?php if (Helper::check_permission(['account:read'])) :?>
                <a href="/accounts/page" class="list-group-item list-group-item-action py-2 ripple mt-3"
                ><i class="fa-solid fa-file-invoice fa-fw me-3"></i><span>Accounts</span></a
                >
                <?php endif; ?>
                <?php if (Helper::check_permission(['seller:read'])) :?>
                <a href="/selling/page" class="list-group-item list-group-item-action py-2 ripple mt-3"
                ><i class="fa-solid fa-cart-shopping fa-fw me-3"></i><span>Selling</span></a
                >
                <?php endif; ?>
                <a href="/logout" class="list-group-item list-group-item-action py-2 ripple mt-3"
                ><i class="fa-solid fa-right-from-bracket fa-fw me-3"></i><span>Logout</span></a
                >
            </div>
            </div>
</div>
  <!-- Sidebar -->
       </div>
        <div class="col-lg-8">

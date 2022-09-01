<?php
defined('BASEPATH') or exit('No direct script access allowed');




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="copyright" content="copyright" />
    <title> ValoJuegoRa </title>
    <link rel="icon" href="<?php echo base_url('assets/img/LOGO.PNG') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
    <script src="<?php echo base_url('/assets/js/jquery-3.6.0.min.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/fontawesome6.1.1/css/all.min.css') ?>">
    
</head>
<body>
<div class="container-fluid bg-dark header-div">
    <div class="row d-flex text-center">
        <div class="col-12">
            <nav class="container navbar navbar-expand-lg navbar-light bg-dark">
                <div class="text-white collapse navbar-collapse d-flex justify-content-around" id="navbarTogglerDemo01">
                <a href="<?php echo base_url('/homeAdmin') ?>"><img src="<?php echo base_url('assets/img/LOGO.PNG') ?>" alt="" width="100px" height="50px"></a>
                    <a class="navbar-brand text-white" href="<?php echo base_url('homeAdmin') ?>"> ValoJuegoRa </a>
                    <ul class="navbar-nav mr-auto mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="<?php echo base_url('homeAdmin') ?>">Inicio <span class="sr-only">(actual)</span></a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="inscribirse.html">Inscribirse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">Sobre nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="anteriores.html">Eventos Anteriores</a>
                        </li> -->
                    </ul>
                    <?php if(isset($_SESSION['loggedInAdmin'])){
                        
                        ?>
    
                        Bienvenido  <?php echo $_SESSION['loggedInAdmin'] ?>
                        <a href="<?php echo base_url('logoutAdmin') ?>" class="btn-dark"> Desconectar </a>

                        <?php

                    }else{

                    ?>
                   
                    <?php } ?>
                </div>
            </nav>
        </div>
    </div>
</div>


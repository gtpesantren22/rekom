<!doctype html>
<html lang="en">

<head>
    <title>Rekom App</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/') ?>datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/iziToast/dist/css/iziToast.min.css" />

</head>

<body>

    <div class="wrap">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col">
                    <p class="mb-0 phone"><span class="fa fa-home"></span> <a href="#">PP. Darul Lughah Wal Karomah</a></p>
                </div>
                <div class="col d-flex justify-content-end">
                    <div class="social-media">
                        <p class="mb-0 d-flex">
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-youtube"><i class="sr-only">YouTube</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-music"><i class="sr-only">TikTok</i></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">App Rekom <span>Liburan Santri</span></a>
            <form action="#" class="searchform order-sm-start order-lg-last">
                <div class="form-group d-flex">
                    <!-- <input type="text" class="form-control pl-3" placeholder="Search"> -->
                    <!-- <button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button> -->
                    <a href="<?= base_url('login/logout') ?>" class="btn btn-sm btn-danger tbl-confirm" value="Anda akan keluar dari aplikasi"><i class="fa fa-power-off"></i> LogOut</a>
                </div>
            </form>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item"><a href="<?= base_url('/') ?>" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data Santri</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="<?= base_url('santri/putra') ?>">Santri Putra</a>
                            <a class="dropdown-item" href="<?= base_url('santri/putri') ?>">Santri Putri</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Daftar Tanggungan</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="<?= base_url('tanggungan/putra') ?>">Putra</a>
                            <a class="dropdown-item" href="<?= base_url('tanggungan/putri') ?>">Putri</a>
                        </div>
                    </li>
                    <li class="nav-item"><a href="<?= base_url('listdata') ?>" class="nav-link">List Data</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('ok') ?>"></div>
    <div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error') ?>"></div>
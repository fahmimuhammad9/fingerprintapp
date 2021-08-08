<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/') ?>assets/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <link href="<?= base_url('assets/') ?>css/bootstrap.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">FingerPrint App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Sign Up
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="<?= base_url('register'); ?>" method="post">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Masukkan Nama Pengguna" name="name" id="name">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="email" placeholder="Masukkan Email Pengguna" name="email" id="email">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="password" placeholder="Masukkan Kata Sandi" name="password" id="password">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="password" placeholder="Masukkan Ulang Kata Sandi" name="confirm" id="confirm">
                                        </div>
                                        <button type="submit" class="btn btn-info btn-block">Register</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                        Log In
                    </button>

                    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Login Sistem</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="<?= base_url('login'); ?>" method="post">

                                        <div class="form-group">
                                            <input class="form-control" type="email" placeholder="Email" name="email" id="email">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="password" placeholder="Password" name="password" id="password">
                                        </div>
                                        <button type="submit" class="btn btn-info btn-block">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <?= $this->session->flashdata('message'); ?>
    <div class="container">
        <div class="row mt-3 text-center">
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-laptop-house fa-5x"></i>
                        <h5 class="card-title">Registered Device <span class="badge badge-info"><?= $totaldevice  ?></span></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-users fa-5x"></i>
                        <h5 class="card-title">Registered Student <span class="badge badge-info"><?= $totalstudent  ?></span></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-sticky-note fa-5x"></i>
                        <h5 class="card-title">Registered Session <span class="badge badge-info"><?= $totalsession  ?></span></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-university fa-5x"></i>
                        <h5 class="card-title">Registered Class <span class="badge badge-info"><?= $totalclass  ?></span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">Last Absent Result</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($seerecent as $key) {
                            ?>
                                <li class="list-group-item"><?= $key['studentname'] ?> just check in Session [<?= $key['sessiontitle'] ?>] at [<?= $key['timestamp'] ?>] <?php if ($key['sessionend'] < date('Y/m/d H:i:s')) {
                                                                                                                                                                            ?>
                                        <span class="badge badge-success">On Time</span> <?php                                                                                        } else {
                                                                                            ?><span class="badge badge-danger">Over Time</span>
                                    <?php
                                                                                                                                                                            } ?>
                                </li>
                            <?php
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });

        var span = document.getElementById('span');

        function time() {
            var d = new Date();
            var s = d.getSeconds();
            var m = d.getMinutes();
            var h = d.getHours();
            var x = d.getDate();
            span.textContent =
                ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
        }

        setInterval(time, 1000);
    </script>
    <script src="<?= base_url('assets/') ?>js/scripts.js"></script>
</body>

</html>
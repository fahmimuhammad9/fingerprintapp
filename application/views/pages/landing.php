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
                                            <select name="role" id="role" class="form-control">
                                                <option value="" selected hidden>Select Role</option>
                                                <?php foreach ($role as $key) {
                                                ?>
                                                    <option value="<?= $key['role_id'] ?>"><?= $key['role'] ?></option>
                                                <?php
                                                } ?>
                                            </select>
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
    <?= var_dump($role) ?>

    <div class="container">
        <div class="row"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
    <script src="<?= base_url('assets/') ?>js/scripts.js"></script>
</body>

</html>
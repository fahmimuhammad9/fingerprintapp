<div class="container">
    <div class="page-wrapper">
        <div class="row mb-3 mt-3">
            <div class="col">
                <a class="btn btn-info btn-block" href="<?= base_url('registersession'); ?>">
                    <i class="fas fa-calendar-plus"></i>
                    Register Session
                </a>
            </div>
            <div class="col">
                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#availability">
                    <i class="fas fa-laptop"></i>
                    Fingerprint Device Availability
                </button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModalCenter">
                    <i class="fas fa-laptop-medical"></i>
                    Register New Fingerprint Device
                </button>
            </div>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="row mb-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Running Device
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table table-bordered" id="table2">
                            <thead>
                                <tr>
                                    <th>Device Name</th>
                                    <th>Running Session</th>
                                    <th>Author</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($showdevice as $key) {
                                ?>
                                    <tr>
                                        <td><?= $key['devicename'] ?></td>
                                        <td><?php if ($key['sessiontitle'] == null) {
                                                echo 'No Session Runnning';
                                            } else {
                                                echo $key['sessiontitle'];
                                            } ?></td>
                                        <td><?php if ($key['sessionauthor'] == null) {
                                                echo 'N/A';
                                            } else {
                                                echo $key['username'];
                                            } ?>
                                        </td>
                                        <td>
                                            <?= $key['sessionstart'] ?>
                                        </td>
                                        <td>
                                            <?= $key['sessionend']; ?>
                                            <div id="data">
                                                <input type="hidden" id="date" value="<?= $key['sessionend'] ?>">
                                                <input type="hidden" id="sessid" value="<?= $key['sessionid']; ?>">
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
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
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        My Session
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table table-bordered" id="table_id">
                            <thead>
                                <tr>
                                    <th>Session Title</th>
                                    <th>Session Remark</th>
                                    <Th>Option</Th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mysess as $key) {
                                ?>
                                    <tr>
                                        <td>
                                            <?= $key['sessiontitle'] ?></td>
                                        <td><?= $key['classname'] ?></td>
                                        <td>
                                            <div class="btn-group dropright">
                                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    See Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#addactive">
                                                        Request Activate Session
                                                    </button>
                                                    <a href="" class="dropdown-item">See Recent Activity</a>
                                                    <a class="dropdown-item" href="<?= base_url('lecture/deletesession/' . $key['sessionid']) ?>">Delete This Session</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addactive" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Request to Activate Session</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('lecture/sessactiva/') . $key['sessionid'] ?>" method="post">
                    Dalam langkah ini anda akan mengikuti antrian untuk mengaktifkan sesi absensi yang anda pilih. <br>
                    Silahkan memilih perangkat fingerprint yang tersedia untuk membuat request aktivasi sesi.
                    <div class="form-group">
                        <select class="form-control" id="device" name="device">
                            <option value="" selected hidden>Select Device</option>
                            <?php foreach ($device as $key) {
                            ?>
                                <option value="<?= $key['id_device'] ?>"><?= $key['devicename'] ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    Silahkan memilih durasi absensi
                    <div class="form-group">
                        <select name="durasi" id="durasi" class="form-control">
                            <option value="5">5 Menit</option>
                            <option value="10">10 Menit</option>
                            <option value="15">15 Menit</option>
                            <option value="20">20 Menit</option>
                            <option value="30">30 Menit</option>
                            <option value="60">1 Jam</option>
                        </select>
                    </div>
                    <button class="btn btn-info btn-block" type="submit"><i class="fas fa-save"></i> Ajukan Permintaan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Register New Fingerprint Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tata Cara Menambahkan Perangkat Sidik Jari: <br>
                1. Masukkan Nama Device yang ingin digunakan <br>
                2. Masukkan IP Address device yang akan ditambahkan <br>
                3. Simpan <br>
                <hr>
                <form action="<?= base_url('adddevice'); ?>" method="post" class="form-group">
                    <div class="form-group">
                        <input class="form-control" type="text" name="namaperangkat" id="namaperangkat" placeholder="Masukkan Nama Perangkat">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="ipaddress" id="ipaddress" placeholder="Masukkan Alamt Ip Perangkat">
                    </div>
                    <button class="btn btn-info btn-block">
                        <i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="availability" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Fingerprint Device Availability</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" class="table table-bordered" id="table_id">
                    <thead>
                        <tr>
                            <th>Device Name</th>
                            <th>Ip Address</th>
                            <th>Device Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($device as $key) {
                        ?>
                            <tr>
                                <td>
                                    <?= $key['devicename'] ?>
                                </td>
                                <td><?= $key['deviceip'] ?>
                                </td>
                                <td><?php if ($key['command'] == 'pre') {
                                        echo '<span class="badge badge-info">Standby Mode</span>';
                                    } else if ($key['command' == 'absent']) {
                                        echo '<span class="badge badge-success">Mode On</span>';
                                    } else {
                                        echo '<span class="badge badge-warning">Mode Enroll, Please Wait</span>';
                                    } ?></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function func() {
        var sessid = document.getElementById("sessid").value;
        var dateValue = document.getElementById("date").value;
        var date = Math.abs((new Date().getTime() / 1000).toFixed(0));
        var date2 = Math.abs((new Date(dateValue).getTime() / 1000).toFixed(0));
        var diff = date2 - date;
        var minutes = Math.floor(diff / 60) % 60;
        var seconds = diff % 60;
        var minutesStr = minutes;
        if (minutes < 10) {
            minutesStr = "0" + minutes;
        }
        var secondsStr = seconds;
        if (seconds < 10) {
            secondsStr = "0" + seconds;
        }
        if (minutes < 0 && seconds < 0) {
            minutesStr = "00";
            secondsStr = "00";
            console.log("close");
            window.location.href = "<?php echo site_url('lecture/sessionexpired//'); ?>" + sessid;
            if (typeof interval !== "undefined") {
                clearInterval(interval);
            }
        }
        // document.getElementById("data").innerHTML = minutesStr + " min " + secondsStr + " sec";
    }

    func();
    var interval = setInterval(func, 1000);
</script>
<div class="container">
    <div class="page-wrapper">
        <?= $this->session->flashdata('message'); ?>
        <div class="row mt-3 mb-3">
            <div class="col">
                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#newclass">
                    <i class="fas fa-user-plus"></i>
                    Tambah Mahasiswa Baru
                </button>

                <!-- Modal -->
                <div class="modal fade" id="newclass" tabindex="-1" role="dialog" aria-labelledby="newclass" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Mahasiswa Baru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('addstudent'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="">Nomor Induk Mahasiswa</label>
                                        <input class="form-control" type="text" name="nim" id="Nim">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Lengkap</label>
                                        <input class="form-control" type="text" name="name" id="name">
                                    </div>
                                    <button type="submit" class="btn btn-info btn-block mt-2">Add Student</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table width="100%" class="table table-bordered" id="table_id">
                            <thead>
                                <tr>
                                    <th>Nomor Induk Mahasiswa</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($student as $key) {
                                ?>
                                    <tr>
                                        <td><?= $key['nim'] ?></td>
                                        <td><?= $key['studentname'] ?></td>
                                        <td>
                                            <a href="<?= base_url('lecture/studentdelete/') . $key['studentid']; ?>" class="btn btn-warning"><i class="fas fa-user-minus"></i> Hapus Murid</a>
                                            <a href="<?= base_url('arduino/assignfinger/' . $key['studentid']) ?>" class="btn btn-info"><i class="fas fa-fingerprint"></i> Assign Fingerprint</a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proceed to arduino</h5>
                <button type="button" class="cl\ose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading New Fingerprint... Check fingerprint device
            </div>
        </div>
    </div>
</div>
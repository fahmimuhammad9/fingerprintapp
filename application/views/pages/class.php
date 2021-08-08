<div class="container">
    <div id="page-wrapper">
        <div class="row mb-3">
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="row mb-3">
            <div class="col">
                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#newclass">
                    <i class="fas fa-calendar-plus"></i> Add New Class
                </button>


                <!-- Modal -->
                <div class="modal fade" id="newclass" tabindex="-1" role="dialog" aria-labelledby="newclass" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">New Class</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('addclass'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="">Class Name</label>
                                        <input class="form-control" type="text" placeholder="" name="name" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Set Class Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="" selected hidden>Select Status</option>
                                            <?php foreach ($status as $key) {
                                            ?>
                                                <option value="<?= $key['statusid'] ?>"><?= $key['caption'] ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-block mt-2">Add Class</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-calendar-day"></i>
                        Running Class
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table table-bordered" id="table_id">
                            <thead>
                                <tr>
                                    <th>Class Name</th>
                                    <th>Class Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($activeclass as $key) {
                                ?>
                                    <tr>
                                        <td><?= $key['classname'] ?></td>
                                        <td><?php if ($key['classstatus'] == 1) {
                                                echo '<span class="badge bg-success text-white"><i class="fas fa-check"></i> ' . $key['caption'] . '</span>';
                                            } else {
                                                echo '<span class="badge bg-warning text-white"><i class="fas fa-archive"></i> ' . $key['caption'] . '</span>';
                                            } ?>

                                        </td>
                                        <td>
                                            <?php if ($key['classstatus'] == 1) {
                                                echo '<a href="' . base_url('lecture/reserveclass/') . $key['classid'] . '" class="btn btn-warning"><i class="fas fa-archive"></i> Reserve</a>';
                                            } else {
                                                echo '<a href="' . base_url('lecture/activateclass/') . $key['classid'] . '" class="btn btn-success"><i class="fas fa-check"></i> Activate</a>';
                                            } ?>
                                            <a href="<?= base_url('lecture/deactivateclass/') . $key['classid']; ?>" class="btn btn-danger"><i class="fas fa-times"></i> Deactivate</a>
                                            <a href="<?= base_url('lecture/assignmclass/') . $key['classid'] ?>" class="btn btn-info  <?php if ($key['classstatus'] != 1) {
                                                                                                                                            echo ' disabled';
                                                                                                                                        } ?>"><i class="fas fa-user-plus"></i> Assign</a>
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
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-times"></i>
                        Deactivated Class
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table table-bordered" id="table2">
                            <thead>
                                <tr>
                                    <th>Class Name</th>
                                    <th>Class Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservedclass as $key) {
                                ?>
                                    <tr>
                                        <td><?= $key['classname'] ?></td>
                                        <td><?= $key['caption'] ?></td>
                                        <td><a class="btn btn-success" href="<?= base_url('lecture/activateclass/') . $key['classid']; ?>"><i class="fas fa-check"></i> Activate</a>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="fas fa-trash"></i> Delete</button>
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
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                You will delete <br>
                <b><?= $key['classname'] ?></b>
                <br>
                Are you sure want to delete this class?<br>
                This action also will delete all assigned student in this class.
                <br>
                <small class="text-danger">This action cannot be change later!</small>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('lecture/deleteclass/') . $key['classid']; ?>" class="btn btn-danger btn-block">Delete Anyways</a>
            </div>
        </div>
    </div>
</div>
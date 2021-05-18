<div class="container">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="page-header">Class Menu</h2>
            </div>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="row mb-3">
            <div class="col">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newclass">
                    Add New Class
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
                                        <label for="">Class Caption</label>
                                        <textarea class="form-control" type="text" placeholder="" name="caption" id="caption" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Set Class Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="" selected hidden>Select Status</option>
                                            <?php foreach ($classstat as $key) {
                                            ?>
                                                <option value="<?= $key['id_classstat'] ?>"><?= $key['stat'] ?></option>
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
                        Active Class
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table table-bordered" id="table_id">
                            <thead>
                                <tr>
                                    <th>Class Name</th>
                                    <th>Caption</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($class as $key) {
                                ?>
                                    <tr>
                                        <td><?= $key['classname'] ?></td>
                                        <td><?= $key['classcaption'] ?></td>
                                        <td><?= $key['created_at'] ?></td>
                                        <td><a href="<?= base_url('lecture/classinfo/') . $key['classid']; ?>">Info</a>
                                            <a href="">Setting</a>
                                            <a href="<?= base_url('lecture/deactivateclass/') . $key['classid']; ?>">Deactivate</a>
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
                        Reserve Class
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table table-bordered" id="table2">
                            <thead>
                                <tr>
                                    <th>Class Name</th>
                                    <th>Caption</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reserve as $key) {
                                ?>
                                    <tr>
                                        <td><?= $key['classname'] ?></td>
                                        <td><?= $key['classcaption'] ?></td>
                                        <td><?= $key['created_at'] ?></td>
                                        <td>
                                            <a href="<?= base_url('lecture/activateclass/') . $key['classid']; ?>">Activate</a>
                                            <a href="<?= base_url('lecture/deleteclass/') . $key['classid']; ?>">Delete</a>
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
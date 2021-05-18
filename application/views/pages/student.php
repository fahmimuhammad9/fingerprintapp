<div class="container">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="page-header">
                    Student Menu</h2>
            </div>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="row mb-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Student List
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table table-bordered" id="table_id">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Student Email</th>
                                    <th>Student Status</th>
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
                                        <td><a href="<?= base_url('lecture/assignclass/') . $key['id']; ?>">Assign</a>
                                            <a href="">Setting</a>
                                            <a href="<?= base_url('lecture/deactivateclass/') . $key['id']; ?>">Deactivate</a>
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
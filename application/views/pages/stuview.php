<div class="container">
    <div class="page-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Student List
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
    </div>
</div>
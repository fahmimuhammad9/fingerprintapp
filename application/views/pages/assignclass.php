<div class="container">
    <div class="page-wrapper">

        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <?= $classinfo['classname'] ?> <small class="text-success">(Assigned to Class)</small>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <table width="100%" class="table table-bordered" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($assignedstudent as $key) {
                                        ?>
                                            <tr>
                                                <td><?= $key['studentname']; ?></td>
                                                <td>
                                                    <a class="btn btn-danger" href="<?= base_url('lecture/kickfromclass/' . $key['studentid']) . '/' . $classinfo['classid']; ?>"><i class="fas fa-sign-out-alt"></i> Kick</a>
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
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Student Data <small class="text-danger">(Not Assigned to Class)</small>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <table width="100%" class="table table-bordered" id="table2">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($nastudent as $key) {
                                        ?>
                                            <tr>
                                                <td><?= $key['studentname']; ?></td>
                                                <td>
                                                    <a class="btn btn-success" href="<?= base_url('lecture/assigntoclass/') . $key['studentid'] . '/' .  $classinfo['classid']; ?>"><i class="fas fa-sign-in-alt"></i> Assign to this class</a>
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
    </div>
</div>
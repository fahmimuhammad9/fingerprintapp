<div class="container">
    <div class="page-wrapper">
        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Student List
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table table-bordered" id="table_id">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Class Assigned</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($student as $key) {
                                ?>
                                    <tr>
                                        <td><?= $key['name'] ?></td>
                                        <td><?= $key['email'] ?></td>
                                        <td><?php if ($key['classname'] == null) {
                                                echo 'N/A';
                                            } else {
                                                echo $key['classname'];
                                            }  ?></td>
                                        <td>Deactivate</a>
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
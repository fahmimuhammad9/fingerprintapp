<div class="container">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-header">
                    Student Manager</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newclass">
                    Add New Student
                </button>

                <!-- Modal -->
                <div class="modal fade" id="newclass" tabindex="-1" role="dialog" aria-labelledby="newclass" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">New Student</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('addstudent'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="">Student Name</label>
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
                                    <th>Full Name</th>
                                    <th>Total Assigned Class</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($student as $key) {
                                ?>
                                    <tr>
                                        <td><?= $key['studentname'] ?></td>
                                        <td></td>
                                        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#assignclass">
                                                Assign Class
                                            </button>

                                            <a href="" class="btn btn-warning">Make Inactive</a>
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
<div class="modal fade" id="assignclass" tabindex="-1" role="dialog" aria-labelledby="newclass" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Assign Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('lecture/assignstudent/' . $key['studentid']); ?>" method="post">
                    <div class="form-group">
                        <label for="">Assign Class</label>
                        <select class="form-control" name="class" id="class">
                            <option value="" selected hidden>Select Status</option>
                            <?php foreach ($class as $key) {
                            ?>
                                <option value="<?= $key['classid'] ?>"><?= $key['classname'] ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-info btn-block mt-2">Add Student</button>
                </form>
            </div>
        </div>
    </div>
</div>
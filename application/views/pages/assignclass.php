<div class="container">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="page-header">
                    Assign Class
                </h2>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Class Information
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('lecture/update') ?>" method="post">
                            <div class="form-group">
                                <label for="">Class Name</label>
                                <input class="form-control" type="text" value="<?= $classinfo['classname'] ?>" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="">Class Caption</label>
                                <input class="form-control" type="text" placeholder="" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="">Class Name</label>
                                <input class="form-control" type="text" placeholder="" name="name" id="name">
                            </div>
                        </form>
                        <a href="#" class="btn btn-primary"></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Assigned Student (Total : )
                    </div>
                    <div class="card-body">
                        <ol class="list-group list-group">
                            <?php foreach ($assignedstudent as $key) {
                            ?>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="mr-2 me-auto">
                                        <?= $key['studentname'] ?>
                                    </div>
                                </li>
                            <?php
                            } ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
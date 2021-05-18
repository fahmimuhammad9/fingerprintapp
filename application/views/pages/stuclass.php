<div class="container">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-header">Classes</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Current Class
                    </div>
                    <div class="card-body">
                        <?php if ($current == null) {
                            echo '<p class="card-text">No Class Assigned</p>';
                            echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Assign A Class
                          </button>';
                        ?>
                        <?php } else { ?>
                            <h5 class="card-title"><?= $current['classname'] ?></h5>
                            <span class="text-muted">Author : <?= $current['name'] ?></span>
                            <p class="card-text"><?= $current['classcaption'] ?></p>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal2">
                                Disembark Class
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">are you sure want to diembark class?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            this action will close current class and restart class registration for user <?= $this->session->userdata['name'] ?>
                                            <br><br>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a href="<?= base_url('disembark') ?>" class="btn btn-danger">Disembark</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Select Active Class</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table width="100%" class="table table-bordered" id="table_id">
                                            <thead>
                                                <tr>
                                                    <th>Class Name</th>
                                                    <th>Caption</th>
                                                    <th>Class Author</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($class as $key) {
                                                ?>
                                                    <tr>
                                                        <td><?= $key['classname'] ?></td>
                                                        <td><?= $key['classcaption'] ?></td>
                                                        <td><?= $key['author'] ?></td>
                                                        <td><a href="<?= base_url('student/join/') . $key['classid']; ?>">Join</a>
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
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-header">Other Classes</h1>
            </div>
        </div>
        <div class="row">
            <?php foreach ($allclass as $key) {
            ?>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $key['classname'] ?> </h5>
                            <p class="card-text"><?= $key['classcaption'] ?></p>
                            <span class="text-muted">Author : <?= $key['name']; ?></span><br>
                            <span class="text-muted">Status : <?php if ($key['status'] == 1) {
                                                                    echo 'Active';
                                                                } else {
                                                                    echo 'Inactive';
                                                                } ?></span>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</div>
<div class="container">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Profile Information
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>Email</td>
                                </tr>
                                <tr>
                                    <td><?= $this->session->userdata['name'] ?></td>
                                    <td><?= $this->session->userdata['email'] ?></td>
                                </tr>
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
                        My Class
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table table-bordered" id="table_id">
                            <thead>
                                <tr>
                                    <th>Class Name</th>
                                    <th>Class Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($class as $key) {
                                ?>
                                    <tr>
                                        <td><?= $key['classname'] ?></td>
                                        <td><?= $key['caption'] ?></td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        My Session
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table table-bordered" id="table2">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Start At</th>
                                    <th>End At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($session as $key) {
                                ?>
                                    <tr>
                                        <td><?= $key['sessiontitle'] ?></td>
                                        <td><?= $key['sessionstart'] ?></td>
                                        <td><?= $key['sessionend'] ?></td>
                                        <td><?= $key['sessionstat'] ?></td>
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
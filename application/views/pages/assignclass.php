<div class="container">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="page-header">
                    Assign <?= $info['classname']; ?> Class
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
                        <h5 class="card-title"><?= $info['classname']; ?></h5>
                        <form action="<?= base_url('lecture/update') ?>" method="post">
                            <div class="form-group">
                                <label for="">Class Name</label>
                                <input class="form-control" type="text" placeholder="" name="name" id="name">
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
        </div>
    </div>
</div>
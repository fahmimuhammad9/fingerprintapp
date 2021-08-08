<div class="container">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-header">
                    Create New Session</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Session Information
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('addsession'); ?>" method="post">
                            <div class="form-group">
                                <label for="">Session Name</label>
                                <input class="form-control" type="text" name="id" id="id">
                            </div>
                            <div class="form-group">
                                <label for="">Session Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="" selected hidden>Select Status</option>
                                    <?php foreach ($status as $key) {
                                    ?>
                                        <option value="<?= $key['statusid'] ?>"><?= $key['caption'] ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Assign Session Class <small class="text-secondary">(Optional)</small> </label>
                                <select class="form-control" name="text" id="class" name="class">
                                    <option value="N/A" selected hidden>Select Class</option>
                                    <?php foreach ($class as $key) {
                                    ?>
                                        <option value="<?= $key['classid'] ?>"><?= $key['classname'] ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info btn-block mt-2">Create Session</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
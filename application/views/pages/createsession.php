<div class="container">
    <div class="page-wrapper">

        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-search"></i> Session Information
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('addsession'); ?>" method="post">
                            <div class="form-group">
                                <label for="">Session Title</label>
                                <input class="form-control" type="text" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="">Assign Session Class</label>
                                <select class="form-control" id="class" name="class">
                                    <option value="" selected hidden>Select Class</option>
                                    <?php foreach ($class as $key) {
                                    ?>
                                        <option value="<?= $key['classid'] ?>"><?= $key['classname'] ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Session Remark <small>(Optional)</small></label>
                                <textarea class="form-control" type="text" name="remark" id="remark"></textarea>
                            </div>
                            <button type="submit" class="btn btn-info btn-block mt-2">Create Session</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
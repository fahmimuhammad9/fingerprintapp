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
                <form action="<?= base_url('registersession'); ?>" method="post">
                    <div class="form-group">
                        <label for="">Class Name</label>
                        <input class="form-control" type="text" placeholder="" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="">Set Class Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="" selected hidden>Select Status</option>
                            <?php foreach ($status as $key) {
                            ?>
                                <option value="<?= $key['statusid'] ?>"><?= $key['caption'] ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info btn-block mt-2">Add Class</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h5 class="page-header">
                    Registered Session</h5>
                <div class="card">
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
</div>
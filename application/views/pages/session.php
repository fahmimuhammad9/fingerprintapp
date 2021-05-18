<div class="container">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-header">
                    Session Manager</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal">
                    Create New Session
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create New Session</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" action="<?= base_url('createsession'); ?>" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Insert Session Title">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Insert Session Title">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <button class="btn btn-info btn-block">Create New Session</button>
            </div>
        </div>
    </div>
</div>
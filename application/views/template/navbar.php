<div class="pos-f-t">
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
            <h4 class="text-white">Welcome ! <?= $this->session->userdata['name']; ?></h4>
            <span class="text-muted">Want to logout? Click <a href="<?= base_url('logout'); ?>">Here</a></span>
        </div>
    </div>
    <nav class="navbar navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('lecture'); ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('lectureassign'); ?>">Class</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('session'); ?>">Session</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('stuview'); ?>">Student</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('setting'); ?>">Settings</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
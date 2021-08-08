<style>
    marquee {
        width: 100%;
        padding: 3px 0;
    }
</style>
<nav class="navbar navbar-dark bg-light" style="opacity: 50%">
    <marquee direction="scroll" onmouseover="this.stop()" onmouseout="this.start()">
        <div class="row">
            <div class="col">
                <div class="bg-light center">
                    Welcome to Fingerprint Arduino Dashboard. Hello <?= $this->session->userdata['name']; ?>! | You Are Now At <?= $title; ?> | Provided System Information [ Local Time : <span id="span"></span> | Total Student (<?= $totalstudent ?>) | Total Class (<?= $totalclass; ?>) | Total Session (<?= $totalsession; ?>) | Total Device (<?= $totaldevice ?>) ]
                </div>
            </div>
        </div>
    </marquee>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand text-white" href="<?= base_url('lecture'); ?>">Fingerprint Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-
        icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('lecture'); ?>">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('class'); ?>">Class</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('session'); ?>">Session</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('student'); ?>">Student</a>
            </li>
        </ul>
        <a href="<?= base_url('logout'); ?>" class="text-white"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</nav>

<script>
    var span = document.getElementById('span');

    function time() {
        var d = new Date();
        var s = d.getSeconds();
        var m = d.getMinutes();
        var h = d.getHours();
        span.textContent =
            ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
    }

    setInterval(time, 1000);
</script>
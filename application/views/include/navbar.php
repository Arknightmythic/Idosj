<div class="nav-container">
    <nav class="d-flex flex-column flex-md-row justify-content-between align-items-center py-3 container">
        <a class="d-flex align-items-center" href="<?= base_url() ?>">
            <img src="<?= base_url("/assets/images/logo-ihs.png") ?>" alt="IHS Logo">
            <h1 class="my-0 ms-2 ms-md-3 nav-title">SERIKAT JESUS</h1>
        </a>
        <div class="d-flex align-items-center">
            <h3 class="my-3 my-md-0">Hi <?= $this->session->namaLengkap ?>!</h3>
            <a href="<?= base_url("auth/logout"); ?>"><button class="btn btn-secondary btn-sm ms-3">logout</button></a>
        </div>
    </nav>
</div>
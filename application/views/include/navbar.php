<div class="nav-container">
    <nav class="d-flex flex-column flex-md-row justify-content-between align-items-center py-3 container">
        <a class="d-flex align-items-center" href="<?= base_url() ?>">
            <img src="<?= base_url("/assets/images/logo-ihs-new.png") ?>" alt="IHS Logo">
        </a>
        <div class="d-flex align-items-center">
            <h3 class="my-3 my-md-0">Hi <?= $this->session->namaLengkap ?>!</h3>
            <a class="logout-btn" href="<?= base_url("auth/logout"); ?>">
                <button class="btn ms-3" style="background-color: var(--ihs-red);">
                    <i class="fa fa-sign-out"></i>
                </button>
            </a>
        </div>
    </nav>
</div>
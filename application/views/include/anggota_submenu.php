<!-- Section Submenu -->
<div class="header-profile my-5">
    <div class="d-flex flex-column flex-md-row profile align-items-center">
        <div class="profile-div col-12 col-md-6 position-relative d-flex justify-content-center">
            <img class="position-absolute overlay" src="<?= base_url("/assets/images/ihs-bw-overlay.png") ?>"
                alt="IHS Background Overlay">
            <div class="profile-container">
                <img src="<?= !empty($dataPribadi->fotoProfile) ? base_url("/uploads/profile/" . $dataPribadi->fotoProfile) : base_url("/assets/images/profile-placeholder.jpg") ?>"
                    alt="Foto Profil <?= $dataPribadi->namaDepan ." " . $dataPribadi->namaBelakang ?>">
            </div>
        </div>
        <div class="col-12 col-md-6 text-center">
            <h3><?= $dataPribadi->namaDepan ." " . $dataPribadi->namaBelakang ?></h3>
            <?php if(!empty($dataPribadi->namaKomunitas)): ?>
            <p class="m-0">
                <?= "Anggota Komunitas ".$dataPribadi->namaKomunitas ?>
            </p>
            <?php endif; ?>
            <?php if(!empty($dataPribadi->alamat)): ?>
            <p class="m-0">
                <?= $dataPribadi->alamat ?>
            </p>
            <?php endif; ?>
            <?php if(!empty($dataPribadi->email)): ?>
            <p class="m-0">
                <a class="fw-bold" href="mailto: <?= $dataPribadi->email ?>"><?= $dataPribadi->email ?></a>
            </p>
            <?php endif; ?>
            <p class="m-0">
                <?= !empty($dataPribadi->nomorTelepon) ? "<a class='fw-bold' href='https://wa.me/62".substr($dataPribadi->nomorTelepon,1)."' target='_blank'>$dataPribadi->nomorTelepon ( Telp )/( Whatsapp )</a>" : "" ?>
            </p>
        </div>
    </div>
    <div class="subnav d-flex justify-content-between d-none d-md-flex">
        <a class="links <?= $activeNav == "pribadi" ? "active" : "" ?>"
            href="<?= base_url("anggota/pribadi/" . $dataPribadi->id) ?>">Personal</a>
        <a class="links <?= $activeNav == "keluarga" ? "active" : "" ?>"
            href="<?= base_url("anggota/keluarga/" . $dataPribadi->id) ?>">Family</a>
        <a class="links <?= $activeNav == "formasi" ? "active" : "" ?>"
            href="<?= base_url("anggota/formasi/" . $dataPribadi->id) ?>">Formation</a>
        <a class="links <?= $activeNav == "perutusan" ? "active" : "" ?>"
            href="<?= base_url("anggota/perutusan/" . $dataPribadi->id) ?>">Apostolate</a>
        <a class="links <?= $activeNav == "perjalanan" ? "active" : "" ?>"
            href="<?= base_url("anggota/perjalanan/" . $dataPribadi->id) ?>">Overseas Trip</a>
        <a class="links <?= $activeNav == "catatan" ? "active" : "" ?>"
            href="<?= base_url("anggota/catatan/" . $dataPribadi->id) ?>">Record</a>
        <a class="links <?= $activeNav == "dokumen" ? "active" : "" ?>"
            href="<?= base_url("anggota/katalog/" . $dataPribadi->id) ?>">Catalog</a>
    </div>
   
    <div class="d-flex justify-content-center align-items-center mt-4">
        <div class="dropdown d-lg-none d-sm-block">
            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item <?= $activeNav == "pribadi" ? "active" : "" ?>" href="<?= base_url("anggota/pribadi/" . $dataPribadi->id) ?>">Personal</a></li>
                <li><a class="dropdown-item  <?= $activeNav == "keluarga" ? "active" : "" ?>" href="<?= base_url("anggota/keluarga/" . $dataPribadi->id) ?>">Family</a></li>
                <li><a class="dropdown-item  <?= $activeNav == "formasi" ? "active" : "" ?>" href="<?= base_url("anggota/formasi/" . $dataPribadi->id) ?>">Formation</a></li>
                <li><a class="dropdown-item  <?= $activeNav == "perutusan" ? "active" : "" ?>" href="<?= base_url("anggota/perutusan/" . $dataPribadi->id) ?>">Apostolate</a></li>
                <li><a class="dropdown-item  <?= $activeNav == "perjalanan" ? "active" : "" ?>" href="<?= base_url("anggota/perjalanan/" . $dataPribadi->id) ?>">Overseas Trip</a></li>
                <li><a class="dropdown-item  <?= $activeNav == "dokumen" ? "active" : "" ?>" href="<?= base_url("anggota/katalog/" . $dataPribadi->id) ?>">Document</a></li>
                <li><a class="dropdown-item  <?= $activeNav == "catatan" ? "active" : "" ?>" href="<?= base_url("anggota/catatan/" . $dataPribadi->id) ?>">Record</a></li>
            </ul>
        </div>

    </div>
</div>
<!-- End Section of Submenu -->
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
    <div class="subnav d-flex justify-content-between">
        <a class="links <?= $activeNav == "pribadi" ? "active" : "" ?>"
            href="<?= base_url("anggota/pribadi/" . $dataPribadi->id) ?>">Pribadi</a>
        <a class="links <?= $activeNav == "keluarga" ? "active" : "" ?>"
            href="<?= base_url("anggota/keluarga/" . $dataPribadi->id) ?>">Keluarga</a>
        <a class="links <?= $activeNav == "formasi" ? "active" : "" ?>"
            href="<?= base_url("anggota/formasi/" . $dataPribadi->id) ?>">Formasi</a>
        <a class="links <?= $activeNav == "perutusan" ? "active" : "" ?>"
            href="<?= base_url("anggota/perutusan/" . $dataPribadi->id) ?>">Perutusan</a>
        <a class="links <?= $activeNav == "perjalanan" ? "active" : "" ?>"
            href="<?= base_url("anggota/perjalanan/" . $dataPribadi->id) ?>">Perjalanan</a>
        <a class="links <?= $activeNav == "catatan" ? "active" : "" ?>"
            href="<?= base_url("anggota/catatan/" . $dataPribadi->id) ?>">Catatan</a>
        <a class="links <?= $activeNav == "dokumen" ? "active" : "" ?>"
            href="<?= base_url("anggota/dokumen/" . $dataPribadi->id) ?>">Dokumen</a>
    </div>
</div>
<!-- End Section of Submenu -->
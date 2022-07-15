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
            <p class="m-0">Anggota Komunitas <?= $dataPribadi->komunitas ?></p>
            <p class="m-0"><?= $dataPribadi->alamat ?></p>
            <p class="m-0"><a href="mailto: <?= $dataPribadi->email ?>"><?= $dataPribadi->email ?></a></p>
            <p class="m-0">
                <?= !empty($dataPribadi->nomorTelepon) ? $dataPribadi->nomorTelepon . " ( Telp ) / ( Whatsapp )" : "" ?>
            </p>
        </div>
    </div>
    <div class="subnav d-flex justify-content-between">
        <a class="links" href="<?= base_url("anggota/pribadi?id=" . $this->input->get('id')) ?>">Pribadi</a>
        <a class="links" href="<?= base_url("anggota/keluarga?id=" . $this->input->get('id')) ?>">Keluarga</a>
        <a class="links" href="<?= base_url("anggota/formasi?id=" . $this->input->get('id')) ?>">Formasi</a>
        <a class="links" href="<?= base_url("anggota/perutusan?id=" . $this->input->get('id')) ?>">Perutusan</a>
        <a class="links" href="<?= base_url("anggota/perjalanan?id=" . $this->input->get('id')) ?>">Perjalanan</a>
        <a class="links" href="<?= base_url("anggota/catatan?id=" . $this->input->get('id')) ?>">Catatan</a>
        <a class="links" href="<?= base_url("anggota/dokumen?id=" . $this->input->get('id')) ?>">Dokumen</a>
    </div>
</div>
<!-- End Section of Submenu -->
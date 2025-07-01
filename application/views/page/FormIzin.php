<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/form-kuning.css"); ?>">
    <?= $css ?>
    <?= $js ?>
</head>
<!-- albert update -->

<body>
    <?= $navbar ?>
    <div class="container formkuning px-4 px-md-0">
        <section>
            <h3 class="text-center mb-5 fw-bold">Formulir Permohonan Izin Bepergian KAS</h3>
            <?php if ($this->session->role == "Superior"): ?>
                <form id="formIzinSuperior">
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label>Kapan Anda berpergian meninggalkan Karya?</label>
                            <input name="q1" type="date" class="form-control" required />
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Kapan Anda akan kembali ke Karya?</label>
                            <input name="q2" type="date" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ke mana Anda berpergian kali ini?</label>
                        <input name="q3" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Untuk keperluan apa Anda berpergian?</label>
                        <input name="q4" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Lewat mana saja rute perjalanan Anda?</label>
                        <textarea name="q5" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Berapa kurang lebih biaya perjalanan serta biaya hidup selama berpergian dan bagamainana rinciannya?</label>
                        <textarea name="q6" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Siapa yang akan menanggung biaya Anda kali ini?</label>
                        <input name="q7" type="text" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Bagaimana urusan pekerjaan selama Anda berpergian?</label>
                        <textarea name="q9" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Sebelum ini, kapan Anda terakhir berpergian? Dari (tanggal/bulan/tahun) hingga (tanggal/bulan/tahun)? Ke mana? Untuk keperluan apa? Siapa sponsornya</label>
                        <textarea name="q10" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="form-group d-flex box-pengajuan p-2 p-md-3">
                        <div class="me-2">
                            <input name="formKuning" class="form-check-input" type="checkbox" id="pernyataanAnggota"
                                required>
                        </div>
                        <div>
                            <label class="form-check-label" for="pernyataanAnggota">
                                Saya <b><?= $userData->namaDepan . " " . $userData->namaBelakang ?></b>, secara sadar telah
                                mengisi
                                form
                                ini dan hendak mengajukan izin kepada Pater Provinsial.
                            </label>
                        </div>
                    </div>
                    <div class="form-group mt-4 d-flex justify-content-end">
                        <button id="submitButton" class="btn btn-primary px-3 py-2">Kirim Permohonan</button>
                    </div>
                </form>
            <?php else: ?>
                <form id="formIzin">
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label>Kapan Anda berangkat meninggalkan karya?</label>
                            <input name="q1" type="date" class="form-control" required />
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Kapan Anda akan kembali ke Karya?</label>
                            <input name="q2" type="date" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ke mana Anda berpergian kali ini?</label>
                        <input name="q3" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Untuk keperluan apa Anda berpergian?</label>
                        <input name="q4" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Lewat mana saja rute perjalanan Anda?</label>
                        <textarea name="q5" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Berapa kurang lebih biaya perjalanan serta biaya hidup selama berpergian dan bagamainana rinciannya?</label>
                        <textarea name="q6" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Siapa yang akan menanggung biaya Anda kali ini?</label>
                        <input name="q7" type="text" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Bagaimana urusan pekerjaan selama Anda berpergian?</label>
                        <textarea name="q9" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Sebelum ini, kapan Anda terakhir berpergian? Dari (tanggal/bulan/tahun) hingga (tanggal/bulan/tahun)? Ke mana? Untuk keperluan apa? Siapa sponsornya?</label>
                        <textarea name="q10" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="form-group d-flex box-pengajuan p-2 p-md-3">
                        <div class="me-2">
                            <input name="formIzin" class="form-check-input" type="checkbox" id="pernyataanAnggota"
                                required>
                        </div>
                        <div>
                            <label class="form-check-label" for="pernyataanAnggota">
                                Saya <b><?= $userData->namaDepan . " " . $userData->namaBelakang ?></b>, secara sadar telah
                                mengisi
                                form
                                ini dan hendak mengajukan izin kepada Pater Provinsial.
                            </label>
                        </div>
                    </div>
                    <div class="form-group mt-4 d-flex justify-content-end">
                        <button id="submitButton" class="btn btn-primary px-3 py-2">Kirim Permohonan</button>
                    </div>
                </form>
            <?php endif; ?>
        </section>
    </div>

    <?= $footer ?>

    <script>
        $("#formIzin").submit(() => {
            event.preventDefault();
            const submitButton = $("#submitButton");
            submitButton.prop("disabled", true); // Nonaktifkan tombol

            const formData = new FormData($("#formIzin")[0]);
            formData.append("addFormIzin", true);
            formData.append("idSuperior", "<?= $userData->idSuperior ?>");
            formData.append("idAnggota", "<?= $userData->id ?>");
            formData.append("statusSuperior", 1);
            formData.append("q8", "personal");
            formData.append("FormType", "KAS");

            axios.post("<?= base_url("api/formIzinAnggotaDirectToProvincial") ?>", formData)
                .then((res) => {
                    Swal.fire({
                        title: res.data?.title,
                        text: res.data?.message,
                        icon: res.data?.status,
                    }).then(() => window.location.href = "<?= base_url("/anggota/perjalanan?id=") . $userData->id ?>")
                })
                .catch((error) => {
                    Swal.fire({
                        title: "Error",
                        text: "Terjadi kesalahan saat mengirim formulir",
                        icon: "error",
                    });
                    submitButton.prop("disabled", false); // Aktifkan kembali tombol jika error
                });
        });
    </script>

    <script>
        $("#formIzinSuperior").submit(() => {
            event.preventDefault();
            const submitButton = $("#submitButton");
            submitButton.prop("disabled", true); // Nonaktifkan tombol

            const formData = new FormData($("#formIzinSuperior")[0]);
            formData.append("addFormIzinSuperior", true);
            formData.append("idAnggota", "<?= $userData->id ?>");
            formData.append("statusSuperior", 1);
            formData.append("FormType", "KAS");
            formData.append("q8", "Superior");

            axios.post("<?= base_url("api/formIzinSuperiorDirectToProvincial") ?>", formData)
                .then((res) => {
                    Swal.fire({
                        title: res.data?.title,
                        text: res.data?.message,
                        icon: res.data?.status,
                    }).then(() => window.location.href = "<?= base_url("/anggota/perjalanan?id=") . $userData->id ?>")
                })
                .catch((error) => {
                    Swal.fire({
                        title: "Error",
                        text: "Terjadi kesalahan saat mengirim formulir",
                        icon: "error",
                    });
                    submitButton.prop("disabled", false); // Aktifkan kembali tombol jika error
                });
        });
    </script>
    <!-- finish albert update -->
</body>

</html>
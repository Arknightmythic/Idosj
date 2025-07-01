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

<body>
    <?= $navbar ?>
    <div class="container formkuning px-4 px-md-0">
        <section>
            <h3 class="text-center mb-5 fw-bold">Formulir Permohonan Izin Bepergian Ke Luar Negeri</h3>
            <?php if ($this->session->role == "Superior"): ?>
                <form id="formKuningSuperior">
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label>Kapan Anda berangkat ke luar negeri?</label>
                            <input name="q1" type="date" class="form-control" required />
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Kapan Anda akan kembali ke Indonesia?</label>
                            <input name="q2" type="date" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ke mana Anda ke luar negeri kali ini?</label>
                        <input name="q3" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Untuk keperluan apa Anda ke luar negeri kali ini?</label>
                        <input name="q4" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Lewat mana saja rute perjalanan Anda?</label>
                        <textarea name="q5" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Berapa kurang lebih biaya perjalanan serta biaya hidup selama di luar negeri dan bagamainana
                            rinciannya?</label>
                        <textarea name="q6" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Siapa yang akan menanggung biaya Anda kali ini?</label>
                        <input name="q7" type="text" class="form-control" required />
                    </div>
                    <div class="form-group d-none">
                        <label>Apa pendapat Superior Lokal atau Rektor Komunitas atau Uskup setempat mengenai rencana Anda
                            akan ke luar negeri kali ini?</label>
                        <textarea name="q8" class="form-control" rows="5" required>Superior</textarea>
                    </div>
                    <div class="form-group">
                        <label>Bagaimana urusan pekerjaan selama Anda di luar negeri?</label>
                        <textarea name="q9" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Sebelum ini, kapan Anda terakhir ke luar negeri?
                            Dari (tanggal/bulan/tahun) hingga (tanggal/bulan/tahun)? Ke mana? Untuk keperluan apa? Siapa
                            sponsornya?</label>
                        <textarea name="q10" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group  d-flex flex-column">
                        <label>Apakah anda membutuhkan Affidavit atau Surat Keterangan Bank?</label>
                        <select style="height: 50px;" name="q11" id="surket">
                            <option value="Affidavit atau Surat Keterangan">Affidavit atau Surat Keterangan saja</option>
                            <option value="Surat Keterangan Bank">Surat Keterangan Bank saja</option>
                            <option value="Kedua-duanya">kedua-duanya</option>
                            <option value="tidak">tidak membutuhkan</option>
                        </select>
                        <label><i>*untuk bepergian di lingkup asean tidak memerlukan kedua duanya</i></label>
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
                <form id="formKuning">
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label>Kapan Anda berangkat ke luar negeri?</label>
                            <input name="q1" type="date" class="form-control" required />
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Kapan Anda akan kembali ke Indonesia?</label>
                            <input name="q2" type="date" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ke mana Anda ke luar negeri kali ini?</label>
                        <input name="q3" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Untuk keperluan apa Anda ke luar negeri kali ini?</label>
                        <input name="q4" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Lewat mana saja rute perjalanan Anda?</label>
                        <textarea name="q5" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Berapa kurang lebih biaya perjalanan serta biaya hidup selama di luar negeri dan bagamainana
                            rinciannya?</label>
                        <textarea name="q6" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Siapa yang akan menanggung biaya Anda kali ini?</label>
                        <input name="q7" type="text" class="form-control" required />
                    </div>
                    <div class="form-group d-none">
                        <label>Apa pendapat Superior Lokal atau Rektor Komunitas atau Uskup setempat mengenai rencana Anda
                            akan ke luar negeri kali ini?</label>
                        <textarea name="q8" class="form-control" rows="5" required>personal</textarea>
                    </div>
                    <div class="form-group">
                        <label>Bagaimana urusan pekerjaan selama Anda di luar negeri?</label>
                        <textarea name="q9" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Sebelum ini, kapan Anda terakhir ke luar negeri?
                            Dari (tanggal/bulan/tahun) hingga (tanggal/bulan/tahun)? Ke mana? Untuk keperluan apa? Siapa
                            sponsornya?</label>
                        <textarea name="q10" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label>Apakah anda membutuhkan Affidafit atau Surat Keterangan Bank?</label>
                        <select style="height: 50px;" name="q11" id="surket">
                            <option value="Affidavit atau Surat Keterangan">Affidavit atau Surat Keterangan saja</option>
                            <option value="Surat Keterangan Bank">Surat Keterangan Bank saja</option>
                            <option value="Kedua-duanya">Kedua-duanya</option>
                            <option value="tidak">Tidak membutuhkan</option>
                        </select>
                        <label><i>*untuk bepergian di lingkup ASEAN tidak memerlukan kedua-duanya.</i></label>
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
            <?php endif; ?>
        </section>
    </div>

    <?= $footer ?>

    <script>
        $("#formKuning").submit(() => {
            event.preventDefault();
            const submitButton = $("#submitButton");
            submitButton.prop("disabled", true); // Nonaktifkan tombol
            const formData = new FormData($("#formKuning")[0]);
            formData.append("addFormKuning", true);
            formData.append("idSuperior", "<?= $userData->idSuperior ?>");
            formData.append("idAnggota", "<?= $userData->id ?>");
            axios.post("<?= base_url("api/formkuning") ?>", formData).then((res) => {
                    Swal.fire({
                        title: res.data?.title,
                        text: res.data?.message,
                        icon: res.data?.status,
                    }).then(() => window.location.href =
                        "<?= base_url("/anggota/perjalanan?id=") . $userData->id ?>")
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
        $("#formKuningSuperior").submit(() => {
            event.preventDefault();
            const submitButton = $("#submitButton");
            submitButton.prop("disabled", true); // Nonaktifkan tombol
            const formData = new FormData($("#formKuningSuperior")[0]);
            formData.append("addFormKuningSuperior", true);
            formData.append("idAnggota", "<?= $userData->id ?>");
            formData.append("statusSuperior", 1);
            axios.post("<?= base_url("api/formKuningDirectToProvincial") ?>", formData).then((res) => {
                Swal.fire({
                    title: res.data?.title,
                    text: res.data?.message,
                    icon: res.data?.status,
                }).then(() => window.location.href =
                    "<?= base_url("/anggota/perjalanan?id=") . $userData->id ?>")
            }).catch((error) => {
                Swal.fire({
                    title: "Error",
                    text: "Terjadi kesalahan saat mengirim formulir",
                    icon: "error",
                });
                submitButton.prop("disabled", false); // Aktifkan kembali tombol jika error
            });
        });
    </script>
</body>

</html>
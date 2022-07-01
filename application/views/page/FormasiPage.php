<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-submenu.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-page.css"); ?>">
    <?= $css?>
    <?= $js?>
</head>

<body>
    <?= $navbar?>
    <div class="container px-4 px-md-0">
        <?= $submenu?>

        <!-- Section of Content -->
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Serikat Jesus</h3>
                <?php if($editStatus): ?>
                <button id="tambahSerikat" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <table class="table table-stiped">
                <thead>
                    <th>Keterangan</th>
                    <th>Tanggal & Tempat</th>
                    <th>Pembimbing</th>
                    <?php if(!$editStatus): ?>
                    <th>Dokumen</th>
                    <?php else: ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </thead>
                <tbody>
                    <?php foreach($dataSerikat as $serikat): ?>
                    <tr>
                        <td><?= !empty($serikat->keterangan) ? $serikat->keterangan : "-" ?></td>
                        <td><?= !empty($serikat->tanggalTempat) ? $serikat->tanggalTempat : "-" ?></td>
                        <td><?= !empty($serikat->pembimbing) ? $serikat->pembimbing : "-" ?></td>
                        <?php if(!$editStatus): ?>
                        <td>
                            <a class="btn btn-primary"
                                href="<?= base_url('/uploads/dokumen-serikat/') . $serikat->dokumen ?>" type="file"
                                download>Download</a>
                        </td>
                        <?php else: ?>
                        <td>
                            <button class="btn btn-danger btn-sm hapusBahasa"
                                onclick="hapusSerikat(<?= $serikat->id ?>)">
                                <i class="fa fa-trash"></i>
                            </button>
                            <button class="btn btn-primary btn-sm editBahasa"
                                onclick="editSerikat(<?= $serikat->id ?>)">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <?php if($this->session->role == "Administrator" || $this->session->idAnggota == $dataPribadi->idSuperior || $this->session->idAnggota == $dataPribadi->idDelegat): ?>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Informationes</h3>
                <?php if($editStatus): ?>
                <button id="tambahInfo" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <table class="table table-stiped">
                <thead>
                    <th>Institusi</th>
                    <th>Sebelum Teologist</th>
                    <th>Sebelum Tahbisan</th>
                    <th>Sebelum Kaul Akhir</th>
                    <?php if($editStatus): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"
                    <?= $editStatus ? "" : "disabled" ?>></textarea>
                <label for="floatingTextarea">Komentar</label>
            </div>
            <?php if($editStatus): ?>
            <div class="mt-2 d-flex justify-content-end">
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-save"></i>
                    <span>Simpan Komentar</span>
                </button>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Kaul Akhir</h3>
                <?php if($editStatus): ?>
                <button id="tambahKaul" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <table class="table table-stiped">
                <thead>
                    <th>Deskripsi</th>
                    <th>Dokumen</th>
                    <?php if($editStatus): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Keahlian</h3>
                <?php if($editStatus): ?>
                <button id="tambahKeahlian" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <table class="table table-stiped">
                <thead>
                    <th>Studi Khusus & Kursus</th>
                    <th>Institusi</th>
                    <th>Level Keahlian</th>
                    <th>Catatan</th>
                    <?php if($editStatus): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Publikasi</h3>
                <?php if($editStatus): ?>
                <button id="tambahPublikasi" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <table class="table table-stiped">
                <thead>
                    <th>Judul</th>
                    <th>Tahun Terbit</th>
                    <th>Penerbit</th>
                    <th>Jenis</th>
                    <?php if($editStatus): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>

        <!-- End of Content -->
        <section class="d-flex justify-content-end">
            <form method="get" autocomplete="off">
                <?php if($editStatus): ?>
                <input name="id" value="<?= $dataPribadi->id ?>" hidden />
                <button class="btn btn-success px-5 btn-lg">Selesai</button>
                <?php else: ?>
                <input name="id" value="<?= $dataPribadi->id ?>" hidden />
                <input name="edit" value="1" hidden />
                <button class="btn btn-primary px-5 btn-lg">Sunting</button>
                <?php endif; ?>
            </form>
        </section>
    </div>
    <?= $footer ?>

    <?php if($editStatus): ?>
    <script>
    $("#tambahSerikat").click(() => {
        Swal.fire({
            title: 'Tambah Data Serikat Jesus',
            html: `
                    <form id="formSerikat" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Keterangan</label>
                            <select class="form-select" name="keterangan" required>
                                <option value="" hidden>Pilih Keterangan</option>
                                <option value="Masuk Novisiat">Masuk Novisiat</option>
                                <option value="Kaul Pertama">Kaul Pertama</option>
                                <option value="Tahun Orientasi Kerasulan">Tahun Orientasi Kerasulan</option>
                                <option value="Teologi">Teologi</option>
                                <option value="Tahbisan">Tahbisan</option>
                                <option value="Tersiat">Tersiat</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="namaSerikat">Tanggal dan Tempat</label>
                            <textarea name="tanggalTempat" class="form-control" maxlength="255" required></textarea>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Pembimbing</label>
                            <input name="pembimbing" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Dokumen</label>
                            <input name="fileData" type="file" class="form-control" required accept="application/pdf" />
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary px-5">Tambah</button>
                        </div>
                    </form>
                `,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
        })

        $("#formSerikat").submit(() => {
            event.preventDefault();
            const formData = new FormData($("#formSerikat")[0]);
            formData.append("tambahSerikat", 1);
            formData.append("id", "<?= $dataPribadi->id ?>");
            axios.post("<?= base_url("/index.php/api/editanggota") ?>", formData).then(res => {
                const data = res.data;
                if (data.status == "success") {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: "success",
                    }).then(() => {
                        document.location.reload(true)
                    });
                } else {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: data.status,
                    });
                }
            })
        });
    })

    const editSerikat = (id) => {
        let tempData;
        axios.get(`<?= base_url("/index.php/api/dataSerikat") ?>?idSerikat=${id}`).then(
            res => {
                tempData = res.data;
                Swal.fire({
                    title: 'Edit Data Serikat',
                    html: `
                    <form id="formEditSerikat" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Keterangan</label>
                            <select class="form-select" name="keterangan" required>
                                <option value="Masuk Novisiat" ${tempData.keterangan == "Masuk Novisiat" ? "selected" : ""}>Masuk Novisiat</option>
                                <option value="Kaul Pertama" ${tempData.keterangan == "Kaul Pertama" ? "selected" : ""}>Kaul Pertama</option>
                                <option value="Tahun Orientasi Kerasulan" ${tempData.keterangan == "Tahun Orientasi Kerasulan" ? "selected" : ""}>Tahun Orientasi Kerasulan</option>
                                <option value="Teologi" ${tempData.keterangan == "Teologi" ? "selected" : ""}>Teologi</option>
                                <option value="Tahbisan" ${tempData.keterangan == "Tahbisan" ? "selected" : ""}>Tahbisan</option>
                                <option value="Tersiat" ${tempData.keterangan == "Tersiat" ? "selected" : ""}>Tersiat</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="namaSerikat">Tanggal dan Tempat</label>
                            <textarea name="tanggalTempat" class="form-control" maxlength="255" required>${tempData.tanggalTempat}</textarea>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Pembimbing</label>
                            <input name="pembimbing" class="form-control" value="${tempData.pembimbing}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Dokumen</label>
                            <input name="fileData" type="file" class="form-control" accept="application/pdf" />
                            <small class="form-text text-muted">${tempData.dokumen}</small>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary px-5">Simpan</button>
                        </div>
                    </form>
                `,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: false,
                })

                $("#formEditSerikat").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formEditSerikat")[0]);
                    formData.append("editSerikat", 1);
                    formData.append("id", id);
                    formData.append("lastFile", tempData.dokumen);
                    axios.post("<?= base_url("/index.php/api/editanggota") ?>", formData).then(
                        res => {
                            const data = res.data;
                            if (data.status == "success") {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: "success",
                                }).then(() => {
                                    document.location.reload(true)
                                });
                            } else {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: data.status,
                                });
                            }
                        })
                });
            })
    }

    const hapusSerikat = (id) => {
        axios.get(`<?= base_url("/index.php/api/dataSerikat") ?>?idSerikat=${id}`).then(
            res => {
                tempData = res.data;
                Swal.fire({
                    title: 'Hapus Data Serikat',
                    text: "Apakah anda yakin ingin menghapus data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!"
                }).then(result => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append("hapusSerikat", 1);
                        formData.append("id", id);
                        formData.append("lastFile", tempData.dokumen);
                        axios.post("<?= base_url("/index.php/api/editanggota") ?>", formData).then(
                            res => {
                                const data = res.data;
                                if (data.status == "success") {
                                    Swal.fire({
                                        title: data.title,
                                        text: data.message,
                                        icon: "success",
                                    }).then(() => {
                                        document.location.reload(true)
                                    });
                                } else {
                                    Swal.fire({
                                        title: data.title,
                                        text: data.message,
                                        icon: data.status,
                                    });
                                }
                            })
                    }
                })
            })
    }
    </script>
    <?php endif; ?>

</body>

</html>
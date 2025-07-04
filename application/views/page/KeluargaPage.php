<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-submenu.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-page.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/styles/keluarga.css"); ?>">
    <?= $css ?>
    <?= $js ?>
</head>

<body>
    <?= $navbar ?>
    <div class="container px-4 px-md-0">
        <?= $submenu ?>
        <!-- Section of Pribadi -->
        <?php if ($editStatus) : ?>
            <section>
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Tambah Data</h3>
                    <button id="tambahRelasi" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                </div>
            </section>
        <?php endif; ?>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Parents</h3>
            </div>
            <?php if (count($dataOrangTua) > 0) : foreach ($dataOrangTua as $orangTua) : ?>
                    <div class="table-responsive">
                        <table class="table my-3">
                            <?php if ($editStatus) : ?>
                                <tr>
                                    <td>Aksi</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="hapusKeluarga(<?= $orangTua->id ?>)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm" onclick="editKeluarga(<?= $orangTua->id ?>)">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td><?= $orangTua->namaRelasi ?></td>
                                <td><?= $orangTua->namaLengkap ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><?= $orangTua->alamat ?></td>
                            </tr>
                            <tr>
                                <td>Occupation</td>
                                <td><?= $orangTua->pekerjaan ?></td>
                            </tr>
                            <tr>
                                <td>Tel. No</td>
                                <td><?= $orangTua->nomorTelepon ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><?= $orangTua->statusMeninggal ? "Passed Away" : "Alive" ?></td>
                            </tr>
                        </table>
                    </div>
                <?php endforeach;
            else : ?>
                <div class="col-12 text-center" colspan="4">Tidak ada data</div>
            <?php endif; ?>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Siblings</h3>
            </div>
            <div class="row">
                <?php if (count($dataSaudaraKandung) > 0) : foreach ($dataSaudaraKandung as $saudaraKandung) : ?>
                        <div class="table-responsive col-12 col-md-6">
                            <table class="table my-3">
                                <?php if ($editStatus) : ?>
                                    <tr>
                                        <td>Aksi</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" onclick="hapusKeluarga(<?= $saudaraKandung->id ?>)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <button class="btn btn-primary btn-sm" onclick="editKeluarga(<?= $saudaraKandung->id ?>)">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td>Name</td>
                                    <td><?= $saudaraKandung->namaLengkap ?></td>
                                </tr>
                                <tr>
                                    <td>Relationship</td>
                                    <td><?= $saudaraKandung->namaRelasi ?></td>
                                </tr>
                                <tr>
                                    <td>Adress</td>
                                    <td><?= $saudaraKandung->alamat ?></td>
                                </tr>
                                <tr>
                                    <td>Occupation</td>
                                    <td><?= $saudaraKandung->pekerjaan ?></td>
                                </tr>
                                <tr>
                                    <td>Tel. No</td>
                                    <td><?= $saudaraKandung->nomorTelepon ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?= $saudaraKandung->email ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?= $saudaraKandung->statusMeninggal ? "Passed Away" : "Alive" ?></td>
                                </tr>
                            </table>
                        </div>
                    <?php endforeach;
                else : ?>
                    <div class="col-12 text-center" colspan="4">Tidak ada data</div>
                <?php endif; ?>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Emergency Contacts</h3>
            </div>
            <?php if (count($dataKontakDarurat) > 0) : foreach ($dataKontakDarurat as $kontakDarurat) : ?>
                    <div class="table-responsive">
                        <table class="table my-3">
                            <?php if ($editStatus) : ?>
                                <tr>
                                    <td>Aksi</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="hapusKeluarga(<?= $kontakDarurat->id ?>)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm" onclick="editKeluarga(<?= $kontakDarurat->id ?>)">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td>Name</td>
                                <td><?= $kontakDarurat->namaLengkap ?></td>
                            </tr>
                            <tr>
                                <td>Relationship</td>
                                <td><?= $kontakDarurat->namaRelasi ?></td>
                            </tr>
                            <tr>
                                <td>Adress</td>
                                <td><?= $kontakDarurat->alamat ?></td>
                            </tr>
                            <tr>
                                <td>Occupation</td>
                                <td><?= $kontakDarurat->pekerjaan ?></td>
                            </tr>
                            <tr>
                                <td>Tel. No</td>
                                <td><?= $kontakDarurat->nomorTelepon ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?= $kontakDarurat->email ?></td>
                            </tr>
                        </table>
                    </div>
                <?php endforeach;
            else : ?>
                <div class="col-12 text-center" colspan="4">Tidak ada data</div>
            <?php endif; ?>
        </section>
        <section class="d-flex justify-content-end">
            <?php if ($editStatus) : ?>
                <a href="<?= base_url("/anggota/keluarga/$dataPribadi->id") ?>"><button class="btn btn-success px-5 btn-lg">Done</button></a>
            <?php else : ?>
                <a href="<?= base_url("/anggota/keluarga/$dataPribadi->id?edit=true") ?>"><button class="btn btn-primary px-5 btn-lg">Edit</button></a>
            <?php endif; ?>
        </section>
    </div>
    <?= $footer ?>

    <?php if ($editStatus) : ?>
        <script>
            $("#tambahRelasi").click(() => {
                Swal.fire({
                    title: 'Tambah Data Relasi',
                    html: `
                    <form id="formRelasi" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Jenis Relasi</label>
                            <select name="idJenisRelasi" class="form-select" required>
                                <option value="" hidden>Pilih Jenis Relasi</option>
                                <?php foreach ($jenisRelasi as $j) : ?>
                                <option value="<?= $j->id ?>"><?= $j->namaRelasi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Nama Lengkap</label>
                            <input name="namaLengkap" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Alamat</label>
                            <input name="alamat" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Pekerjaan</label>
                            <input name="pekerjaan" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Nomor Telepon</label>
                            <input name="nomorTelepon" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Status</label>
                            <select name="statusMeninggal" class="form-select" required>
                                <option value="" hidden>Pilih Status</option>
                                <option value="0">Masih Hidup</option>
                                <option value="1">Sudah Meninggal</option>
                            </select>
                        </div>
                        <div class="mb-1 mt-3">
                            <input class="form-check-input" type="checkbox" id="kontakDarurat" name="kontakDarurat">
                            <label class="form-check-label" for="kontakDarurat">
                                Cantumkan data ini sebagai kontak darurat
                            </label>
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

                $("#formRelasi").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formRelasi")[0]);
                    formData.append("tambahRelasi", 1);
                    formData.append("id", "<?= $dataPribadi->id ?>");
                    axios.post("<?= base_url("api/editanggota") ?>", formData).then(res => {
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

            const editKeluarga = (id) => {
                let tempData;
                axios.get(`<?= base_url("api/dataRelasi") ?>?idRelasi=${id}`).then(
                    res => {
                        tempData = res.data;
                        Swal.fire({
                            title: 'Ubah Data Relasi',
                            html: `
                    <form id="formEditRelasi" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Jenis Relasi</label>
                            <select name="idJenisRelasi" class="form-select" required>
                                <option value="" hidden>Pilih Jenis Relasi</option>
                                <?php foreach ($jenisRelasi as $j) : ?>
                                <option value="<?= $j->id ?>" ${tempData.idJenisRelasi == <?= $j->id ?> ? "selected" : ""} ><?= $j->namaRelasi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Nama Lengkap</label>
                            <input name="namaLengkap" class="form-control" value="${tempData.namaLengkap}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Alamat</label>
                            <input name="alamat" class="form-control" value="${tempData.alamat}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Pekerjaan</label>
                            <input name="pekerjaan" class="form-control" value="${tempData.pekerjaan}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Nomor Telepon</label>
                            <input name="nomorTelepon" class="form-control" value="${tempData.nomorTelepon}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" value="${tempData.email}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Status</label>
                            <select name="statusMeninggal" class="form-select" required>
                                <option value="0" ${!Number(tempData.statusMeninggal) ? "selected" : ""}>Masih Hidup</option>
                                <option value="1" ${Number(tempData.statusMeninggal) ? "selected" : ""}>Sudah Meninggal</option>
                            </select>
                        </div>
                        <div class="mb-1 mt-3">
                            <input class="form-check-input" type="checkbox" id="kontakDarurat" name="kontakDarurat" ${Number(tempData.kontakDarurat) ? "checked" : ""}>
                            <label class="form-check-label" for="kontakDarurat">
                                Cantumkan data ini sebagai kontak darurat
                            </label>
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

                        $("#formEditRelasi").submit(() => {
                            event.preventDefault();
                            const formData = new FormData($("#formEditRelasi")[0]);
                            formData.append("editRelasi", 1);
                            formData.append("id", id);
                            axios.post("<?= base_url("api/editanggota") ?>", formData).then(
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

            const hapusKeluarga = (id) => {
                Swal.fire({
                    title: 'Hapus Data Relasi',
                    text: "Apakah anda yakin ingin menghapus data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.value) {
                        const formData = new FormData();
                        formData.append("hapusRelasi", 1);
                        formData.append("id", id);
                        axios.post("<?= base_url("api/editanggota") ?>", formData).then(
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
            }
        </script>
    <?php endif; ?>
</body>

</html>
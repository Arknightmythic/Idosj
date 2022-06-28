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

        <!-- Section of Pribadi -->
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Perutusan</h3>
                <?php if($editStatus): ?>
                <button id="tambahPerutusan" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <table class="table table-stiped">
                <thead>
                    <th>Tempat Perutusan</th>
                    <th>Tugas dan Jabatan</th>
                    <th>Tahun Masuk</th>
                    <th>Tahun Berakhir</th>
                    <th>Surat Keterangan</th>
                    <?php if($editStatus): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </thead>
                <tbody>
                    <?php foreach($dataPerutusan as $data): ?>
                    <tr>
                        <td><?= !empty($data->tempatPerutusan) ? $data->tempatPerutusan : "-" ?></td>
                        <td><?= !empty($data->keterangan) ? $data->keterangan : "-" ?></td>
                        <td><?= !empty($data->tahunMasuk) ? $data->tahunMasuk : "-" ?></td>
                        <td><?= !empty($data->tahunBerakhir) ? $data->tahunBerakhir : "now" ?></td>
                        <?php if(!empty($data->fileSK)):?>
                        <td><a class="btn btn-primary" href="<?= base_url('/uploads/sk-perutusan/') . $data->fileSK ?>"
                                type="file" download>Download</a>
                        </td>
                        <?php else: ?>
                        <td>-</td>
                        <?php endif ?>
                        <?php if($editStatus): ?>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="hapusPerutusan(<?= $data->id ?>)">
                                <i class="fa fa-trash"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" onclick="editPerutusan(<?= $data->id ?>)">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
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
    $("#tambahPerutusan").click(() => {
        Swal.fire({
            title: 'Tambah Data Perutusan',
            html: `
                    <form id="formPerutusan" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Tempat Perutusan</label>
                            <input name="tempatPerutusan" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tugas dan Jabatan</label>
                            <input name="keterangan" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tahun Masuk</label>
                            <input name="tahunMasuk" class="form-control onlyYears" maxlength="4" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tahun Berakhir</label>
                            <input name="tahunBerakhir" class="form-control onlyYears" maxlength="4" />
                            <small class="form-text text-muted">Jika belum berakhir, silahkan dikosongkan</small>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Surat Keterangan</label>
                            <input name="fileData" type="file" class="form-control" required />
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

        $("#formPerutusan").submit(() => {
            event.preventDefault();
            const formData = new FormData($("#formPerutusan")[0]);
            formData.append("tambahPerutusan", 1);
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

        $(".onlyYears").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            orientation: "bottom auto"
        });
    })

    const editPerutusan = (id) => {
        let tempData;
        axios.get(`<?= base_url("/index.php/api/dataPerutusan") ?>?idPerutusan=${id}`).then(
            res => {
                tempData = res.data;
                Swal.fire({
                    title: 'Edit Data Perutusan',
                    html: `
                    <form id="formEditPerutusan" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Tempat Perutusan</label>
                            <input name="tempatPerutusan" class="form-control" value="${tempData.tempatPerutusan}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tugas dan Jabatan</label>
                            <input name="keterangan" class="form-control" value="${tempData.keterangan}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tahun Masuk</label>
                            <input name="tahunMasuk" class="form-control onlyYears" maxlength="4" value="${tempData.tahunMasuk}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tahun Berakhir</label>
                            <input name="tahunBerakhir" class="form-control onlyYears" maxlength="4" value="${tempData.tahunBerakhir}" />
                            <small class="form-text text-muted">Jika belum berakhir, silahkan dikosongkan</small>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Surat Keterangan</label>
                            <input name="fileData" class="form-control" value="${tempData.fileSK}" disabled />
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

                $("#formEditPerutusan").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formEditPerutusan")[0]);
                    formData.append("editPerutusan", 1);
                    formData.append("id", id);
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

                $(".onlyYears").datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    orientation: "bottom auto"
                });
            })
    }

    const hapusPerutusan = (id) => {
        Swal.fire({
            title: 'Hapus Data Perutusan',
            text: "Apakah anda yakin ingin menghapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!"
        }).then(result => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append("hapusPerutusan", 1);
                formData.append("id", id);
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
    }
    </script>
    <?php endif; ?>

</body>

</html>
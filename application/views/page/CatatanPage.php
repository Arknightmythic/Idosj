<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-submenu.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-page.css"); ?>">
    <?= $css ?>
    <?= $js ?>
</head>

<body>
    <?= $navbar ?>
    <div class="container px-4 px-md-0">
        <?= $submenu ?>

        <!-- Section of Perjalanan -->
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Dismissal</h3>
                <?php if ($editStatus) : ?>
                    <button id="editDimissi" class="btn btn-secondary">
                        <i class="fa fa-file-arrow-up"></i>
                        <span class="ms-1">Upload File</span>
                    </button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th class="col-2">Application Letter</th>
                        <th class="col-2">Provincial Letter</th>
                        <th class="col-2">Judgement of Provincial</th>
                        <th class="col-2">Declaration of Fact</th>
                        <th>R-1</th>
                        <th>D-1</th>
                        <th>N-1</th>
                        <th>Schede</th>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            if (!empty($dataDimissi)) :
                                foreach ($dataDimissi as $key => $value) :
                                    if ($key == "id") continue;
                                    else if ($key == "idAnggota") continue;
                            ?>
                                    <td>
                                        <?php if (!empty($value)) : ?>
                                            <a class="btn btn-primary" href="<?= base_url("/uploads/catatan/") . $value ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                            <?php endforeach;
                            endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Laicization</h3>
                <?php if ($editStatus) : ?>
                    <button id="editLaisasi" class="btn btn-secondary">
                        <i class="fa fa-file-arrow-up"></i>
                        <span class="ms-1">Upload File</span>
                    </button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>Application Letter</th>
                        <th>Provincial Letter</th>
                        <th>CV and Interview</th>
                        <th>Judgement of Provincial</th>
                        <th>Testimony</th>
                        <th>Father General's Letter</th>
                        <th class="col-2">Letter of Dispensation from the Holy See</th>
                    <tbody>
                        <tr>
                            <?php
                            if (!empty($dataLaisasi)) :
                                foreach ($dataLaisasi as $key => $value) :
                                    if ($key == "id") continue;
                                    else if ($key == "idAnggota") continue;
                            ?>
                                    <td>
                                        <?php if (!empty($value)) : ?>
                                            <a class="btn btn-primary" href="<?= base_url("/uploads/catatan/") . $value ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                            <?php endforeach;
                            endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Deceased</h3>
                <?php if ($editStatus) : ?>
                    <button id="editKematian" class="btn btn-secondary">
                        <i class="fa fa-pencil"></i>
                        <span class="ms-1">Ubah</span>
                    </button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>Date</th>
                        <th>Place</th>
                        <th>Time</th>
                        <th>Cemetery</th>
                        <th>Death Certificate</th>
                        <th>Death Description</th>
                    <tbody>
                        <tr>
                            <td><?= !empty($dataKematian->tanggal) ? date_format(date_create($dataKematian->tanggal), "d F Y") : "-" ?>
                            </td>
                            <td><?= !empty($dataKematian->tempat) ? $dataKematian->tempat : "-" ?></td>
                            <td><?= !empty($dataKematian->waktu) ? $dataKematian->waktu : "-" ?></td>
                            <td><?= !empty($dataKematian->makam) ? $dataKematian->makam : "-" ?></td>
                            <td>
                                <?php if (!empty($dataKematian->aktaKematian)) : ?>
                                    <a class="btn btn-primary" href="<?= base_url("/uploads/catatan/") . $dataKematian->aktaKematian ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($dataKematian->keteranganKematian)) : ?>
                                    <a class="btn btn-primary" href="<?= base_url("/uploads/catatan/") . $dataKematian->keteranganKematian ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="d-flex justify-content-end">
            <?php if ($editStatus) : ?>
                <a href="<?= base_url("/anggota/catatan/$dataPribadi->id") ?>"><button class="btn btn-success px-5 btn-lg">Selesai</button></a>
            <?php else : ?>
                <a href="<?= base_url("/anggota/catatan/$dataPribadi->id?edit=true") ?>"><button class="btn btn-primary px-5 btn-lg">Edit</button></a>
            <?php endif; ?>
        </section>
    </div>
    <?= $footer ?>

    <script>
        $("#editDimissi").click(() => {
            Swal.fire({
                title: "Upload Dokumen Dimissi",
                html: `
                    <form id="formDimissi" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1 form-group">
                            <label class="form-label">Jenis Dokumen</label>
                            <select class="form-select" name="jenisDokumen" required>
                                <option value="" hidden>Pilih Jenis Dokumen</option>
                                <option value="suratPermohonan">Surat Permohonan</option>
                                <option value="suratProvinsial">Surat Provinsial</option>
                                <option value="judgementProvinsial">Judgement of Provinsial</option>
                                <option value="declarationFact">Declaration of Fact</option>
                                <option value="r1">R-1</option>
                                <option value="d1">D-1</option>
                                <option value="n1">N-1</option>
                                <option value="schede">Schede</option>
                            </select>
                        </div>
                        <div class="mb-1 form-group">
                            <label class="form-label">File Dokumen</label>
                            <input type="file" class="form-control" name="fileData" accept="application/pdf" required>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                `,
                showConfirmButton: false,
                showCloseButton: true,
            })

            $("#formDimissi").submit(() => {
                event.preventDefault();
                const formData = new FormData($("#formDimissi")[0]);
                formData.append("addCatatan", true);
                formData.append("dimissi", true);
                formData.append("idAnggota", '<?= $dataPribadi->id ?>');
                axios.post("<?= base_url("api/dataCatatan") ?>", formData).then((res) => {
                    Swal.fire({
                        title: res.data?.title,
                        text: res.data?.message,
                        icon: res.data?.status,
                    }).then(() => window.location.reload());
                });
            })
        })

        $("#editLaisasi").click(() => {
            Swal.fire({
                title: "Upload Dokumen Laisasi",
                html: `
                    <form id="formLaisasi" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1 form-group">
                            <label class="form-label">Jenis Dokumen</label>
                            <select class="form-select" name="jenisDokumen" required>
                                <option value="" hidden>Pilih Jenis Dokumen</option>
                                <option value="suratPermohonan">Surat Permohonan</option>
                                <option value="suratProvinsial">Surat Provinsial</option>
                                <option value="cvWawancara">CV dan Wawancara</option>
                                <option value="judgementProvinsial">Judgement of Provinsial</option>
                                <option value="testimony">Testimony</option>
                                <option value="suratPater">Surat Pater Jenderal</option>
                                <option value="suratVatikan">Surat Dispensasi Vatikan</option>
                            </select>
                        </div>
                        <div class="mb-1 form-group">
                            <label class="form-label">File Dokumen</label>
                            <input type="file" class="form-control" name="fileData" accept="application/pdf" required>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                `,
                showConfirmButton: false,
                showCloseButton: true,
            })

            $("#formLaisasi").submit(() => {
                event.preventDefault();
                const formData = new FormData($("#formLaisasi")[0]);
                formData.append("addCatatan", true);
                formData.append("laisasi", true);
                formData.append("idAnggota", '<?= $dataPribadi->id ?>');
                axios.post("<?= base_url("api/dataCatatan") ?>", formData).then((res) => {
                    Swal.fire({
                        title: res.data?.title,
                        text: res.data?.message,
                        icon: res.data?.status,
                    }).then(() => window.location.reload());
                });
            })
        })

        $("#editKematian").click(() => {
            Swal.fire({
                title: "Upload Dokumen Kematian",
                html: `
                    <form id="formKematian" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1 form-group">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required>
                        </div>
                        <div class="mb-1 form-group">
                            <label class="form-label">Tempat</label>
                            <input class="form-control" name="tempat" required>
                        </div>
                        <div class="mb-1 form-group">
                            <label class="form-label">Waktu</label>
                            <input class="form-control" name="waktu" required>
                        </div>
                        <div class="mb-1 form-group">
                            <label class="form-label">Dimakamkan di</label>
                            <input class="form-control" name="makam" required>
                        </div>
                        <div class="mb-1 form-group">
                            <label class="form-label">Akta Kematian</label>
                            <input type="file" class="form-control" name="fileData1" accept="application/pdf" required>
                        </div>
                        <div class="mb-1 form-group">
                            <label class="form-label">Keterangan Kematian</label>
                            <input type="file" class="form-control" name="fileData2" accept="application/pdf" required>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                `,
                showConfirmButton: false,
                showCloseButton: true,
            })

            $("#formKematian").submit(() => {
                event.preventDefault();
                const formData = new FormData($("#formKematian")[0]);
                formData.append("addCatatan", true);
                formData.append("kematian", true);
                formData.append("idAnggota", '<?= $dataPribadi->id ?>');
                axios.post("<?= base_url("api/dataCatatan") ?>", formData).then((res) => {
                    Swal.fire({
                        title: res.data?.title,
                        text: res.data?.message,
                        icon: res.data?.status,
                    }).then(() => window.location.reload());
                });
            })
        })
    </script>

</body>

</html>
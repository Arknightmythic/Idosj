<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-page.css"); ?>">
    <?= $css?>
    <?= $js?>
</head>

<body>
    <?= $navbar?>
    <div class="container px-4 px-md-0">
        <section>
            <h2 class="text-center mb-3">List Dokumen</h2>
            <?php if($this->session->role == "Administrator"): ?>
            <div class="d-flex justify-content-end">
                <button id="addDokumen" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <?php endif; ?>
            <table class="table table-striped">
                <thead>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php foreach($dataDokumen as $dokumen): ?>
                    <tr>
                        <td>
                            <a class="fw-bold" href="<?= base_url("/uploads/dokumen/".$dokumen->fileDokumen) ?>"
                                target="_blank">
                                <?= $dokumen->namaDokumen ?>
                            </a>
                        </td>
                        <td><?= $dokumen->jenisDokumen ?></td>
                        <td>
                            <button class="btn btn-primary" onclick="deleteDokumen(<?= $dokumen->id ?>)">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button class="btn btn-danger" onclick="deleteDokumen(<?= $dokumen->id ?>)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
    <?= $footer ?>

    <script>
    $("#addDokumen").click(() => {
        Swal.fire({
            title: 'Tambah Dokumen',
            html: `
                    <form id="formAddDokumen" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1 form-group">
                            <label class="form-label">Nama Dokumen</label>
                            <input type="text" class="form-control" name="namaDokumen"  required/>
                        </div>
                        <div class="mb-1 form-group">
                            <label class="form-label">Jenis Dokumen</label>
                            <select class="form-select" name="jenisDokumen" required>
                                <option value="" hidden>Pilih jenis dokumen</option>
                                <option value="Provinsial">Provinsial</option>
                                <option value="Universal">Universal</option>
                            </select>
                        </div>
                        <div class="mb-1 form-group">
                            <label class="form-label">File Dokumen</label>
                            <input type="file" class="form-control" name="fileData" required />
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                `,
            showConfirmButton: false,
            showCloseButton: true,
        })

        $("#formAddDokumen").submit(() => {
            event.preventDefault();
            const formData = new FormData($("#formAddDokumen")[0]);
            formData.append("addDokumen", true);
            axios.post("<?= base_url("api/dataDokumenBersama") ?>", formData).then((res) => {
                Swal.fire({
                    title: res.data?.title,
                    text: res.data?.message,
                    icon: res.data?.status,
                }).then(() => window.location.reload());
            });
        })
    });
    </script>
</body>

</html>
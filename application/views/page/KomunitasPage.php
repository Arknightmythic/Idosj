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
            <h2 class="text-center mb-3">List of Community</h2>
            <?php if($this->session->role == "Administrator"): ?>
            <div class="d-flex justify-content-end">
                <button id="addKomunitas" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <?php endif; ?>
            <table class="table table-striped">
                <thead>
                    <th>Name of Community</th>
                </thead>
                <tbody>
                    <?php foreach ($dataKomunitas as $komunitas): ?>
                    <tr>
                        <td>
                            <a
                                href="<?= base_url("home/komunitas/".preg_replace('/\s+/', '-', $komunitas->nama)) ?>"><?= $komunitas->nama ?></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
    <?= $footer ?>

    <script>
    $("#addKomunitas").click(() => {
        Swal.fire({
            title: 'Tambah Komunitas dan Residensi',
            html: `
                    <form id="formAddKomunitas" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1 form-group">
                            <label class="form-label">Komunitas</label>
                            <select class="form-select" name="selectKomunitas" required>
                                <option value="" hidden>Pilih Komunitas</option>
                                <?php foreach ($dataKomunitas as $komunitas): ?>
                                <option value="<?= $komunitas->nama ?>"><?= $komunitas->nama ?></option>
                                <?php endforeach; ?>
                                <option value="addNew">Buat baru (+)</option>
                            </select>
                        </div>
                        <div class="mb-1 form-group" id="newKomunitas">
                            <label class="form-label">Nama Komunitas</label>
                            <input name="nama" class="form-control" required />
                        </div>
                        <div class="mb-1 form-group">
                            <label class="form-label">Residensi</label>
                            <input name="residensi" class="form-control" required />
                        </div>
                        <div class="mb-1 form-group">
                            <label class="form-label">Alamat</label>
                            <input name="alamatResidensi" class="form-control" required />
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                `,
            showConfirmButton: false,
            showCloseButton: true,
        })

        $("#newKomunitas").hide();

        $("#formAddKomunitas select[name='selectKomunitas']").change(() => {
            console.log($("#formAddKomunitas select[name='selectKomunitas']").val());
            const value = $("#formAddKomunitas select[name='selectKomunitas']").val();
            if (value == "addNew") {
                $("#formAddKomunitas input[name='nama']").val("");
                $("#newKomunitas").show();
                $("#formAddKomunitas input[name='nama']").focus();
            } else {
                $("#newKomunitas").hide();
                $("#formAddKomunitas input[name='nama']").val(value);
            }
        })

        $("#formAddKomunitas").submit(() => {
            event.preventDefault();
            const formData = new FormData($("#formAddKomunitas")[0]);
            formData.append("addKomunitas", true);
            axios.post("<?= base_url("api/datakomunitas") ?>", formData).then((res) => {
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
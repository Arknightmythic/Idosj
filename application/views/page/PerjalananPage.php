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
        <?= $submenu ?>

        <!-- Section of Perjalanan -->
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Perjalanan</h3>
                <a href="<?= base_url("formkuning") ?>" class="btn btn-warning" style="height: max-content">Ajukan Form
                    Kuning</a>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>Sponsor, Tempat</th>
                        <th>Waktu</th>
                        <th>Keperluan</th>
                        <th>Dokumen</th>
                        <?php if($this->session->role == "Administrator" || $this->session->idAnggota == $dataPribadi->idSuperior || $this->session->idAnggota == $dataPribadi->idDelegat): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php foreach($dataPerjalanan as $data): 
                        $status = 0;
                        if($data->statusProvinsial){
                        $status = 2;
                        } else if($data->statusSuperior){
                        $status = 1;
                        }
                        ?>
                        <tr>
                            <td><?= $data->q7.", ".$data->q3 ?></td>
                            <td>
                                <?= date_format(date_create($data->q1), "d/m/y")." - ".date_format(date_create($data->q2), "d/m/y") ?>
                            </td>
                            <td><?= $data->q4 ?></td>
                            <td>
                                <?php
                                    if($status == 0){
                                        echo $data->statusSuperior == NULL ? "<div class='hi-block'>Menunggu persetujuan Superior</div>" : "<div class='hi-block'>Permohonan ditolak oleh Superior</div>";
                                    } else if($status == 1){
                                        echo $data->statusProvinsial == NULL ? "<div class='hi-block'>Menunggu persetujuan Pater Provinsial</div>" : "<div class='hi-block'>Permohonan ditolak oleh Pater Provinsial</div>";
                                    } else if($status == 2){
                                        echo "
                                        <a href='".base_url("formkuning/print/")."$data->id' class='btn btn-primary' target='_blank'>
                                            <i class='fa fa fa-file-lines'></i>
                                        </a>";
                                }
                                ?>
                            </td>
                            <?php if($this->session->role == "Administrator" || $this->session->idAnggota == $dataPribadi->idSuperior || $this->session->idAnggota == $dataPribadi->idDelegat): ?>
                            <td>
                                <?php
                                    $currRole = $this->session->role;
                                    if(($this->session->role == "Administrator" && $status == 1 && $data->statusProvinsial == NULL) || ($this->session->role == "Superior" && $status == 0 && $data->statusSuperior == NULL)){
                                        echo "<button class='btn btn-secondary' onClick='approval($data->id)'><i class='fa fa-external-link'></i></button>";
                                    } else {
                                        echo "<button class='btn btn-secondary' disabled><i class='fa fa-external-link'></i></button>";
                                    }
                                    ?>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <?= $footer ?>

    <script>
    const approval = (formId) => {
        axios.get(`<?= base_url("api/formkuning")?>?formId=${formId}`).then(res => {
            const data = res.data;
            console.log(data);
            Swal.fire({
                title: 'Permohonan Izin Bepergian Ke Luar Negeri',
                html: `
                    <div>
                        <table class="table" style="text-align: left !important;">
                            <tr>
                                <td>Tempat</td>
                                <td>:</td>
                                <td>${data.q3}</td>
                            </tr>
                            <tr>
                                <td>Keperluan</td>
                                <td>:</td>
                                <td>${data.q4}</td>
                            </tr>
                            <tr>
                                <td>Sponsor</td>
                                <td>:</td>
                                <td>${data.q7}</td>
                            </tr>
                            <tr>
                                <td>Detail</td>
                                <td>:</td>
                                <td>
                                        <a class="btn btn-warning" href="<?= base_url("formkuning/print/") ?>${formId}" target="_blank">
                                            <i class="fa fa fa-file-lines me-1"></i>
                                            Lihat Form Kuning
                                        </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                `,
                showDenyButton: true,
                showConfirmButton: true,
                showCloseButton: true,
                confirmButtonText: 'Setuju',
                denyButtonText: 'Tidak Setuju',
                denyButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
            }).then(result => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Tanggapan Anda',
                        input: 'textarea',
                        showCancelButton: true,
                        cancelButtonText: 'Batal',
                        confirmButtonText: 'Ya, saya yakin',
                        confirmButtonColor: '#3085d6',
                        preConfirm: (tanggapan) => {
                            if (tanggapan.length == 0) {
                                Swal.showValidationMessage(
                                    'Anda harus mengisi tanggapan untuk menyetuji permohonan ini'
                                );
                                return null;
                            } else {
                                return tanggapan;
                            }
                        },
                    }).then(res => {
                        if (res.isConfirmed) {
                            Swal.fire({
                                title: "Loading...",
                                text: "Melakukan perubahan data pada server",
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            const formData = new FormData();
                            formData.append("formId", formId);
                            formData.append("tanggapan", res.value);
                            <?php if($this->session->role == "Administrator"): ?>
                            formData.append("statusProvinsial", true);
                            <?php elseif($dataPribadi->idSuperior == $this->session->idAnggota): ?>
                            formData.append("statusSuperior", true);
                            <?php endif; ?>
                            axios.post("<?= base_url("api/formkuning") ?>", formData).then(
                                res => {
                                    Swal.close();
                                    Swal.fire({
                                        title: res.data?.title,
                                        text: res.data?.message,
                                        icon: res.data?.status,
                                    }).then(() => window.location.reload());
                                }).catch(err => {
                                console.log(err);
                            })
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire({
                        title: 'Apakah anda yakin untuk menolak permohonan ini?',
                        text: 'Dengan mengklik yakin maka anda tidak dapat mengubah tanggapan anda',
                        showCancelButton: true,
                        cancelButtonText: 'Batal',
                        confirmButtonText: 'Ya, saya yakin',
                        confirmButtonColor: '#d33',
                    }).then(res => {
                        if (res.isConfirmed) {
                            Swal.fire({
                                title: "Loading...",
                                text: "Melakukan perubahan data pada server",
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            const formData = new FormData();
                            formData.append("formId", formId);
                            <?php if($this->session->role == "Administrator"): ?>
                            formData.append("statusProvinsial", false);
                            <?php elseif($dataPribadi->idSuperior == $this->session->idAnggota): ?>
                            formData.append("statusSuperior", false);
                            <?php endif; ?>
                            axios.post("<?= base_url("api/formkuning") ?>", formData).then(
                                res => {
                                    Swal.close();
                                    Swal.fire({
                                        title: res.data?.title,
                                        text: res.data?.message,
                                        icon: res.data?.status,
                                    }).then(() => window.location.reload());
                                }).catch(err => {
                                console.log(err);
                            });
                        }
                    })
                }
            })
        }).catch(err => console.log(err));
    }
    </script>

</body>

</html>
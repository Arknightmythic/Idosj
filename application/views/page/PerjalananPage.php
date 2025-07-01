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
                <h3>Overseas Trip</h3>
                <a href="<?= base_url("formizin") ?>" class="btn btn-warning" style="height: max-content">Ajukan Form
                    Izin KAS</a>
                <?php if ($this->session->role == "Superior"): ?>
                    <a href="<?= base_url("formkuning") ?>" class="btn btn-warning" style="height: max-content">Ajukan Form
                        Kuning superior</a>
                <?php else: ?>
                    <a href="<?= base_url("formkuning") ?>" class="btn btn-warning" style="height: max-content">Ajukan Form
                        Kuning anggota</a>
                <?php endif ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>Sponsor & Destination</th>
                        <th>Duration</th>
                        <th>Purposes</th>
                        <th>Progress</th>
                        <?php if ($this->session->role == "Administrator" || $this->session->idAnggota == $dataPribadi->idSuperior || $this->session->idAnggota == $dataPribadi->idDelegat) : ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php foreach ($dataPerjalanan as $data) :
                            $status = 0;
                            if ($data->statusProvinsial) {
                                $status = 2;
                            } else if ($data->statusSuperior) {
                                $status = 1;
                            }

                            if ($data->FormType == "KAS" && $data->q8 == "Superior") {
                                $apiUrl = base_url("api/formIzinSuperiorDirectToProvincial");
                            } elseif ($data->FormType == "KAS" && $data->q8 == "personal") {
                                $apiUrl = base_url("api/formIzinAnggotaDirectToProvincial");
                            } elseif (($data->FormType == null || $data->FormType == "") && $data->q8 == "Superior") {
                                $apiUrl = base_url("api/formKuningDirectToProvincial");
                            } elseif (($data->FormType == null || $data->FormType == "") && $data->q8 == "personal") {
                                $apiUrl = base_url("api/formkuning");
                            } else {
                                // Fallback to your previous logic if none of the conditions match
                                $apiUrl = ($data->q8 == "Superior") ? base_url("api/formKuningDirectToProvincial") : base_url("api/formkuning");
                            }
                        ?>
                            <tr>
                                <td><?= $data->q7 . ", " . $data->q3 ?></td>
                                <td>
                                    <?= date_format(date_create($data->q1), "d/m/y") . " - " . date_format(date_create($data->q2), "d/m/y") ?>
                                </td>
                                <td><?= $data->q4 ?></td>
                                <td>
                                    <?php
                                    // Check if both statusSuperior and statusProvinsial are null
                                    if (is_null($data->statusSuperior) && is_null($data->statusProvinsial)) {
                                        echo "<div class='hi-block warning'>Menunggu persetujuan Superior</div>";
                                    }
                                    // Check if statusSuperior is 0 and statusProvinsial is null
                                    else if ($data->statusSuperior == 0 && is_null($data->statusProvinsial)) {
                                        echo "<div class='hi-block danger'>Permohonan ditolak oleh Superior</div>";
                                    }
                                    // Check if statusSuperior is 1 and statusProvinsial is null
                                    else if ($data->statusSuperior == 1 && is_null($data->statusProvinsial)) {
                                        echo "<div class='hi-block warning'>Menunggu persetujuan Pater Provinsial</div>";
                                    }
                                    // Check if statusSuperior is 1 and statusProvinsial is 0
                                    else if ($data->statusSuperior == 1 && $data->statusProvinsial == 0) {
                                        echo "<div class='hi-block danger'>Permohonan ditolak oleh Pater Provinsial</div>";
                                    }
                                    // Check if statusSuperior is 1 and statusProvinsial is 1
                                    else if ($data->statusSuperior == 1 && $data->statusProvinsial == 1) {
                                        $printUrl = ($data->FormType == "KAS") ? base_url("formizin/print/") : base_url("formkuning/print/");
                                        echo "<a href='" . $printUrl . "$data->id' class='btn btn-primary' target='_blank'>
            <i class='fa fa fa-file-lines'></i>
          </a>";
                                    }
                                    ?>
                                </td>
                                <?php if ($this->session->role == "Administrator" || $this->session->idAnggota == $dataPribadi->idSuperior || $this->session->idAnggota == $dataPribadi->idDelegat) : ?>
                                    <td>
                                        <?php
                                        $currRole = $this->session->role;
                                        if (($this->session->role == "Administrator" && $status == 1 && $data->statusProvinsial == NULL) || ($this->session->role == "Superior" && $status == 0 && $data->statusSuperior == NULL)) {
                                            echo "<button class='btn btn-secondary' onClick='approval($data->id, \"$apiUrl\")'><i class='fa fa-external-link'></i></button>";
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
    <!-- albert update -->
    <script>
        const approval = (formId, apiUrl) => {
            axios.get(`${apiUrl}?formId=${formId}`).then(res => {
                const data = res.data;
                console.log(data);

                // Create the detail URL dynamically in JavaScript
                const detailUrl = data.FormType === "KAS" ?
                    `<?= base_url("formizin/print/") ?>${formId}` :
                    `<?= base_url("formkuning/print/") ?>${formId}`;

                const buttonText = data.FormType === "KAS" ? "Lihat Form Izin" : "Lihat Form Kuning";

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
                            <td>Detail </td>
                            <td>:</td>
                            <td>
                                <a class="btn btn-warning" href="${detailUrl}" target="_blank">
                                    <i class="fa fa fa-file-lines me-1"></i>
                                    ${buttonText}
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
                                <?php if ($this->session->role == "Administrator") : ?>
                                    formData.append("statusProvinsial", true);
                                <?php elseif ($dataPribadi->idSuperior == $this->session->idAnggota) : ?>
                                    formData.append("statusSuperior", true);
                                <?php endif; ?>
                                axios.post(apiUrl, formData).then(
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
                            text: 'Berikan alasan Anda',
                            input: 'textarea',
                            showCancelButton: true,
                            cancelButtonText: 'Batal',
                            confirmButtonText: 'Ya, saya yakin',
                            confirmButtonColor: '#d33',
                            preConfirm: (tanggapan) => {
                                if (tanggapan.length == 0) {
                                    Swal.showValidationMessage(
                                        'Anda harus memberikan alasan untuk menolak permohonan ini'
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
                                <?php if ($this->session->role == "Administrator") : ?>
                                    formData.append("statusProvinsial", false);
                                <?php elseif ($dataPribadi->idSuperior == $this->session->idAnggota) : ?>
                                    formData.append("statusSuperior", false);
                                <?php endif; ?>
                                axios.post(apiUrl, formData).then(
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
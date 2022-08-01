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
            <h2 class="text-center mb-3">Komunitas <?= $dataResidensi[0]->nama ?></h2>
            <?php foreach($dataResidensi as $residensi): ?>
            <div class="mt-5 mb-1">
                <h4><?= $residensi->residensi ?></h4>
                <p><?= $residensi->alamatResidensi ?></p>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>Nama Anggota</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                </thead>
                <tbody>
                    <?php foreach ($residensi->anggota as $anggota): ?>
                    <tr>
                        <td>
                            <?= $this->session->role == "Administrator" ? "<a href='".base_url("/anggota/pribadi/$anggota->id")."' target='_blank'>$anggota->namaDepan $anggota->namaBelakang</a>" : "$anggota->namaDepan $anggota->namaBelakang" ?>
                        </td>
                        <td><?= !empty($anggota->email) ? $anggota->email : "-" ?></td>
                        <td><?= !empty($anggota->nomorTelepon) ? $anggota->nomorTelepon : "-" ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endforeach; ?>
        </section>
    </div>
    <?= $footer ?>

    <script>
    </script>
</body>

</html>
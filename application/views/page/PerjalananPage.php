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
                <a href="#" download class="btn btn-warning" style="height: max-content">Download Form Kuning</a>
            </div>
            <table class="table table-stiped">
                <thead>
                    <th>Sponsor, Tempat</th>
                    <th>Waktu</th>
                    <th>Keperluan</th>
                    <th>Kartu Kuning</th>
                </thead>
                <tbody>
                    <?php foreach($dataPerjalanan as $data): ?>
                    <tr>
                        <td><?= $data->keterangan ?></td>
                        <td><?= date_format(date_create($data->tanggalMulai), "d/m/y") . " - " . date_format(date_create($data->tanggalBerakhir), "d/m/y") ?>
                        </td>
                        <td><?= $data->keperluan ?></td>
                        <?php if(!empty($data->fileKartuKuning)):?>
                        <td><a class="btn btn-primary"
                                href="<?= base_url('/uploads/kk-perjalanan/') . $data->fileKartuKuning ?>" type="file"
                                download>Download</a>
                        </td>
                        <?php else: ?>
                        <td>-</td>
                        <?php endif ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <section>

        </section>
    </div>
    <?= $footer ?>

</body>

</html>
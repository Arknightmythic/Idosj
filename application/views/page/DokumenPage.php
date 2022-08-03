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
                <h3>Provinsial</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>Dokumen</th>
                    </thead>
                    <tbody>
                        <?php foreach ($dataDokumen as $dokumen): if($dokumen->jenisDokumen == "Provinsial"): ?>
                        <tr>
                            <td>
                                <a class="fw-bold" href="<?= base_url("/uploads/dokumen/").$dokumen->fileDokumen ?>"
                                    target="_blank"><?= $dokumen->namaDokumen ?></a>
                            </td>
                        </tr>
                        <?php endif; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Universal</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>Dokumen</th>
                    </thead>
                    <tbody>
                        <?php foreach ($dataDokumen as $dokumen): if($dokumen->jenisDokumen == "Universal"): ?>
                        <tr>
                            <td>
                                <a class="fw-bold" href="<?= base_url("/uploads/dokumen/").$dokumen->fileDokumen ?>"
                                    target="_blank"><?= $dokumen->namaDokumen ?></a>
                            </td>
                        </tr>
                        <?php endif; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <?= $footer ?>
</body>

</html>
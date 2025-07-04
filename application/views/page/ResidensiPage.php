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
            <h2 class="text-center mb-3"> <?= $dataResidensi[0]->nama ?> Community</h2>
            <?php foreach($dataResidensi as $residensi): ?>
            <div class="mt-5 mb-1">
                <h4><?= $residensi->residensi ?></h4>
                <p><?= $residensi->alamatResidensi ?></p>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </thead>
                <tbody>
                    <?php foreach ($residensi->anggota as $anggota): ?>
                    <tr>
                        <td>
                            <?= $this->session->role == "Administrator" ? "<a href='".base_url("/anggota/pribadi/$anggota->id")."' target='_blank'>$anggota->namaBelakang, $anggota->namaDepan</a>" : "$anggota->namaBelakang, $anggota->namaDepan" ?>
                        </td>
                        <td><?= !empty($anggota->email) ? "<a href='mailto:$anggota->email' target='_blank'>$anggota->email</a>" : "-" ?>
                        </td>
                        <td><?= !empty($anggota->nomorTelepon) ? "<a href='https://wa.me/62".substr($anggota->nomorTelepon,1)."' target='_blank'>$anggota->nomorTelepon</a>" : "-" ?>
                        </td>
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
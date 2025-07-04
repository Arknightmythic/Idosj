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
            <h2 class="text-center mb-3">Index</h2>
            <table class="table table-striped">
                <thead>
                    <th>Nama Index</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="<?= base_url("/home/index-data/delegat-formasi/in-first-studies") ?>">Delegate for Formation</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?= base_url("/home/index-data/delegat-imam-muda/belum-tersiat") ?>">Delegate for On-going Formation</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
    <?= $footer ?>

    <script>
    </script>
</body>

</html>
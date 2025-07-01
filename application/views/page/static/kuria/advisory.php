<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-page.css"); ?>">
    <?= $css ?>
    <?= $js ?>
</head>

<body>
    <?= $navbar ?>
    <div class="container px-4 px-md-0">
        <div class="subnav d-flex justify-content-between">
            <a class="links <?= $activeNav == "kuria" ? "active" : "" ?>" href="<?= base_url("/home/index-data/kuria/kuria") ?>">Curia</a>
            <a class="links <?= $activeNav == "advisory" ? "active" : "" ?>" href="<?= base_url("/home/index-data/kuria/advisory") ?>">Province Advisory</a>
            <a class="links <?= $activeNav == "officials" ? "active" : "" ?>" href="<?= base_url("/home/index-data/kuria/officials") ?>">Province Officials</a>
            <a class="links <?= $activeNav == "commissions" ? "active" : "" ?>" href="<?= base_url("/home/index-data/kuria/commissions") ?>">Province Commissions</a>
            <a class="links <?= $activeNav == "fundation" ? "active" : "" ?>" href="<?= base_url("/home/index-data/kuria/fundation") ?>">Province Foundations</a>
        </div>
        <section>
            <h2 class="text-center mb-3">Province Advisory</h2>
            <div class="mt-5">
                <h5 class="mt-5">Monetary Board</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Hendra Sutedja, Johannes Adrianus</b></td>
                    </tr>
                    <tr>
                        <td>P Sarwanto, Agustinus</td>
                    </tr>
                    <tr>
                        <td>F Sunari, Yohannes Paulus</td>
                    </tr>
                    <tr>
                        <td>Mr. Bismarck Setia Budi Yatno</td>
                    </tr>
                </table>

                <h5 class="mt-5">Building and Construction Board</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Sugijopranoto, Andreas</b></td>
                    </tr>
                    <tr>
                        <td>P Gandhi Hartono, Thomas Becket</td>
                    </tr>
                </table>

                <h5 class="mt-5">Assets</h5>
                <table class="table table-striped">
                    <tr>
                        <td>Mr. One Jonny Purnomo, J.B.</td>
                    </tr>
                </table>

                <h5 class="mt-5">Legal</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Hartaja Toto Budyardja, Bonaventura</b></td>
                    </tr>
                    <tr>
                        <td>Ms. Liliana Arif Gondo Utomo</td>
                    </tr>
                </table>

            </div>
        </section>
    </div>
</body>

</html>
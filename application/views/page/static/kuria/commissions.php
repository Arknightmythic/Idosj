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
            <h2 class="text-center mb-3">Province Commissions</h2>
            <div class="mt-5">
                <h5 class="mt-5">Ministries</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Melkyor Pando</b></td>
                    </tr>
                    <tr>
                        <td>P Wetty, Benny Beatus </td>
                    </tr>
                    <tr>
                        <td>P Sarwanto, Agustinus</td>
                    </tr>
                    <tr>
                        <td>P Eko Sulistyo, Yulius</td>
                    </tr>
                    <tr>
                        <td>P Kuntoro Adi, Cyprianus</td>
                    </tr>
                    <tr>
                        <td>P Pieter Dolle, Fransiskus</td>
                    </tr>
                    <tr>
                        <td>P Setyodarmono, Agustinus</td>
                    </tr>
                </table>

                <h5 class="mt-5">Formation</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Eko Sulistyo, Yulius</b></td>
                    </tr>
                    <tr>
                        <td>P Kuntoro Adi, Cyprianus</td>
                    </tr>
                    <tr>
                        <td>P Edi Mulyono, Yusup</td>
                    </tr>
                    <tr>
                        <td>P Heru Prakosa, Yoannes Berchmans</td>
                    </tr>
                    <tr>
                        <td>P Priyo Poedjiono, Laurentius</td>
                    </tr>
                    <tr>
                        <td>P Setyo Wibowo, Agustinus</td>
                    </tr>
                    <tr>
                        <td>P Sunu Hardiyanta, Petrus</td>
                    </tr>
                </table>

                <h5 class="mt-5">Education</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Kuntoro Adi, Cyprianus</b></td>
                    </tr>
                    <tr>
                        <td>P Heru Hendarto, Joannes</td>
                    </tr>
                    <tr>
                        <td>P Sugijopranoto, Andreas</td>
                    </tr>
                    <tr>
                        <td>P Vico Christiawan, Antonius</td>
                    </tr>
                    <tr>
                        <td>Ms. Karlina Supelli</td>
                    </tr>
                    <tr>
                        <td>Mr. Ouda Teda Ena</td>
                    </tr>
                </table>

                <h5 class="mt-5">Church Ministry</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Wetty, Benny Beatus </b></td>
                    </tr>
                    <tr>
                        <td>P Didik Chahyono Widyatama, Eduardus</td>
                    </tr>
                    <tr>
                        <td>P Justin, Ernest</td>
                    </tr>
                    <tr>
                        <td>P Dedomau Djatmiko da Gomez, Franciscus Xaverius </td>
                    </tr>
                </table>

                <h5 class="mt-5">Societal Ministry</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Pieter Dolle, Fransiskus</b></td>
                    </tr>
                    <tr>
                        <td>P Sugiarta, Franciscus Assisi</td>
                    </tr>
                    <tr>
                        <td>P Devantara, Peter Benedicto</td>
                    </tr>
                    <tr>
                        <td>P Murti Hadi Wijayanto, Franciscus Xaverius</td>
                    </tr>
                </table>

                <h5 class="mt-5">Finance</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Sarwanto, Agustinus</b></td>
                    </tr>
                    <tr>
                        <td>P Hartaja Toto Budyardja, Bonaventura</td>
                    </tr>
                    <tr>
                        <td>P Sadhyoko Rahardjo, Albertus</td>
                    </tr>
                    <tr>
                        <td>P Edi Mulyono, Yusup</td>
                    </tr>
                    <tr>
                        <td>Mr. Bismarck Setia Budi Yatno</td>
                    </tr>
                </table>

            </div>
        </section>
    </div>
</body>

</html>
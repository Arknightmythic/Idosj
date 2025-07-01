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
            <h2 class="text-center mb-3">Province Curia</h2>
            <div class="mt-5">
                <h5 class="text-center"><b>RP BENEDICTUS HARI JULIAWAN</b></h5>
                <h5 class="text-center"><b>PROVINCIAL</b></h5>
                <h5 class="text-center">since 20 July 2020</h5>
                <h5 class="text-center"><a href="mailto:provincial@jesuits.id">provincial@jesuits.id</a></h5>

                <h5 class="mt-5">Provincial's OFFICE</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Melkyor Pando</b></td>
                        <td>Socius</td>
                        <td><a href="mailto:socius@jesuits.id">socius@jesuits.id</a></td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6285727149034"><img src="https://new.idosj.org/assets/images/logo-whatsapp.png" alt="whatsapp" width="32" height="32" style="vertical-align:top"></a></td>
                    </tr>
                    <tr>
                        <td>Mr. Wahyaka, Hermanus</td>
                        <td>Assistant</td>
                        <td><a href="mailto:sekretariat@jesuits.id">sekretariat@jesuits.id</a></td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281276419905"><img src="https://new.idosj.org/assets/images/logo-whatsapp.png" alt="whatsapp" width="32" height="32" style="vertical-align:top"></a></td>
                    </tr>
                    <tr>
                        <td><b>P Sigit Prasadja, Justinus</b></td>
                        <td>Treasurer</td>
                        <td><a href="mailto:treasurer@jesuits.id">treasurer@jesuits.id</a></td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281805849290"><img src="https://new.idosj.org/assets/images/logo-whatsapp.png" alt="whatsapp" width="32" height="32" style="vertical-align:top"></a></td>
                    </tr>
                    <tr>
                        <td>Ms. Asmiyati, Rosana</td>
                        <td>Assistant</td>
                        <td><a href="mailto:assistant.treasurer@jesuits.id">assistant.treasurer@jesuits.id</a></td>
                        <td><a href="whatsapp://send?text=Hello&phone=+628122815410"><img src="https://new.idosj.org/assets/images/logo-whatsapp.png" alt="whatsapp" width="32" height="32" style="vertical-align:top"></a></td>
                    </tr>

                </table>

                <h5 class="mt-5">Province Consultors</h5>
                <table class="table table-striped">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Whatsapp</th>
                        <th>Email</th>
                    </thead>
                    <tr>
                        <td>1</td>
                        <td>P Melkyor Pando</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281210885314">0857-2714-9034 </a></td>
                        <td><a href="mailto:socius@jesuits.id">socius@jesuits.id</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>P Sugijopranoto, Andreas</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+628112952465">0811 2952 465 </a></td>
                        <td><a href="mailto:andre@jesuits.id">andre@jesuits.id</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>P Kuntoro Adi, Cyprianus</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+62811282770">0811 282 770</a></td>
                        <td><a href="mailto:kuntoroadi@yahoo.com">kuntoroadi@yahoo.com</a></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>P Wartaya Winangun, Yohanes Wagiya</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281548595072">0815 4859 5072</a></td>
                        <td><a href="mailto:wartayasj@gmail.com">wartayasj@gmail.com</a></td>
                    </tr>

                </table>


            </div>
        </section>
    </div>
</body>

</html>
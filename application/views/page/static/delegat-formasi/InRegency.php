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
        <div class="subnav d-flex justify-content-between">
            <a class="links <?= $activeNav == "infirststudies" ? "active" : "" ?>"
                href="<?= base_url("/home/index-data/delegat-formasi/in-first-studies") ?>">In First Studies</a>
            <a class="links <?= $activeNav == "inregency" ? "active" : "" ?>"
                href="<?= base_url("/home/index-data/delegat-formasi/in-regency") ?>">In Regency</a>
            <a class="links <?= $activeNav == "intheology" ? "active" : "" ?>"
                href="<?= base_url("/home/index-data/delegat-formasi/in-theology") ?>">In Theology</a>
            <a class="links <?= $activeNav == "novice" ? "active" : "" ?>"
                href="<?= base_url("/home/index-data/delegat-formasi/novice") ?>">Novice</a>
        </div>
        <section>
            <h2 class="text-center mb-3">In Regency</h2>
            <div class="mt-5">
                <h5 class="mt-5">First Year</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Nama</th>
                        <th>Whatsapp</th>
                    </thead>
                    <tr>
                        <td>Satriyo Wibisono, Gregorius Agung</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281326434466">0813-2643-4466</a></td>
                    </tr>
                    <tr>
                        <td>Cavin, Ishak Jacues</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>David Kristianto, Nicolaus</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+62816653987">0816-6539-87</a></td>
                    </tr>
                    <tr>
                        <td>Frederick Ray Popo, Filipus</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+85595393163">+855-95-393163</a></td>
                    </tr>
                    <tr>
                        <td>Juliar Elmawan, Benicdiktus</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Lintang Yanviero, Arnold</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281282162562">0812-8216-2562</a></td>
                    </tr>
                    <tr>
                        <td>Rony Andriyanto, Laurencius</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6282112134450">0821-1213-4450</a></td>
                    </tr>
                    <tr>
                        <td>Wahyu Santosa, Antonius</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281311270099">0813-1127-0099</a></td>
                    </tr>
                    <tr>
                        <td>Sigit Adi Nugroho, Robertus</td>
                        <td></td>
                    </tr>
                </table>
                <h5 class="mt-5">Second Year</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Nama</th>
                        <th>Whatsapp</th>
                    </thead>
                    <tr>
                        <td>Barry Ekaputra, Alexander</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281282145210">0812-8214-5210</a></td>
                    </tr>
                    <tr>
                        <td>Kalis Jati Irawan, Roberthus</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281381736675">0813-8173-6675</a></td>
                    </tr>
                    <tr>
                        <td>Perkasa Tanjung, Leo</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281381735358">0813-8173-5358</a></td>
                    </tr>
                    <tr>
                        <td>Prajna Putra Mahardika, Amadea</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+628156644431">0815-6644-431</a></td>
                    </tr>
                </table>
                <h5 class="mt-5">Third Year</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Nama</th>
                        <th>Whatsapp</th>
                    </thead>
                    <tr>
                        <td>Agung Nugroho, Andreas</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281213974140">0812-1397-4140</a></td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</body>

</html>
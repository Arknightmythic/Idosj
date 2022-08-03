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
            <h2 class="text-center mb-3">In Theology</h2>
            <div class="mt-5">
                <h5 class="mt-5">First Year</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Nama</th>
                        <th>Whatsapp</th>
                    </thead>
                    <tr>
                        <td>Aditya Christie Manggala, Jakobus</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281520396171">0815-2039-6171</a></td>
                    </tr>
                    <tr>
                        <td>Bangkit Susetyo Adi Nugroho, Isidorus</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281520396175">0815-2039-6175</a></td>
                    </tr>
                    <tr>
                        <td>Septian Marhenanto, Antonius</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+639760768782">+63976-0768-782</a></td>
                    </tr>
                    <tr>
                        <td>Marendra Dananjaya, Joseph</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281272577688">0812-7257-7688</a></td>
                    </tr>
                </table>
                <h5 class="mt-5">Second Year</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Nama</th>
                        <th>Whatsapp</th>
                    </thead>
                    <tr>
                        <td>Aryono Mantiri, Andreas</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281284529548">0812-8452-9548</a></td>
                    </tr>
                    <tr>
                        <td>Bagas Prasetya Adi Nugraha, Antonius</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6285779852782">0857-7985-2782</a></td>
                    </tr>
                    <tr>
                        <td>Doni Erlangga Satriawan, Vincentius</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281381534105">0813-8153-4105</a></td>
                    </tr>
                    <tr>
                        <td>Daenuwy, Tiro Angelo</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281283060878">0812-8306-0878</a></td>
                    </tr>
                    <tr>
                        <td>Siwi Dharma Jati, Antonius</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6285877689195">0858-7768-9195</a></td>
                    </tr>
                </table>
                <h5 class="mt-5">Third Year</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Nama</th>
                        <th>Whatsapp</th>
                    </thead>
                    <tr>
                        <td>Daryanto, Agustinus</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6283890722172">0838-9072-2172</a></td>
                    </tr>
                    <tr>
                        <td>Hastra Kurdani, Paulus</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+34695899869">+34-6958-9986-9</a></td>
                    </tr>
                    <tr>
                        <td>Suroso, Yulius</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281332144875">0813-3214-4875</a></td>
                    </tr>
                </table>
                <h5 class="mt-5">Fourth Year</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Nama</th>
                        <th>Whatsapp</th>
                    </thead>
                    <tr>
                        <td>Deodatus, Yohanes</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6281381239355">0813-8123-9355</a></td>
                    </tr>
                    <tr>
                        <td>Harry Kristanto, Yohanes</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+6287799091678">0877-9909-1678</a></td>
                    </tr>
                    <tr>
                        <td>Wylly Suhendra, Fransiskus Asisi</td>
                        <td><a href="whatsapp://send?text=Hello&phone=+628561524610">0856-1524-610</a></td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</body>

</html>
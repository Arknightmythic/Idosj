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
            <h2 class="text-center mb-3">Novice</h2>
            <div class="mt-5">
                <h5 class="mt-5">First Year Novices - Entered 25 June 2021</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Whatsapp</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>Dio Ernanda Johandika, Ignatius</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Edo Susanto, Marcelino</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Elan Budi Santoso, Andreas</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Farrel Tedjokoesno, Stefanus Dominico</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Franky Njoto, Alfonsus Ignatius</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Herdian Pambudi, Laurentius</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Kevin Hary Hanggara, Christoforus</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Noven Pratama Putra, Aloysius</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Raditya Indriyatno, Adrianus</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Renato, Michael</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Satria Bagus Dwi Susanto, Agustinus</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Yuhan Felip Adhi Pradana, Iridious</td>
                        <td></td>
                    </tr>
                </table>
                <h5 class="mt-5">Second Year - Entered 22 June 2020</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Whatsapp</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>Alexander Tjahjadi, Michael</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Andreas Faja Febrianto Manalu, Agustinus</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Deo Yudistiro, Yohanes</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Erasmus Arga, Feliks</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Holy Septianno, Beda</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Guntur Supradana, Petrus</td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</body>

</html>
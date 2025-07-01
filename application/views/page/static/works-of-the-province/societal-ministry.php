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
            <a class="links <?= $activeNav == "church-ministry" ? "active" : "" ?>" href="<?= base_url("/home/index-data/works-of-the-province/church-ministry") ?>">Church Ministry</a>
            <a class="links <?= $activeNav == "Education" ? "active" : "" ?>" href="<?= base_url("/home/index-data/works-of-the-province/Education") ?>">Education</a>
            <a class="links <?= $activeNav == "societal-ministry" ? "active" : "" ?>" href="<?= base_url("/home/index-data/works-of-the-province/societal-ministry") ?>">Societal Ministry</a>
            <a class="links <?= $activeNav == "spirituality" ? "active" : "" ?>" href="<?= base_url("/home/index-data/works-of-the-province/spirituality") ?>">Spirituality</a>
        </div>
        <section>
            <h2 class="text-center mb-3">Works of the Province</h2>
            <table class="table mt-5">
                <tr>
                    <td><b>Lembaga Daya Dharma </b></td>
                </tr>
                <tr>
                    <td>Jalan Gereja Katedral 5, Jakarta 10710 - Tel +62 21-350 0431, 831 3307, 344 0172 & 345 4159 </td>
                </tr>
                <tr>
                    <td>
                        <a href="http://lddkaj.or.id//">lddkaj.or.id</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>KPTT Salatiga </b></td>
                </tr>
                <tr>
                    <td>Jalan Mayangsari 2, Salatiga 50724 </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://www.instagram.com/kpttsalatiga/">@kpttsalatiga</a>
                    </td>
                </tr>

            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>Jesuit Refugee Service Indonesia </b></td>
                </tr>
                <tr>
                    <td>Gang Cabe DP III/9 DN 13, RT 01/RW 39 Puren, Pringwulung, Condongcatur, Depok, Sleman, Yogyakarta 55283 </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://jrs.or.id/">jrs.or.id</a>
                    </td>
                </tr>

            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>Seksi Pengabdian Masyarakat Realino </b></td>
                </tr>
                <tr>
                    <td>Jalan Mataram 66 Yogyakarta 55213 Tel. +62 274-566 610 </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://realino.or.id/">realino.or.id</a>
                    </td>
                </tr>

            </table>






    </div>
    </section>
    </div>
</body>

</html>
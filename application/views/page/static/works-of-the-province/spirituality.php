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
                    <td><b>Rumah Retret Panti Semedi, Sangkalputung </b></td>
                </tr>
                <tr>
                    <td>
                        <a href="http://www.pantisemedi.com/">www.pantisemedi.com</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>Pusat Spiritualitas Awam (Kelompok Sahabat Yesus) </b></td>
                </tr>
                <tr>
                    <td>
                        <a href="http://www.pantisemedi.com/">www.pantisemedi.com</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>Sahabat Ignatian </b></td>
                </tr>
                <tr>
                    <td>P Setyodarmono, Agustinus, Formator <a href="whatsapp://send?text=Hello&phone=+6281328046170">(0813 2804 6170)</a></td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>MAGIS Indonesia </b></td>
                </tr>
                <tr>
                    <td>P Alexander Koko Siswijayanto, Moderator <a href="whatsapp://send?text=Hello&phone=+6281389671666">(0813 8967 1666)</a></td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>Seminari Tinggi Interdiosesan San Giovanni XXIII </b></td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>Seminari Tinggi St. Petrus, Pematangsiantar </b></td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>Rumah Retret Kristus Raja </b></td>
                </tr>
                <tr>
                    <td>
                        <a href="https://rumahretretgirisonta.org/">rumahretretgirisonta.org</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>Kerasulan Doa </b></td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>Seminari Tinggi St. Paulus Kentungan </b></td>
                </tr>
            </table>
    </div>
    </section>
    </div>
</body>

</html>
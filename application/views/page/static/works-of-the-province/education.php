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
                    <td><b>1. ATMI Cikarang </b></td>
                </tr>
                <tr>
                    <td>Jababeka Education Park, Jalan Kampus Hijau 3, Cikarang Baru, Bekasi 17520. Tel. +62 21-8910 6780, 8910 6413 </td>
                </tr>
                <tr>
                    <td>
                        <a href="mailto:richardus.paul@polinatmi.ac.id">Email: richardus.paul@polinatmi.ac.id</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="https:https://www.atmicikarang.ac.id/">www.atmicikarang.ac.id</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>2. Perkumpulan Strada </b></td>
                </tr>
                <tr>
                    <td>Jalan Gunung Sahari 88, Jakarta 10610. Tel. +62 21-420 4921, 425 7572</td>
                </tr>
                <tr>
                    <td>
                        <a href="https://perkumpulanstrada.education/">perkumpulanstrada.education</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>3. Sekolah Tinggi Filsafat Driyarkara </b></td>
                </tr>
                <tr>
                    <td>Jalan Cempaka Putih Indah 100 A, Jakarta 10520. Tel +62 21-4247129</td>
                </tr>
                <tr>
                    <td>
                        <a href="mailto:info@driyarkara.ac.id">Email: info@driyarkara.ac.id</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://www.driyarkara.ac.id/">www.driyarkara.ac.id</a>
                    </td>
                </tr>
            </table>


            <table class="table mt-5">
                <tr>
                    <td><b>4. SMA Gonzaga</b></td>
                </tr>
                <tr>
                    <td>Jalan Pejaten Barat 10A, Jakarta 12550. Tel. +62 21-7804 986, 780 4996</td>
                </tr>
                <tr>
                <tr>
                    <td>
                        <a href="https://www.gonzaga.sch.id/">www.gonzaga.sch.id</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>5. SMP Kolese Kanisius</b></td>
                </tr>
                <tr>
                    <td>Jalan Menteng Raya 64, Jakarta 10340. Tel. +62 21-3193 6464</td>
                </tr>
                <tr>
                    <td>
                        <a href="https://www.kanisius.edu/">www.kanisius.edu</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>6. SMA Kolese Kanisius </b></td>
                </tr>
                <tr>
                    <td>Jalan Menteng Raya 64, Jakarta 10340. Tel. +62 21-3193 6464</td>
                </tr>
                <tr>
                    <td>
                        <a href="https://www.kanisius.edu/">www.kanisius.edu</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>7. SMA Seminari St. Petrus Kanisius, Mertoyudan </b></td>
                </tr>
                <tr>
                    <td>Jalan Mayjend Bambang Soegeng, Mertoyudan, Magelang 56101. Tel. +62 293-326 718 </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://seminarimertoyudan.sch.id/">seminarimertoyudan.sch.id</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>8. SMA YPPK Adhi Luhur </b></td>
                </tr>
                <tr>
                    <td>Jalan Merdeka Nabire 98815</td>
                </tr>
                <tr>
                    <td>
                        <a href="sma.yppk.adhiluhur@gmail.com">Email: sma.yppk.adhiluhur@gmail.com</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="http://sma-adhi-luhur.sch.id/">sma-adhi-luhur.sch.id</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>9. SMK PIKA </b></td>
                </tr>
                <tr>
                    <td>Jalan Imam Bonjol 96, Semarang 50139. Tel. +62 24-354 6460</td>
                </tr>
                <tr>
                    <td>
                        <a href="smkpika@pika-semarang.com">Email: smkpika@pika-semarang.com</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://smkpika.sch.id/">smkpika.sch.id</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>10. SMA Kolese Loyola </b></td>
                </tr>
                <tr>
                    <td>Jalan Karanganyar 37, Semarang 50135. Tel. +62 24-354 6945, 354 8431</td>
                </tr>
                <tr>
                <tr>
                    <td>
                        <a href="https://www.loyola-smg.sch.id/">www.loyola-smg.sch.id</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>11. SMK St. Mikael </b></td>
                </tr>
                <tr>
                    <td>Jalan Mojo 1, Surakarta 57145. Tel. +62 271-712 728</td>
                </tr>
                <tr>
                    <td>
                        <a href="info@smkmikael.sch.id">Email: info@smkmikael.sch.id</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://smkmikael.sch.id/">smkmikael.sch.id</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>12. Politeknik ATMI Surakarta </b></td>
                </tr>
                <tr>
                    <td>Jalan Mojo 1, Surakarta 57145. Tel. +62 271-712 728</td>
                </tr>
                <tr>
                    <td>
                        <a href="politeknik@atmi.ac.id">Email: politeknik@atmi.ac.id</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://www.atmi.ac.id/">www.atmi.ac.id</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>13. SMA Kolese de Britto </b></td>
                </tr>
                <tr>
                    <td>Jalan Laksda Adisucipto 161, Yogyakarta 55281</td>
                </tr>
                <tr>
                    <td>
                        <a href="https://debritto.sch.id/">debritto.sch.id</a>
                    </td>
                </tr>
            </table>

            <table class="table mt-5">
                <tr>
                    <td><b>14. Universitas Sanata Dharma </b></td>
                </tr>
                <tr>
                    <td>
                        <a href="https://www.usd.ac.id/">www.usd.ac.id</a>
                    </td>
                </tr>
            </table>




    </div>
    </section>
    </div>
</body>

</html>
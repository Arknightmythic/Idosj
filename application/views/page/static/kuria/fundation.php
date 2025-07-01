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
            <h2 class="text-center mb-3">Province Fundations</h2>
            <div class="mt-5">
                <h5 class="mt-5">Perkumpulan Aloysius</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P. Benedictus Hari Juliawan, S.J. </b></td>
                        <td>Ketua Pengurus</td>
                    </tr>
                    <tr>
                        <td>P Sigit Prasadja, Justinus, S.J.</td>
                        <td>Bendahara Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. Bambang Alfred Sipayung, S.J. </td>
                        <td>Sekretaris Pengurus </td>
                    <tr>
                        <td>P. Kuntoro Adi, S.J. </td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. Wartaya Winangun, S.J.</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. Andreas Sugijopranoto, S.J. </td>
                        <td>Ketua Pengawas</td>
                    </tr>
                    <tr>
                        <td>P. Edi Mulyono, S.J.</td>
                        <td>Anggota Pengawas</td>
                    </tr>

                </table>

                <h5 class="mt-5">Yayasan Kanisius Pendidikan Semarang</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P. Heru Hendarto, S.J</b></td>
                        <td>Ketua Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. Aria Dewanto, S.J.</td>
                        <td>Bendahara Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. Thomas Surya Awangga Budiono, S.J.</td>
                        <td>Sekretaris Pengurus </td>
                    <tr>
                        <td>P. Sjamsul Wanandi, S.J.</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. Istanto, S.J.</td>
                        <td>Ketua Pengawas</td>
                    </tr>
                    <tr>
                        <td>P. Hartana, S.J.</td>
                        <td>Anggota Pengawas</td>
                    </tr>
                </table>

                <h5 class="mt-5">Yayasan Budi Siswa</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P. Leonardus Evert Bambang Winandoko, S.J.</b></td>
                        <td>Ketua Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. J.A. Hendra Sutedja, S.J</td>
                        <td>Bendahara Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. T.B. Gandhi Hartono, S.J.</td>
                        <td>Sekretaris Pengurus </td>
                    <tr>
                        <td>P. Agus Sriyono, S.J.</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. Justinus Sudarminta, S.J.</td>
                        <td>Ketua Pengawas</td>
                    </tr>
                    <tr>
                        <td>P. Benedictus Hari Juliawan, S.J.</td>
                        <td>Ketua Pembina</td>
                    </tr>
                </table>

                <h5 class="mt-5">Yayasan Karya ATMI, Cikarang</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P. Yakobus Rudiyanto, S.J.</b></td>
                        <td>Ketua Pengurus</td>
                    </tr>
                    <tr>
                        <td>Bapak Tommy Aritanto</td>
                        <td>Bendahara Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. Daniswara, S.J.</td>
                        <td>Sekretaris Pengurus </td>
                    <tr>
                        <td>Bapak Johan Tamzil</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>Bapak Markus Marturo</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>Ibu Elizabeth Anggraini Wihardja</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>Ibu Imelda</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. Benedictus Hari Juliawan, S.J.</td>
                        <td>Pembina</td>
                    </tr>
                    <tr>
                        <td>Bapak Sri Martono</td>
                        <td>Pengawas</td>
                    </tr>

                </table>
                <h5 class="mt-5">Yayasan Sanata Dharma</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P. Albertus Budi Susanto, S.J., Ph.D.</b></td>
                        <td>Ketua Pengurus</td>
                    </tr>
                    <tr>
                        <td>Pater Albertus Hartana, S.J.</td>
                        <td>Bendahara Pengurus</td>
                    </tr>
                    <tr>
                        <td>Prof. Dr. R.A. Supriyono, S.U., Akt.</td>
                        <td>Sekretaris Umum </td>
                    <tr>
                    <tr>
                        <td>Drs. Aloysius Triwanggono, M.S. </td>
                        <td>Sekretaris</td>
                    <tr>
                        <td>Prof. Dr. Ir. Henricus Priyosulistyo, M.Sc.</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>Prof. Agustinus Supriyanto, S.H., M.S.</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>Dr. Bernadette Josephine Istiti Kandarin</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>Pater Dr. Johannes Haryatmoko, S.J.</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. Agustinus Priyono Marwan, S.J.</td>
                        <td>Ketua Badan Pembina </td>
                    </tr>
                    <tr>
                        <td>P. Dr. Benedictus Hari Juliawan, S.J. </td>
                        <td>Anggota Badan Pembina</td>
                    </tr>
                    <tr>
                        <td>P. Petrus Sunu Hardiyanta, S.J.</td>
                        <td>Anggota Badan Pembina </td>
                    </tr>
                    <tr>
                        <td>P. Andreas Sugijopranoto, S.J.</td>
                        <td>Ketua Badan Pengawas</td>
                    </tr>
                    <tr>
                        <td>P. Justinus Sigit Prasadja, S.J.</td>
                        <td>Anggota Badan Pengawas</td>
                    </tr>

                </table>

                <h5 class="mt-5">Yayasan Loyola</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P. Moerti Yoedho, S.J. </b></td>
                        <td>Ketua Pengurus</td>
                    </tr>
                    <tr>
                        <td>Bapak Bahari Nusantara </td>
                        <td>Bendahara I</td>
                    </tr>
                    <tr>
                        <td>P. Cahyo Christanto, S.J. </td>
                        <td>Bendahara II</td>
                    </tr>
                    <tr>
                        <td>Ibu Patworo Priharsanti </td>
                        <td>Sekretaris Pengurus </td>
                    <tr>
                        <td>P. Maryana, S.J.</td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>Bapak Suryatin </td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>Ibu Angelique </td>
                        <td>Anggota Pengurus</td>
                    </tr>
                    <tr>
                        <td>P. Priyo Poedjiono, S.J. </td>
                        <td>Ketua Pembina </td>
                    </tr>
                    <tr>
                        <td>P. Sunu Hardiyanta, S.J. </td>
                        <td>Anggota Pembina </td>
                    </tr>
                    <tr>
                        <td>P. Wiryono, S.J. </td>
                        <td>Ketua Pengawas </td>
                    </tr>
                    <tr>
                        <td>P. Agus Sriyono, S.J.</td>
                        <td>Anggota Pengawas </td>
                    </tr>

                </table>


            </div>
        </section>
    </div>
</body>

</html>
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
            <h2 class="text-center mb-3">Province Officials</h2>
            <div class="mt-5">
                <h5 class="mt-5">Lay Formator of Sahabat Ignatius Community</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Setyodarmono, Agustinus</b></td>
                    </tr>
                </table>

                <h5 class="mt-5">Archivist</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Windar Santoso, Ignatius</b></td>
                    </tr>
                    <tr>
                        <td>P Clay Pareira, Josephus Benedictus</td>
                    </tr>
                </table>

                <h5 class="mt-5">Assistant for Formation</h5>
                <table class="table table-striped">
                    <tr>
                        <td>P Eko Sulistyo, Yulius, Delegate for Formation</td>
                    </tr>
                    <tr>
                        <td>P Edi Mulyono, Yusup, Delegate for On-going Formation</td>
                    </tr>
                    <tr>
                        <td>P Heru Prakosa, Yoannes Berchmans, Coordinator of Special Studies Commission</td>
                    </tr>
                    <tr>
                        <td>P Priyo Poedjiono, Laurentius, Coordinator of On-going Formation Program</td>
                    </tr>
                </table>

                <h5 class="mt-5">VOCATION PROMOTION</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Gandi Hartana, Thomas Becket, Coordinator</b></td>
                    </tr>
                    <tr>
                        <td><b>Jakarta</b></td>
                    </tr>
                    <tr>
                        <td>P Satya Wening Pambudi, Henricus</td>
                    </tr>
                    <tr>
                        <td>P Hastra Kurdani, Paulus</td>
                    </tr>
                    <tr>
                        <td><b>Yogyakarta and Central Java</b></td>
                    </tr>
                    <tr>
                        <td>P Ardi Jatmiko, Alfonsus</td>
                    </tr>
                    <tr>
                        <td>P Pieter Dolle, Fransiskus</td>
                    </tr>
                    <tr>
                        <td><b>Vocation Promotion for Brothers</b></td>
                    </tr>
                    <tr>
                        <td>F Marsono, Franciscus Xaverius</td>
                    </tr>
                    <tr>
                        <td>F Dieng Karnedi, Antonius</td>
                    </tr>
                </table>

                <h5 class="mt-5">DEVELOPMENT OFFICE DELEGATE</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Effendi Kusuma Sunur, Ferdinandus</b></td>
                    </tr>
                    <tr>
                        <td>P Windar Santoso, Ignatius</td>
                    </tr>
                </table>

                <h5 class="mt-5">EDUCATION DELEGATE</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Baskoro Poedjinoegroho, Emanuel, Delegate</b></td>
                    </tr>
                    <tr>
                        <td>P Kuntoro Adi, Cyprianus, Assistant</td>
                    </tr>
                </table>

                <h5 class="mt-5">ANIMATOR OF INTELLECTUAL APOSTOLATE AND RESEARCH</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Bagus Laksana, Albertus, Animator</b></td>
                    </tr>
                    <tr>
                        <td>P Eko Budi Santoso, Agustinus, Assistant</td>
                    </tr>
                </table>

                <h5 class="mt-5">MAGIS</h5>
                <table class="table table-striped">
                    <tr>
                        <td>P Koko Siswijayanto, Alexander, National Moderator of MAGIS</td>
                    </tr>
                </table>

                <h5 class="mt-5">POPE’S WORLDWIDE NETWORK OF PRAYER</h5>
                <table class="table table-striped">
                    <tr>
                        <td>P Sumarwan, Antonius, National Secretary of the Apostleship of Prayer/Pope’s Worldwide Network of Prayer </td>
                    </tr>
                </table>

                <h5 class="mt-5">REVISOR DOMORUM</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>F Sunari, Yohannes Paulus, Revisor of Houses and of Apostolates</b></td>
                    </tr>
                    <tr>
                        <td>P Mathando Hinganaday, Rafael, Assistant</td>
                    </tr>
                </table>

                <h5 class="mt-5">REVISOR OF PROVINCE FINANCIAL ADMINISTRATION </h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Aria Dewanto, Ignasius</b></td>
                    </tr>
                </table>

                <h5 class="mt-5">PROVINCE COMMUNICATORS</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Satya Wening Pambudi, Hendricus</b></td>
                    </tr>
                    <tr>
                        <td>P Dwi Kristanto, Heribertus</td>
                    </tr>
                    <tr>
                        <td>S Septian Marhenanto, Antonius</td>
                    </tr>
                    <tr>
                        <td>Ms Revita Susanti, Margareta</td>
                    </tr>
                </table>

                <h5 class="mt-5">SAFEGUARDING TEAM</h5>
                <table class="table table-striped">
                    <tr>
                        <td><b>P Eko Sulistyo, Yulius, Delegate & Advisor</b></td>
                    </tr>
                    <tr>
                        <td>P Bambang Irawan, Paulus, Secretary</td>
                    </tr>
                    <tr>
                        <td>P Justin, Ernest</td>
                    </tr>
                    <tr>
                        <td>P Sudarminta, Justinus</td>
                    </tr>
                    <tr>
                        <td>P Rudiyanto, Yakobus</td>
                    </tr>
                    <tr>
                        <td>Mr. R. Sigit Widiarto, S.H., L.L.M</td>
                    </tr>
                    <tr>
                        <td>Ms. Yustina Rostiawati, M.Hum</td>
                    </tr>
                    <tr>
                        <td>Ms. Hotmauli Sidabalok, S.H, C.N., M.H</td>
                    </tr>
                    <tr>
                        <td>Ms. Dr. Titik Kristiyani, M.Psi.</td>
                    </tr>
                    <tr>
                        <td>Ms. Antonia Iswanti</td>
                    </tr>
                </table>

            </div>
        </section>
    </div>
</body>

</html>
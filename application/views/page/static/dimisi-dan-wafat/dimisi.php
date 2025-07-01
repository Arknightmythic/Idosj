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
            <a class="links <?= $activeNav == "dimisi" ? "active" : "" ?>" href="<?= base_url("/home/index-data/dimisi-dan-wafat/dimisi") ?>">Dimissi</a>
            <a class="links <?= $activeNav == "deceased" ? "active" : "" ?>" href="<?= base_url("/home/index-data/dimisi-dan-wafat/deceased") ?>">Deceased</a>
        </div>
        <section>
            <h2 class="text-center mb-3">Dimissi</h2>
            <div class="mt-5">
                <h5 class="mt-5">2022</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Nama</th>

                    </thead>
                    <tr>
                        <td><b>nS Soni Arya Wibisono, Henricus,</b> 5 January 2021</td>
                    </tr>
                    <tr>
                        <td><b>nS Koresy, Samuel,</b> 20 December 2021</td>
                    </tr>
                    <tr>
                        <td><b>nS Videl Hasian Manik, Bonaventura,</b> 25 December 2021</td>
                    </tr>

                </table>
                <h5 class="mt-5">2023</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Nama</th>

                    </thead>
                    <tr>
                        <td><b>nS Renato, Michael, </b>26 February 2022</td>
                    </tr>
                    <tr>
                        <td><b>nS Elang Bangun Wibowo, Emmanuel,</b> 2 July 2022</td>

                    </tr>
                    <tr>
                        <td> <b>S Wangsa Mulya, Mickael, </b>27 August 2022</td>

                    </tr>
                    <tr>
                        <td><b>nS Noven Pratama Putra, Aloysius,</b> 2 December 2022</td>

                    </tr>
                    <tr>
                        <td><b>P In Nugroho Budisantoso, Robertus,</b> 23 December 2022</td>

                    </tr>
                    <tr>
                        <td><b>S Lanang Panji Cahyo, Agustinus,</b> 3 January 2023</td>

                    </tr>
                    <tr>
                        <td><b>S Alexander Tjahjadi, Michael</b> Expecting Dismmisal </td>

                    </tr>
                    <tr>
                        <td><b>S Marendra Dananjaya, Joseph </b> Expecting Dismmisal </td>

                    </tr>

            </div>
        </section>
    </div>
</body>

</html>
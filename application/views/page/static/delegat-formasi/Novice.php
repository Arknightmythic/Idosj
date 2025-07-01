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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .justify {
            text-align: justify;
        }
    </style>
</head>

<body>
    <?= $navbar ?>
    <div class="container px-4 px-md-0">
        <div class="subnav d-flex justify-content-between">
            <a class="links <?= $activeNav == "infirststudies" ? "active" : "" ?>" href="<?= base_url("/home/index-data/delegat-formasi/in-first-studies") ?>">In First Cycle</a>
            <a class="links <?= $activeNav == "inregency" ? "active" : "" ?>" href="<?= base_url("/home/index-data/delegat-formasi/in-regency") ?>">In Regency</a>
            <a class="links <?= $activeNav == "intheology" ? "active" : "" ?>" href="<?= base_url("/home/index-data/delegat-formasi/in-theology") ?>">In Second Cycle</a>
            <a class="links <?= $activeNav == "novice" ? "active" : "" ?>" href="<?= base_url("/home/index-data/delegat-formasi/novice") ?>">Novice</a>
        </div>
        <section>
            <h2 class="text-center mb-3">Novice</h2>
            <h4 class="mt-5 text-center"><b>First Year Novices - Entered 24 June 2024</b></h4>
            <div class="mt-5">
                <div class="row center">
                    <div class="col-sm-4" style="background-color:#f2f3f4;">
                        <figure>
                            <img src="/uploads/profile/Profile_IDO20241.jpg" alt="" style="width:40%">
                            <figcaption>nS Amadeus Effendi, <b>Karel</b></figcaption>
                        </figure>
                    </div>
                    <div class="col-sm-4">
                        <figure>
                            <img src="/uploads/profile/Profile_IDO20242.jpg" alt="" style="width:40%">
                            <figcaption>nS Gading <b>Winu</b>graha, John Fisher</figcaption>
                        </figure>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f3f4;">
                        <figure>
                            <img src="/uploads/profile/Profile_IDO20244.jpg" alt="" style="width:40%">
                            <figcaption>nS Halford Triatmaja, Realino</figcaption>
                        </figure>
                    </div>
                </div>
                <br>
                <div class="row center">
                    <div class="col-sm-4 " style="background-color:white;">
                        <figure>
                            <img src="/uploads/profile/Profile_IDO20246.jpg" alt="" style="width:40%">
                            <figcaption>nS Iga Pradipta, Arnoldus</figcaption>
                        </figure>
                    </div>
                    <div class="col-sm-4" style="background-color:#f2f3f4;">
                        <figure>
                            <img src="/uploads/profile/Profile_IDO20248.jpg" alt="" style="width:40%">
                            <figcaption>nS Egwin Gawe, Antonius Vinsensius</figcaption>
                        </figure>
                    </div>
                    <div class="col-sm-4" style="background-color:white;">
                        <figure>
                            <img src="/uploads/profile/Profile_IDO202410.jpg" alt="" style="width:40%">
                            <figcaption>nS Mas Aletadeo Satya Pramuda, Efrem</figcaption>
                        </figure>
                    </div>
                </div>
                <br>


                <h4 class="mt-5 text-center"><b>Second Year Novices - Entered 20 June 2023</b></h4>
                <div class="mt-5">
                    <div class="row center">
                        <div class="col-sm-4" style="background-color:#f2f3f4;">
                            <figure>
                                <img src="/uploads/profile/Profile_IDO20231.jpg" alt="" style="width:40%">
                                <figcaption>nS Amaris Liaupati, Leonardo</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-4">
                            <figure>
                                <img src="/uploads/profile/Profile_IDO202310.jpg" alt="" style="width:40%">
                                <figcaption>nS Religio Perangin Angin, Valentinus</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f3f4;">
                            <figure>
                                <img src="/uploads/profile/Profile_IDO202312.jpg" alt="" style="width:40%">
                                <figcaption>nS Setyo, Archie</figcaption>
                            </figure>
                        </div>
                    </div>
                    <br>
                    <div class="row center">
                        <div class="col-sm-4 " style="background-color:white;">
                            <figure>
                                <img src="/uploads/profile/Profile_IDO202313.jpg" alt="" style="width:40%">
                                <figcaption>nS Valentino Ngandiri, Leonard</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f3f4;">
                            <figure>
                                <img src="/uploads/profile/Profile_IDO20226.jpg" alt="" style="width:40%">
                                <figcaption>nS Evan Adhi Laksana, Aloysius Gonzaga</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-4" style="background-color:white;">
                            <figure>
                                <img src="/uploads/profile/Profile_IDO20232.jpg" alt="" style="width:40%">
                                <figcaption>nS Damar Adi Wicaksana, Ignatius</figcaption>
                            </figure>
                        </div>
                    </div>
                    <br>
                    <div class="row center">
                        <div class="col-sm-4" style="background-color:#f2f3f4;">
                            <figure>
                                <img src="/uploads/profile/Profile_IDO20235.jpg" alt="" style="width:40%">
                                <figcaption>nS Dwi Prawiro Leton, Alfa Almakios</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-4">
                            <figure>
                                <img src="/uploads/profile/Profile_IDO20236.jpg" alt="" style="width:40%">
                                <figcaption>nS Hosea Santoso, Albert</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-4" style="background-color:#f2f3f4;">
                            <figure>
                                <img src="/uploads/profile/Profile_IDO20237.jpg" alt="" style="width:40%">
                                <figcaption>nS Iuliano Mesaroga. Christoforus</figcaption>
                            </figure>
                        </div>
                    </div>
                    <br>
                    <div class="row center">
                        <div class="col-sm-4 " style="background-color:white;">

                        </div>
                        <div class="col-sm-4" style="background-color:#f2f3f4;">
                            <figure>
                                <img src="/uploads/profile/Profile_IDO20238.jpg" alt="" style="width:40%">
                                <figcaption>nS Ragil Sumantri Purna Bahari, Yohanes</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-4" style="background-color:white;">

                        </div>
                    </div>
                </div>



            </div>
        </section>
    </div>
</body>

</html>
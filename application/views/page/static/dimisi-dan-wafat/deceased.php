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
            <h2 class="text-center mb-3">Deceased</h2>
            <div class="mt-5">
                <h5 class="mt-5">2022</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Kenangan Penuh Kasih</th>

                    </thead>
                    <tr>
                        <td><b>P Wolf, Karl Theodor,</b> died 17 January 2021 at Ken Saras Hospital, Ungaran; born 4 January 1945; entered the Society 14 September 1965; ordained into priesthood 3 December 1975; professed of four vows 28 May 1986</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>P Yuniko Poerdianto, Andreas,</b> died 29 July 2021 at St. Elisabeth Hospital, Semarang; born 22 June 1968; entered the Society 1 July 2000; ordained into priesthood 25 July 2013</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>F Triyono, Yustinus,</b> died 25 October 2021 at Panti Rapih Hospital, Yogyakarta; born 21 December 1965; entered the Society 7 July 1987, formed brother 2 February 2016 </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>P Smit, Leonard,</b> died 29 January 2022 at Emmaus Infirmary of Kolese Stanislaus; born 30 May 1941; entered the Society 7 September 1962; ordained into priesthood 8 December 1973; professed of four vows 2 February 1981</td>
                        <td></td>
                    </tr>

                </table>
                <h5 class="mt-5">2023</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Kenangan Penuh Kasih</th>

                    </thead>
                    <tr>
                        <td><b>P Sutanto, Antonius,</b> died 1 March 2022 at St. Elisabeth Hospital, Semarang; born 23 August 1938; entered the Society 7 September 1959; ordained into priesthood 6 December 1971; professed of four vows 29 August 1982</td>

                    </tr>
                    <tr>
                        <td><b>P Hary Susanto, Petrus Stephanus, </b>died 9 September 2022 at Wisma Emmaus, Semarang; born 25 October 1954; entered the Society 31 January 1975; ordained into priesthood 21 July 1988; spiritual coadjutor 31 July 2005</td>

                    </tr>
                    <tr>
                        <td><b>P Prapta Diharja, Joannes Salib Suci,</b> died 12 September 2022 at Panti Rapih Hospital, Yogyakarta; born 23 November 1952; entered the Society 31 Decembe 1973; ordained into priesthood 21 July 1988; spiritual coadjutor 2 February 1995</td>

                    </tr>
                    <tr>
                        <td></td>

                    </tr>

            </div>
        </section>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-submenu.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-page.css"); ?>">
    <?= $css?>
    <?= $js?>
</head>

<body>
    <?= $navbar?>
    <div class="container px-4 px-md-0">
        <?= $submenu ?>

        <!-- Section of Perjalanan -->
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Perjalanan</h3>
                <a href="<?= base_url("formkuning") ?>" class="btn btn-warning" style="height: max-content">Ajukan Form
                    Kuning</a>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>Sponsor, Tempat</th>
                        <th>Waktu</th>
                        <th>Keperluan</th>
                        <th>Dokumen</th>
                    </thead>
                    <tbody>
                        <?php foreach($dataPerjalanan as $data): 
                        $status = 0;
                        if($data->statusProvinsial){
                            $status = 2;
                        } else if($data->statusSuperior){
                            $status = 1;
                        }
                    ?>
                        <tr>
                            <td><?= $data->q7.", ".$data->q3 ?></td>
                            <td>
                                <?= date_format(date_create($data->q1), "d/m/y")." - ".date_format(date_create($data->q2), "d/m/y") ?>
                            </td>
                            <td><?= $data->q4 ?></td>
                            <td>
                                <?php
                                if($this->session->role == "Administrator"){
                                    if($status == 0){
                                        echo "<span class='hi-block'>Menunggu persetujuan Superior</span>";
                                    } else if($status == 1){
                                        echo "
                                            <form action='".base_url("formkuning/approval")."' method='POST'>
                                                <input name='approvalProvinsial' value='true' hidden />
                                                <input name='idAnggota' value='".$dataPribadi->id."' hidden />
                                                <button class='btn btn-warning'><i class='fa fa-file-lines'></i></button>
                                            </form>
                                        ";
                                    } else if($status == 2){
                                        echo "<button class='btn btn-primary'><i class='fa fa-file-lines'></i></button>";
                                    }
                                } else if($this->session->role == "Superior"){
                                    if($status == 0){
                                        echo "
                                        <form action='".base_url("formkuning/approval")."' method='POST'>
                                            <input name='approvalSuperior' value='true' hidden />
                                            <input name='idAnggota' value='".$dataPribadi->id."' hidden />
                                            <button class='btn btn-warning'><i class='fa fa-file-lines'></i></button>
                                        </form>";
                                    } else if($status == 1){
                                        echo "<span class='hi-block'>Menunggu persetujuan Pater Provinsial</span>";
                                    } else if($status == 2){
                                        echo "<button class='btn btn-primary'><i class='fa fa-file-lines'></i></button>";
                                    }
                                } else {
                                    if($status == 0){
                                        echo "<span class='hi-block'>Menunggu persetujuan Superior</span>";
                                    } else if($status == 1){
                                        echo "<span class='hi-block'>Menunggu persetujuan Pater Provinsial</span>";
                                    } else if($status == 2){
                                        echo "<button class='btn btn-primary'><i class='fa fa-file-lines'></i></button>";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <?= $footer ?>

</body>

</html>
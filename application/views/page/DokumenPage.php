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
    <style>
table, th, td {
  border:1px solid black;
}
</style>
</head>

<body>
    <?= $navbar?>
    <div class="container px-4 px-md-0">
        <?= $submenu ?>
        
        
        

        <!-- Section of Perjalanan -->
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Catalog</h3>
            </div>
            <div class="d-md-block d-flex flex-column gap-2">
                <a href="<?= base_url("/home/statistik") ?>" class="btn text-white"
                    style="background-color: var(--ihs-red);">Statistics</a>
                <a href="<?= base_url("/home/index-data/kuria/kuria") ?>" class="btn text-white"
                    style="background-color: var(--ihs-red);">Curia</a>
                <a href="<?= base_url("/home/komunitas") ?>" class="btn text-white" 
                style="background-color: var(--ihs-red);">List of Community</a>
                
                
                <a href="<?= base_url("/home/index-data/delegat-formasi/in-first-studies") ?>" class="btn text-white"
                    style="background-color: var(--ihs-red);">in Formation</a>
                <a href="<?= base_url("/home/index-data/delegat-imam-muda/belum-tersiat") ?>" class="btn text-white"
                    style="background-color: var(--ihs-red);">on Going Formation</a>
                <a href="<?= base_url("/home/index-data/dimisi-dan-wafat/dimisi") ?>" class="btn text-white"
                    style="background-color: var(--ihs-red);">Dismissals and Deceases</a>
                
            </div>
            
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Document in the Province</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>List of Document</th>
                    </thead>
                    <tbody>
                        <?php foreach ($dataDokumen as $dokumen): if($dokumen->jenisDokumen == "Provinsi"): ?>
                        <tr>
                            <td>
                                <a class="fw-bold" href="<?= base_url("/uploads/dokumen/").$dokumen->fileDokumen ?>"
                                    target="_blank"><?= $dokumen->namaDokumen ?></a>
                            </td>
                        </tr>
                        <?php endif; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Document from General's Curia</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>List of Document</th>
                    </thead>
                    <tbody>
                        <?php foreach ($dataDokumen as $dokumen): if($dokumen->jenisDokumen == "Universal"): ?>
                        <tr>
                            <td>
                                <a class="fw-bold" href="<?= base_url("/uploads/dokumen/").$dokumen->fileDokumen ?>"
                                    target="_blank"><?= $dokumen->namaDokumen ?></a>
                            </td>
                        </tr>
                        <?php endif; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        
    </div>
    <?= $footer ?>
</body>

</html>
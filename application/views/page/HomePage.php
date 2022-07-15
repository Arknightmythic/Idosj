<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/home.css"); ?>">
    <?= $css?>
    <?= $js?>
</head>

<body>
    <?= $navbar?>
    <div class="container px-4 px-md-0">
        <div class="row mt-5 d-flex align-items-center">
            <div class="col-xs-12 col-md-10 pe-md-3">
                <img src="<?= base_url("/assets/images/peta.png")?>" alt="Gambar Peta Indonesia" class="img-fluid">
            </div>
            <div class="col-xs-12 col-md-2 p-2 board-jumlah">
                <table>
                    <tr>
                        <b>JUMLAH ANGGOTA SAAT INI:</b>
                    </tr>
                    <?php foreach($jumlahAnggota as $jumlah): ?>
                    <tr>
                        <td><?= $jumlah->statusKeanggotaan ?></td>
                        <td> : </td>
                        <td><b><?= $jumlah->jumlah ?></b></td>
                    </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
        <div class="row submenu mt-3">
            <a href="<?= base_url('home/kuria') ?>" class="links col-12 col-md-3">Kuria</a>
            <a href="<?= base_url('home/komunitas') ?>" class="links col-12 col-md-3">Komunitas</a>
            <a href="<?= base_url('home/formasi') ?>" class="links col-12 col-md-3">Formasi</a>
            <a href="<?= base_url('home/karya') ?>" class="links col-12 col-md-3">Karya</a>
            <a href="<?= base_url('home/indexdata') ?>" class="links col-12 col-md-3">Index</a>
            <a href="<?= base_url('home/statistik') ?>" class="links col-12 col-md-3">Statistik</a>
            <a href="<?= base_url('home/admin') ?>" class="links col-12 col-md-3">User Admin</a>
            <a href="<?= base_url('home/user') ?>" class="links col-12 col-md-3">User</a>
        </div>
        <div class="my-5 d-flex flex-column align-items-center">
            <div class="my-3 col-6">
                <form class="input-group rounded" id="searchForm" autocomplete="off">
                    <input id="searchInput" type="search" class="form-control rounded" placeholder="Search"
                        aria-label="Search" aria-describedby="search-addon" />
                    <button class="input-group-text border-0 bg-transparent" id="search-addon">
                        <i class="bi-search"></i>
                    </button>
                </form>
            </div>
            <p class="text text-center">
                Atau cari dengan huruf depan:
            </p>
            <div>
                <?php foreach(range('A', 'Z') as $letter): ?>
                <button onclick="searchByLetter('<?= $letter ?>')"
                    class="btn btn-secondary ms-1 mt-1"><?= $letter ?></button>
                <?php endforeach ?>
            </div>
        </div>
        <div>
            <div class="table-responsive">
                <table id="tableAnggota" class="table table-striped">
                    <thead>
                        <th>No</th>
                        <th>ID Anggota</th>
                        <th>Nama</th>
                        <th>Gradus</th>
                        <th>Kategori</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="5">Cari data terlebih dahulu!</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?= $footer ?>

    <script>
    <?= "const baseURL = '" . base_url() . "';"; ?>
    $(document).ready(() => {
        $('#searchForm').submit(() => {
            event.preventDefault();
            $('#tableAnggota tbody').html('');
            var search = $('#searchInput').val();
            if (search.length > 0) {
                $.ajax({
                    url: '<?= base_url("api/anggota") ?>',
                    type: 'GET',
                    data: {
                        search: search
                    },
                    success: (data) => {
                        data.forEach((anggota, index) => {
                            $('#tableAnggota tbody').append(`
                                <tr>
                                    <td>${index+1}</td>
                                    <td>${anggota.id}</td>
                                    <td class="fw-bold"><a href="${baseURL}index.php/anggota?id=${anggota.id}">${anggota.namaBelakang}, ${anggota.namaDepan}</a></td>
                                    <td>${anggota.namaGradasi}</td>
                                    <td>${anggota.statusKeanggotaan}</td>
                                </tr>
                            `)
                        })
                    }
                });
            } else {
                $('#tableAnggota tbody').append(`
                                <tr>
                                    <td class="text-center" colspan="5">Tidak ada data</td>
                                </tr>
                            `)
            }
        })
    });

    const searchByLetter = (letter) => {
        $('#tableAnggota tbody').html('');
        $.ajax({
            url: '<?= base_url("api/anggota") ?>',
            type: 'GET',
            data: {
                letter: letter,
            },
            success: (data) => {
                if (data.length > 0) {
                    data.forEach((anggota, index) => {
                        $('#tableAnggota tbody').append(`
                                <tr>
                                    <td>${index+1}</td>
                                    <td>${anggota.id}</td>
                                    <td class="fw-bold"><a href="${baseURL}index.php/anggota?id=${anggota.id}">${anggota.namaBelakang}, ${anggota.namaDepan}</a></td>
                                    <td>${anggota.namaGradasi}</td>
                                    <td>${anggota.statusKeanggotaan}</td>
                                </tr>
                            `)
                    })
                } else {
                    $('#tableAnggota tbody').append(`
                                <tr>
                                    <td class="text-center" colspan="5">Tidak ada data</td>
                                </tr>
                            `)
                }
            }
        });
    }
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/home.css"); ?>">
    <?= $css ?>
    <?= $js ?>
</head>

<body>
    <?= $navbar ?>
    <div class="container px-4 px-md-0">
        <div class="row mt-5 d-flex align-items-center">
            <div class="col-xs-12 col-md-10 pe-md-3">
                <img src="<?= base_url("/assets/images/peta.png") ?>" alt="Gambar Peta Indonesia" class="img-fluid">
            </div>
            <div class="col-xs-12 col-md-2 p-2 board-jumlah">
                <table>
                    <tr>
                        <b>Number of Jesuits</b>
                    </tr>
                    <?php foreach ($jumlahAnggota as $status => $jumlah) : ?>
                    <tr>
                        <td><?php echo $status; ?></td>
                        <td> : </td>
                        <td><?php echo $jumlah; ?></td>
                    </tr>
                     <?php endforeach; ?>
                    <tr>
                        <td><b>Total</b></td>
                        <td> : </td>
                        <td><b><?php echo $jumlahJesuit; ?></b></td>
                    </tr>
                </table><br>
            </div>
        </div>
        <div class="row submenu mt-3">
            <a href="<?= base_url('home/index-data/kuria/kuria') ?>" class="links col-12 col-md-4">Curia</a>
            <a href="<?= base_url('home/komunitas') ?>" class="links col-12 col-md-4">Community</a>
            <a href="<?= base_url('home/index-data/delegat-formasi/in-first-studies') ?>" class="links col-12 col-md-4">In Formation</a>
            <a href="<?= base_url('home/index-data/works-of-the-province/church-ministry') ?>" class="links col-12 col-md-4">Works of The Province</a>
            <a href="<?= base_url('home/index-data/delegat-imam-muda/belum-tersiat') ?>" class="links col-12 col-md-4">On Going Formation</a>
            <a href="<?= base_url('home/statistik') ?>" class="links col-12 col-md-4">Statistics</a>
            <?php if ($this->session->role == "Administrator" || $this->session->role == "Sekretariat") : ?>
                <a href="<?= base_url('home/admin') ?>" class="links col-12 col-md-4">User Admin</a>
                <a href="<?= base_url('home/user') ?>" class="links col-12 col-md-4">User</a>
                <a href="<?= base_url('home/dokumen') ?>" class="links col-12 col-md-4">Documents</a>
            <?php endif ?>
        </div>
        <div class="my-5 d-flex flex-column align-items-center">
            <div class="my-3 col-6">
                <form class="input-group rounded" id="searchForm" autocomplete="off">
                    <input id="searchInput" type="search" class="form-control rounded" placeholder="Search by name or ID" aria-label="Search" aria-describedby="search-addon" />
                    <button class="input-group-text border-0 bg-transparent" id="search-addon">
                        <i class="bi-search"></i>
                    </button>
                </form>
            </div>
            <?php if ($this->session->role == "Administrator" || $this->session->role == "Sekretariat") : ?>
                <p class="text text-center">
                    or find with the First Letter:
                </p>
                <div>
                    <?php foreach (range('A', 'Z') as $letter) : ?>
                        <button onclick="searchByLetter('<?= $letter ?>')" class="btn btn-secondary ms-1 mt-1"><?= $letter ?></button>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
        <div>
            <div class="table-responsive">
                <table id="tableAnggota" class="table table-striped">
                    <thead>
                        <th>No</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Grade</th>
                        <th>Category</th>
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
        const displayData = (data) => {
            $('#tableAnggota tbody').html('');
            data.forEach((anggota, index) => {
                $('#tableAnggota tbody').append(`
                <tr>
                    <td>${index+1}</td>
                    <td>${anggota.id}</td>
                    <td class="fw-bold"><a href="<?= base_url("/anggota/pribadi/") ?>${anggota.id}">${anggota.namaBelakang}, ${anggota.namaDepan}</a></td>
                    <td>${anggota.namaGradasi}</td>
                    <td>${anggota.statusKeanggotaan}</td>
                </tr>
            `)
            })
        }

        $(document).ready(() => {
            <?php if ($this->session->role == "Superior" || $this->session->role == "Delegat") : ?>
                axios.get("<?= base_url("/api/anggota") ?>").then(res => {
                    const data = res.data;
                    displayData(data);
                })
            <?php endif; ?>

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
                            displayData(data);
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
                        displayData(data)
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
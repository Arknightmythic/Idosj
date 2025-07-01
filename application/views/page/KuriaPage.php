<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-page.css"); ?>">
    <?= $css?>
    <?= $js?>
</head>

<body>
    <?= $navbar?>
    <div class="container px-4 px-md-0">
        <section>
            <h2 class="text-center">List <span id="titleList">Kuria</span></h2>
            <div class="d-flex align-items-center my-4 justify-content-center">
                <span>Filter berdasarkan kategori:</span>
                <div class="ms-3">
                    <button id="Kuria" class="btn btn-primary">Kuria</button>
                    <button id="Officiales" class="btn btn-primary">Officiales</button>
                    <button id="Komisiones" class="btn btn-primary">Komisiones</button>
                </div>
            </div>
            <table id="tableKuria" class="table table-striped">
                <thead>
                    <th>No.</th>
                    <th>Nama</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>
    </div>
    <?= $footer ?>

    <script>
    const displayList = (role) => {
        $.ajax({
            url: '<?= base_url("api/listuser") ?>',
            type: 'GET',
            success: (data) => {
                if (data[role].length > 0) {
                    data[role].forEach((user, index) => {
                        $('#tableKuria tbody').append(`
                                <tr>
                                    <td>${index+1}</td>
                                    <td>${user.namaLengkap}</td>
                                </tr>
                            `)
                    })
                } else {
                    $('#tableKuria tbody').append(`
                                <tr>
                                    <td class="text-center" colspan="2">Tidak ada data</td>
                                </tr>
                            `)
                }
            }
        });
    }

    $(document).ready(() => {
        displayList('Administrator');
    });

    $("#Kuria").click(() => {
        $('#tableKuria tbody').empty();
        $('#titleList').text('Kuria');
        displayList("Administrator");
    })

    $("#Officiales").click(() => {
        $('#tableKuria tbody').empty();
        $('#titleList').text('Officiales');
        displayList("Officiales");
    })

    $("#Komisiones").click(() => {
        $('#tableKuria tbody').empty();
        $('#titleList').text('Komisiones');
        displayList("Komisiones");
    })
    </script>
</body>

</html>
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
            <div class="d-flex justify-content-between">
                <form class="input-group rounded" id="searchForm" autocomplete="off">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" />
                    <button class="input-group-text border-0 bg-transparent" id="search-addon">
                        <i class="bi-search"></i>
                    </button>
                </form>
                <button id="addAdmin" class="btn btn-primary col-2 ms-5">Tambah Admin</button>
            </div>
            <h2 class="text-center mt-5">List Administrator</h2>
            <table id="tableKuria" class="table table-striped text-center">
                <thead>
                    <th>User ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>
    </div>
    <?= $footer ?>

    <script>
    let roles = [];
    axios.get("<?= base_url("api/listrole") ?>").then(res => {
        roles = res.data.filter(role => role.namaRole != "Personal");
    });

    const displayList = (searchQuery = '') => {
        axios.get("<?= base_url("api/listuser") ?>").then(res => {
            let data = [...res.data.Administrator, ...res.data.Delegat, ...res
                .data.Superior, ...res.data.Sekretariat
            ];
            console.log(data);
            if (searchQuery != '') {
                data = data.filter(item =>
                    item.namaLengkap.toLowerCase().includes(searchQuery
                        .toLowerCase()))
            }
            if (data.length > 0) {
                data.forEach((user) => {
                    $('#tableKuria tbody').append(`
                                <tr>
                                    <td>${user.id}</td>
                                    <td>${user.namaLengkap}</td>
                                    <td>${user.username}</td>
                                    <td>${user.namaRole}</td>
                                    <td>
                                        ${user.username === "<?= $this->input->cookie('userId') ?>" ? `` : `
                                            <button class="btn btn-danger btn-sm" onclick="handleDeleteUser(${user.id})">Hapus</button>
                                            `}
                                    </td>
                                </tr>
                            `)
                })
            } else {
                $('#tableKuria tbody').append(`
                                <tr>
                                    <td class="text-center" colspan="4">Tidak ada data</td>
                                </tr>
                            `)
            }
        })
    }

    const handleDeleteUser = (userID) => {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda tidak dapat mengembalikan data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append("deleteAdmin", true);
                formData.append("userID", userID);
                axios.post("<?= base_url("api/listuser") ?>", formData).then((res) => {
                    $('#tableKuria tbody').empty()
                    displayList();
                    Swal.fire({
                        title: res.data?.title,
                        text: res.data?.message,
                        icon: res.data?.status,
                    })
                })
            }
        })
    }

    $(document).ready(() => {
        displayList();
    });

    $("#searchForm").submit(() => {
        event.preventDefault();
        const query = $('#searchForm input').val();
        $('#tableKuria tbody').empty();
        displayList(query);
    })

    $("#addAdmin").click(() => {
        Swal.fire({
            title: 'Tambah Akun Admin',
            html: `
                    <form id="formAddAdmin" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Nama Lengkap</label>
                            <input name="namaLengkap" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Username</label>
                            <input name="username" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Password</label>
                            <div class="d-flex">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" id="password" name="password" class="form-control mx-1" required minlength=6 />
                                <button type="button" class="input-group-text" id="togglePassword" style="cursor: pointer">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Role</label>
                            <select class="form-select" name="idRole" required>
                                <option selected hidden value="">Pilih Role</option>
                                ${roles.map(role => `
                                    <option value="${role.id}">${role.namaRole}</option>
                                `).join('')}
                            </select>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                `,
            showConfirmButton: false,
            showCloseButton: true,
        })

        $("#formAddAdmin").submit(() => {
            event.preventDefault();
            const formData = new FormData($("#formAddAdmin")[0]);
            formData.append("addAdmin", true);
            axios.post("<?= base_url("api/listuser") ?>", formData).then((res) => {
                $('#tableKuria tbody').empty()
                displayList();
                Swal.fire({
                    title: res.data?.title,
                    text: res.data?.message,
                    icon: res.data?.status,
                })
            });
        })

        $("#togglePassword").click(() => {
            console.log("test")
            const type = $("#password").attr("type") === "password" ? "text" : "password";
            $("#password").attr("type", type);
            $("#togglePassword i").toggleClass("fa-eye");
            $("#togglePassword i").toggleClass("fa-eye-slash");
        });
    })
    </script>
</body>

</html>
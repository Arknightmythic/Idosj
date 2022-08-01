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

        <!-- Section of Pribadi -->
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Data Diri</h3>
                <?php if($editStatus): ?>
                <button id="editDataDiri" class="btn btn-secondary"><i class="fa fa-pencil"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="dataless">
                    <?php if($this->session->role == 'Administrator'): ?>
                    <tr>
                        <td>Peran</td>
                        <td><?= $dataPribadi->namaRole ?></td>
                    </tr>
                    <?php if($dataPribadi->namaRole != "Superior"): ?>
                    <tr>
                        <td>ID Superior</td>
                        <td>
                            <?= !empty($dataPribadi->idSuperior) ? ("<a href='". base_url("anggota/pribadi?id=$dataPribadi->idSuperior") . "' target='_blank'>$dataPribadi->idSuperior</a>") : "-" ?>
                        </td>
                    </tr>
                    <?php if($dataPribadi->namaRole != "Delegat"): ?>
                    <tr>
                        <td>ID Delegat</td>
                        <td>
                            <?= !empty($dataPribadi->idDelegat) ? ("<a href='". base_url("anggota/pribadi?id=$dataPribadi->idDelegat") . "' target='_blank'>$dataPribadi->idDelegat</a>") : "-" ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <tr>
                        <td>Tempat / Tanggal Lahir</td>
                        <td><?= !empty($dataPribadi->tempatLahir) ? $dataPribadi->tempatLahir  : "-" ?> /
                            <?= !empty($dataPribadi->tanggalLahir) ? date_format(date_create($dataPribadi->tanggalLahir), 'd F Y') : "-" ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Golongan Darah</td>
                        <td><?= !empty($dataPribadi->golonganDarah) ? $dataPribadi->golonganDarah : "-" ?></td>
                    </tr>
                    <tr>
                        <td>Gradus</td>
                        <td><?= $dataPribadi->namaGradasi ?></td>
                    </tr>
                    <tr>
                        <td>Kategori Keanggotaan</td>
                        <td><?= $dataPribadi->statusKeanggotaan ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?= $dataPribadi->statusMeninggal != NULL ? $dataPribadi->statusMeninggal ? "Sudah Meninggal" : "Masih Hidup" : "-" ?>
                        </td>
                    </tr>
                </table>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Pendidikan</h3>
                <?php if($editStatus): ?>
                <button id="tambahPendidikan" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>Institusi</th>
                        <th>Tahun</th>
                        <th>Ijazah</th>
                        <th>Jenjang Pendidikan</th>
                        <?php if($editStatus): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php if(count($dataPendidikan) > 0) : foreach ($dataPendidikan as $pendidikan) : ?>
                        <tr>
                            <td><?= $pendidikan->namaInstitusi ?></td>
                            <td><?= $pendidikan->tahunMasuk ?> - <?= $pendidikan->tahunLulus ?></td>
                            <td><?= $pendidikan->kelengkapanIjazah ? "Ya" : "Tidak" ?></td>
                            <td><?= $pendidikan->namaJenjang ?></td>
                            <?php if($editStatus): ?>
                            <td>
                                <button class="btn btn-danger btn-sm hapusPendidikan"
                                    onclick="hapusPendidikan(<?= $pendidikan->id ?>)">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-primary btn-sm editPendidikan"
                                    onclick="editPendidikan(<?= $pendidikan->id ?>)">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td class="text-center" colspan="<?= $editStatus ? 5 : 4 ?>">Tidak ada data</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Sakramen</h3>
                <?php if($editStatus): ?>
                <button id="tambahSakramen" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>Nama Sakramen</th>
                        <th>Tanggal Penerimaan</th>
                        <th>Keterangan</th>
                        <?php if($editStatus): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php if(count($dataSakramen) > 0) : foreach ($dataSakramen as $sakramen) : ?>
                        <tr>
                            <td><?= $sakramen->namaSakramen ?></td>
                            <td><?= date_format(date_create($sakramen->tanggalPenerimaan), 'd F Y') ?>
                            </td>
                            <td><?= !empty($sakramen->keterangan) ? $sakramen->keterangan  : "-" ?></td>
                            <?php if($editStatus): ?>
                            <td>
                                <button class="btn btn-danger btn-sm hapusSakramen"
                                    onclick="hapusSakramen(<?= $sakramen->id ?>)">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-primary btn-sm editSakramen"
                                    onclick="editSakramen(<?= $sakramen->id ?>)">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td class="text-center" colspan="<?= $editStatus ? 5 : 4 ?>">Tidak ada data</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Kemampuan Bahasa</h3>
                <?php if($editStatus): ?>
                <button id="tambahBahasa" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>Bahasa</th>
                        <th>Reading</th>
                        <th>Writing</th>
                        <th>Speaking</th>
                        <?php if($editStatus): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php if(count($dataBahasa) > 0): foreach ($dataBahasa as $bahasa) : ?>
                        <tr>
                            <td><?= $bahasa->namaBahasa ?></td>
                            <td><?= $bahasa->statusReading ? "Ya" : "Tidak" ?></td>
                            <td><?= $bahasa->statusWriting ? "Ya" : "Tidak" ?></td>
                            <td><?= $bahasa->statusSpeaking ? "Ya" : "Tidak" ?></td>
                            <?php if($editStatus): ?>
                            <td>
                                <button class="btn btn-danger btn-sm hapusBahasa"
                                    onclick="hapusBahasa(<?= $bahasa->id ?>)">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-primary btn-sm editBahasa"
                                    onclick="editBahasa(<?= $bahasa->id ?>)">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td class="text-center" colspan="<?= $editStatus ? 5 : 4 ?>">Tidak ada data</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Dokumen</h3>
                <?php if($editStatus): ?>
                <button id="tambahDokumen" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>Nama Dokumen</th>
                        <th>Nomor</th>
                        <?php if($editStatus): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php if(count($dataDokumen) > 0): foreach ($dataDokumen as $dokumen) : ?>
                        <tr>
                            <td><?= $dokumen->namaDokumen ?></td>
                            <td>
                                <?= !empty($dokumen->nomorDokumen) ? $dokumen->nomorDokumen : "-" ?>
                            </td>
                            <?php if($editStatus): ?>
                            <td>
                                <button class="btn btn-danger btn-sm hapusDokumen"
                                    onclick="hapusDokumen(<?= $dokumen->id ?>)">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-primary btn-sm editDokumen"
                                    onclick="editDokumen(<?= $dokumen->id ?>)">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td class="text-center" colspan="<?= $editStatus ? 3 : 2 ?>">Tidak ada data</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="d-flex justify-content-end">
            <?php if($editStatus): ?>
            <a href="<?= base_url("/anggota/pribadi/$dataPribadi->id") ?>"><button
                    class="btn btn-success px-5 btn-lg">Selesai</button></a>
            <?php else: ?>
            <a href="<?= base_url("/anggota/pribadi/$dataPribadi->id?edit=true") ?>"><button
                    class="btn btn-primary px-5 btn-lg">Sunting</button></a>
            <?php endif; ?>
        </section>
    </div>
    <?= $footer ?>

    <?php if($editStatus): ?>
    <script>
    $("#editDataDiri").click(() => {
        Swal.fire({
            title: 'Ubah Data Diri',
            html: `
                    <form id="formDataDiri" class="px-1 mt-3" style="text-align: left !important" enctype="multipart/form-data" autocomplete="off">
                        <div class="mb-1 d-flex justify-content-center">
                            <label class="form-label form-file-profile" for="profilePicture">
                                    <img id="profilePreview" src="<?= !empty($dataPribadi->fotoProfile) ? base_url("/uploads/profile/" . $dataPribadi->fotoProfile) : base_url("/assets/images/profile-placeholder.jpg") ?>" />
                            </label>
                            <input id="profilePicture" name="profilePicture" type="file" hidden accept=".png, .jpg, .jpeg" />
                        </div>    
                        <div class="mb-1">
                            <label class="form-label">Nama Depan</label>
                            <input name="namaDepan" class="form-control" value="<?= !empty($dataPribadi->namaDepan) ? $dataPribadi->namaDepan : "" ?>" />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Nama Belakang</label>
                            <input name="namaBelakang" class="form-control" required value="<?= !empty($dataPribadi->namaBelakang) ? $dataPribadi->namaBelakang : "" ?>" />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Komunitas - Residensi</label>
                            <select name="komunitas" class="form-select" required>
                                <option value="" hidden <?= $dataPribadi->komunitas == NULL && "selected"?> >Pilih Komunitas</option>
                                <?php foreach($dataKomunitas as $komunitas): ?>
                                <option value="<?= $komunitas->id ?>" <?= $dataPribadi->komunitas != NULL && $dataPribadi->komunitas == $komunitas->id ? "selected" : ""?> ><?= $komunitas->nama." - ".$komunitas->residensi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" required value="<?= $dataPribadi->email ?>" />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="number" name="nomorTelepon" class="form-control" required value="<?= $dataPribadi->nomorTelepon ?>" />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tempat Lahir</label>
                            <input name="tempatLahir" class="form-control" required value="<?= $dataPribadi->tempatLahir ?>" />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggalLahir" class="form-control" required value="<?= $dataPribadi->tanggalLahir ?>" />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Golongan Darah</label>
                            <select name="golonganDarah" class="form-select" required>
                                <option value="" hidden <?= $dataPribadi->golonganDarah == NULL && "selected" ?> >Pilih Golongan Darah</option>
                                <option value="A" <?= $dataPribadi->golonganDarah != NULL && $dataPribadi->golonganDarah == "A" ? "selected" : "" ?> >A</option>
                                <option value="B" <?= $dataPribadi->golonganDarah != NULL && $dataPribadi->golonganDarah == "B" ? "selected" : "" ?> >B</option>
                                <option value="AB" <?= $dataPribadi->golonganDarah != NULL && $dataPribadi->golonganDarah == "AB" ? "selected" : "" ?> >AB</option>
                                <option value="O" <?= $dataPribadi->golonganDarah != NULL && $dataPribadi->golonganDarah == "O" ? "selected" : "" ?> >O</option>
                            </select>
                        </div>
                        <?php if($this->session->role == "Administrator"): ?>
                        <div class="mb-1">
                            <label class="form-label">Jenis Gradasi</label>
                            <select name="jenisGradasi" class="form-select" required>
                                <option value="" hidden <?= $dataPribadi->statusKeanggotaan == NULL && "selected" ?> >Pilih Status Keanggotaan</option>
                                <?php foreach($gradasiAnggota as $gradasi): ?>
                                <option value="<?= $gradasi->id ?>" <?= $dataPribadi->statusKeanggotaan != NULL && ($dataPribadi->jenisGradasi === $gradasi->id) ? "selected" : "" ?> ><?= $gradasi->namaGradasi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Status</label>
                            <select name="statusMeninggal" class="form-select" required>
                                <option value="" hidden <?= $dataPribadi->statusMeninggal == NULL && "selected" ?> >Pilih Satatus</option>
                                <option value=0 <?= $dataPribadi->statusMeninggal != NULL && !$dataPribadi->statusMeninggal ? "selected" : "" ?> >Masih Hidup</option>
                                <option value=1 <?= $dataPribadi->statusMeninggal != NULL && $dataPribadi->statusMeninggal ? "selected" : "" ?> >Sudah Meninggal</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Role Anggota</label>
                            <select name="idRole" class="form-select" required>
                                <option value="" hidden <?= $dataPribadi->idRole == NULL && "selected" ?> >Pilih Role Anggota</option>
                                <?php foreach($listRole as $role): ?>
                                <option value="<?= $role->id ?>" <?= $dataPribadi->id != NULL && ($dataPribadi->idRole === $role->id) ? "selected" : "" ?> ><?= $role->namaRole ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Nama Superior</label>
                            <select name="idSuperior" class="form-select">
                                <option value="" <?= $dataPribadi->idSuperior == NULL && "selected" ?> >Tidak Ada</option>
                                <?php foreach($listSuperior as $superior): ?>
                                    <?php if($dataPribadi->id != $superior->idAnggota): ?>
                                        <option value="<?= $superior->idAnggota ?>" <?= $dataPribadi->idSuperior != NULL && ($dataPribadi->idSuperior === $superior->idAnggota) ? "selected" : "" ?> ><?= $superior->namaLengkap ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Nama Delegat</label>
                            <select name="idDelegat" class="form-select">
                                <option value="" <?= $dataPribadi->idDelegat == NULL && "selected" ?> >Tidak Ada</option>
                                <?php foreach($listDelegat as $delegat): ?>
                                    <?php if($dataPribadi->id != $delegat->idAnggota): ?>
                                        <option value="<?= $delegat->idAnggota ?>" <?= $dataPribadi->idDelegat != NULL && ($dataPribadi->idDelegat === $delegat->idAnggota) ? "selected" : "" ?> ><?= $delegat->namaLengkap ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary px-5">Simpan</button>
                        </div>
                    </form>
                `,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
        })

        const handleHideSuperior = () => {
            const selectedID = $("select[name=idRole]").val();
            const roleName = $(`select[name=idRole] option[value=${selectedID}]`).html();
            if (roleName == "Superior" || roleName == "Administrator") {
                $("select[name=idSuperior]").val("");
                $("select[name=idSuperior]").parent().hide();
                $("select[name=idDelegat]").val("");
                $("select[name=idDelegat]").parent().hide();
            } else if (roleName == "Delegat") {
                $("select[name=idDelegat]").val("");
                $("select[name=idDelegat]").parent().hide();
            } else {
                $("select[name=idSuperior]").parent().show();
                $("select[name=idDelegat]").parent().show();
            }
        }

        handleHideSuperior();

        $("select[name=idRole]").change(() => {
            handleHideSuperior();
        })

        $("#formDataDiri").submit(() => {
            event.preventDefault();
            const formData = new FormData($("#formDataDiri")[0]);
            formData.append("editDataDiri", 1);
            formData.append("id", "<?= $dataPribadi->id ?>");
            axios.post("<?= base_url("api/editanggota") ?>", formData).then(res => {
                const data = res.data;
                if (data.status == "success") {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: "success",
                    }).then(() => {
                        document.location.reload(true)
                    });
                } else {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: data.status,
                    });
                }
            }).catch((error) => console.log(error));
        });

        $("#profilePicture").change(() => {
            const files = event.target.files;
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = () => {
                    $("#profilePreview").attr("src", fr.result)
                }
                fr.readAsDataURL(files[0]);
            }
        })
    })

    $("#tambahPendidikan").click(() => {
        Swal.fire({
            title: 'Tambah Data Pendidikan',
            html: `
                    <form id="formPendidikan" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Nama Institusi</label>
                            <input name="namaInstitusi" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tahun Masuk</label>
                            <input name="tahunMasuk" class="form-control onlyYears" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tahun Lulus</label>
                            <input name="tahunLulus" class="form-control onlyYears" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Kelengkapan Ijazah</label>
                            <select name="kelengkapanIjazah" class="form-select" required />
                                <option value="" hidden >Pilih Kelengkapan Ijazah</option>
                                <option value="1">Ada</option>
                                <option value="0">Tidak Ada</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Jenjang Pendidikan</label>
                            <select name="tingkatJenjang" class="form-select" required />
                                <option value="" hidden >Pilih Jenjang Pendidikan</option>
                                <?php foreach ($jenjangPendidikan as $jenjang): ?>
                                    <option value="<?= $jenjang->id ?>"><?= $jenjang->namaJenjang ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary px-5">Tambah</button>
                        </div>
                    </form>
                `,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
        })

        $("#formPendidikan").submit(() => {
            event.preventDefault();
            const formData = new FormData($("#formPendidikan")[0]);
            formData.append("tambahPendidikan", 1);
            formData.append("id", "<?= $dataPribadi->id ?>");
            axios.post("<?= base_url("api/editanggota") ?>", formData).then(res => {
                const data = res.data;
                if (data.status == "success") {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: "success",
                    }).then(() => {
                        document.location.reload(true)
                    });
                } else {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: data.status,
                    });
                }
            })
        });

        $(".onlyYears").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            orientation: "bottom auto"
        });
    });

    const editPendidikan = (id) => {
        let tempData;
        axios.get(`<?= base_url("api/dataPendidikan") ?>?idPendidikan=${id}`).then(
            res => {
                tempData = res.data;
                Swal.fire({
                    title: 'Ubah Data Pendidikan',
                    html: `
                    <form id="formEditPendidikan" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Nama Institusi</label>
                            <input name="namaInstitusi" class="form-control" value="${tempData.namaInstitusi}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tahun Masuk</label>
                            <input name="tahunMasuk" class="form-control onlyYears" value="${tempData.tahunMasuk}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tahun Lulus</label>
                            <input name="tahunLulus" class="form-control onlyYears" value="${tempData.tahunLulus}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Kelengkapan Ijazah</label>
                            <select name="kelengkapanIjazah" class="form-select" required />
                                <option value="1" ${tempData.kelengkapanIjazah == 1 ? "selected" : ""}>Ada</option>
                                <option value="0" ${tempData.kelengkapanIjazah == 0 ? "selected" : ""}>Tidak Ada</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Jenjang Pendidikan</label>
                            <select name="tingkatJenjang" class="form-select" required />
                                <?php foreach ($jenjangPendidikan as $jenjang): ?>
                                    <option value="<?= $jenjang->id ?>" ${tempData.tingkatJenjang == <?= $jenjang->id ?> ? "selected" : ""}><?= $jenjang->namaJenjang ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary px-5">Simpan</button>
                        </div>
                    </form>
                `,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: false,
                })

                $("#formEditPendidikan").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formEditPendidikan")[0]);
                    formData.append("editPendidikan", 1);
                    formData.append("id", id);
                    axios.post("<?= base_url("api/editanggota") ?>", formData).then(
                        res => {
                            const data = res.data;
                            if (data.status == "success") {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: "success",
                                }).then(() => {
                                    document.location.reload(true)
                                });
                            } else {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: data.status,
                                });
                            }
                        })
                });

                $(".onlyYears").datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    orientation: "bottom auto"
                });
            })
    }

    const hapusPendidikan = (id) => {
        Swal.fire({
            title: 'Hapus Data Pendidikan',
            text: "Apakah anda yakin ingin menghapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!"
        }).then(result => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append("hapusPendidikan", 1);
                formData.append("id", id);
                axios.post("<?= base_url("api/editanggota") ?>", formData).then(
                    res => {
                        const data = res.data;
                        if (data.status == "success") {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: "success",
                            }).then(() => {
                                document.location.reload(true)
                            });
                        } else {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: data.status,
                            });
                        }
                    })
            }
        })
    }

    $("#tambahSakramen").click(() => {
        Swal.fire({
            title: 'Tambah Data Sakramen',
            html: `
                    <form id="formSakramen" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Nama Sakramen</label>
                            <input name="namaSakramen" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tanggal Penerimaan</label>
                            <input name="tanggalPenerimaan" type="date" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Keterangan</label>
                            <input name="keterangan" class="form-control"/>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary px-5">Tambah</button>
                        </div>
                    </form>
                `,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
        })

        $("#formSakramen").submit(() => {
            event.preventDefault();
            const formData = new FormData($("#formSakramen")[0]);
            formData.append("tambahSakramen", 1);
            formData.append("id", "<?= $dataPribadi->id ?>");
            axios.post("<?= base_url("api/editanggota") ?>", formData).then(res => {
                const data = res.data;
                if (data.status == "success") {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: "success",
                    }).then(() => {
                        document.location.reload(true)
                    });
                } else {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: data.status,
                    });
                }
            })
        });
    })

    const editSakramen = (id) => {
        let tempData;
        axios.get(`<?= base_url("api/dataSakramen") ?>?idSakramen=${id}`).then(
            res => {
                tempData = res.data;
                Swal.fire({
                    title: 'Ubah Data Sakramen',
                    html: `
                    <form id="formEditSakramen" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Nama Sakramen</label>
                            <input name="namaSakramen" class="form-control" value="${tempData.namaSakramen}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Tanggal Penerimaan</label>
                            <input name="tanggalPenerimaan" type="date" class="form-control" value="${tempData.tanggalPenerimaan}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Keterangan</label>
                            <input name="keterangan" class="form-control" value="${tempData.keterangan || ""}" />
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary px-5">Simpan</button>
                        </div>
                    </form>
                `,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: false,
                })

                $("#formEditSakramen").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formEditSakramen")[0]);
                    formData.append("editSakramen", 1);
                    formData.append("id", id);
                    axios.post("<?= base_url("api/editanggota") ?>", formData).then(
                        res => {
                            const data = res.data;
                            if (data.status == "success") {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: "success",
                                }).then(() => {
                                    document.location.reload(true)
                                });
                            } else {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: data.status,
                                });
                            }
                        })
                });

                $(".onlyYears").datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    orientation: "bottom auto"
                });
            })
    }

    const hapusSakramen = (id) => {
        Swal.fire({
            title: 'Hapus Data Sakramen',
            text: "Apakah anda yakin ingin menghapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.value) {
                const formData = new FormData();
                formData.append("hapusSakramen", 1);
                formData.append("id", id);
                axios.post("<?= base_url("api/editanggota") ?>", formData).then(
                    res => {
                        const data = res.data;
                        if (data.status == "success") {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: "success",
                            }).then(() => {
                                document.location.reload(true)
                            });
                        } else {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: data.status,
                            });
                        }
                    })
            }
        })
    }

    $("#tambahBahasa").click(() => {
        Swal.fire({
            title: 'Tambah Kemampuan Bahasa',
            html: `
                    <form id="formBahasa" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Bahasa</label>
                            <select name="idBahasa" class="form-select" required>
                                <option value="" hidden>Pilih Bahasa</option>
                                <?php foreach ($kemampuanBahasa as $b) : ?>
                                    <option value=<?= $b->id ?>><?= $b->namaBahasa ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-1 mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="reading" name="statusReading">
                            <label class="form-check-label" for="reading">
                                Reading
                            </label>
                        </div>
                        <div class="mb-1 mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="writing" name="statusWriting">
                            <label class="form-check-label" for="writing">
                                Writing
                            </label>
                        </div>
                        <div class="mb-1 mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="speaking" name="statusSpeaking">
                            <label class="form-check-label" for="speaking">
                                Speaking
                            </label>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary px-5">Tambah</button>
                        </div>
                    </form>
                `,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
        })

        $("#formBahasa").submit(() => {
            event.preventDefault();
            const formData = new FormData($("#formBahasa")[0]);
            formData.append("tambahBahasa", 1);
            formData.append("id", "<?= $dataPribadi->id ?>");
            axios.post("<?= base_url("api/editanggota") ?>", formData).then(res => {
                const data = res.data;
                if (data.status == "success") {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: "success",
                    }).then(() => {
                        document.location.reload(true)
                    });
                } else {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: data.status,
                    });
                }
            })
        });
    })

    const editBahasa = (id) => {
        let tempData;
        axios.get(`<?= base_url("api/dataBahasa") ?>?idBahasa=${id}`).then(
            res => {
                tempData = res.data;
                Swal.fire({
                    title: 'Edit Kemampuan Bahasa',
                    html: `
                    <form id="formEditBahasa" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Bahasa</label>
                            <select name="idBahasa" class="form-select" required>
                                <?php foreach ($kemampuanBahasa as $b) : ?>
                                    <option value=<?= $b->id ?> ${ tempData.idBahasa == <?= $b->id ?> ? "selected" : ""} ><?= $b->namaBahasa ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-1 mt-3">
                            <input class="form-check-input" type="checkbox" id="reading" name="statusReading" ${Number(tempData.statusReading) ? "checked" : ""}>
                            <label class="form-check-label" for="reading">
                                Reading
                            </label>
                        </div>
                        <div class="mb-1 mt-3">
                            <input class="form-check-input" type="checkbox" id="writing" name="statusWriting" ${Number(tempData.statusWriting) ? "checked" : ""}>
                            <label class="form-check-label" for="writing">
                                Writing
                            </label>
                        </div>
                        <div class="mb-1 mt-3">
                            <input class="form-check-input" type="checkbox" id="speaking" name="statusSpeaking" ${Number(tempData.statusSpeaking) ? "checked" : ""}>
                            <label class="form-check-label" for="speaking">
                                Speaking
                            </label>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary px-5">Simpan</button>
                        </div>
                    </form>
                `,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: false,
                })

                $("#formEditBahasa").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formEditBahasa")[0]);
                    formData.append("editBahasa", 1);
                    formData.append("id", id);
                    axios.post("<?= base_url("api/editanggota") ?>", formData).then(
                        res => {
                            const data = res.data;
                            if (data.status == "success") {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: "success",
                                }).then(() => {
                                    document.location.reload(true)
                                });
                            } else {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: data.status,
                                });
                            }
                        })
                });

                $(".onlyYears").datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    orientation: "bottom auto"
                });
            })
    }

    const hapusBahasa = (id) => {
        Swal.fire({
            title: 'Hapus Kemampuan Bahasa',
            text: "Apakah anda yakin ingin menghapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.value) {
                const formData = new FormData();
                formData.append("hapusBahasa", 1);
                formData.append("id", id);
                axios.post("<?= base_url("api/editanggota") ?>", formData).then(
                    res => {
                        const data = res.data;
                        if (data.status == "success") {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: "success",
                            }).then(() => {
                                document.location.reload(true)
                            });
                        } else {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: data.status,
                            });
                        }
                    })
            }
        })
    }

    const dokumen = [
        "Asuransi",
        "BPJS",
        "Kartu Keluarga",
        "KTP",
        "NPWP",
        "SIM",
    ];

    $("#tambahDokumen").click(() => {
        Swal.fire({
            title: 'Tambah Data Dokumen',
            html: `
                    <form id="formDokumen" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Nama Dokumen</label>
                            <select name="namaDokumen" class="form-select" required>
                                <option value="" hidden>Pilih Dokumen</option>
                                ${dokumen.map(d => `<option value=${d}>${d}</option>)`)}
                            </select>
                        </div>
                        <div class="mb-1 mt-3">
                            <label class="form-label">Nomor Dokumen</label>
                            <input class="form-control" name="nomorDokumen" required>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary px-5">Tambah</button>
                        </div>
                    </form>
                `,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
        })

        $("#formDokumen").submit(() => {
            event.preventDefault();
            const formData = new FormData($("#formDokumen")[0]);
            formData.append("tambahDokumen", 1);
            formData.append("id", "<?= $dataPribadi->id ?>");
            axios.post("<?= base_url("api/editanggota") ?>", formData).then(res => {
                const data = res.data;
                if (data.status == "success") {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: "success",
                    }).then(() => {
                        document.location.reload(true)
                    });
                } else {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: data.status,
                    });
                }
            })
        });
    })

    const editDokumen = (id) => {
        let tempData;
        axios.get(`<?= base_url("api/dataDokumen") ?>?idDokumen=${id}`).then(
            res => {
                tempData = res.data;
                Swal.fire({
                    title: 'Ubah Data Dokumen',
                    html: `
                    <form id="formEditDokumen" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label class="form-label">Nama Dokumen</label>
                            <select name="namaDokumen" class="form-select" required>
                                ${dokumen.map(d => `<option value=${d} ${tempData.namaDokumen == d ? "selected" : ""} >${d}</option>)`)}
                            </select>
                        </div>
                        <div class="mb-1 mt-3">
                            <label class="form-label">Nomor Dokumen</label>
                            <input class="form-control" name="nomorDokumen" value="${tempData.nomorDokumen}" required>
                        </div>
                        <div class="d-flex justify-content-end" style="margin-top: 1.5rem !important">
                            <button class="btn btn-primary px-5">Simpan</button>
                        </div>
                    </form>
                `,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: false,
                })

                $("#formEditDokumen").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formEditDokumen")[0]);
                    formData.append("editDokumen", 1);
                    formData.append("id", id);
                    axios.post("<?= base_url("api/editanggota") ?>", formData).then(
                        res => {
                            const data = res.data;
                            if (data.status == "success") {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: "success",
                                }).then(() => {
                                    document.location.reload(true)
                                });
                            } else {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: data.status,
                                });
                            }
                        })
                });

                $(".onlyYears").datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    orientation: "bottom auto"
                });
            })
    }

    const hapusDokumen = (id) => {
        Swal.fire({
            title: 'Hapus Data Dokumen',
            text: "Apakah anda yakin ingin menghapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.value) {
                const formData = new FormData();
                formData.append("hapusDokumen", 1);
                formData.append("id", id);
                axios.post("<?= base_url("api/editanggota") ?>", formData).then(
                    res => {
                        const data = res.data;
                        if (data.status == "success") {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: "success",
                            }).then(() => {
                                document.location.reload(true)
                            });
                        } else {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: data.status,
                            });
                        }
                    })
            }
        })
    }
    </script>
    <?php endif; ?>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-submenu.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/styles/anggota-page.css"); ?>">
    <?= $css ?>
    <?= $js ?>
</head>

<body>
    <?= $navbar ?>
    <div class="container px-4 px-md-0">
        <?= $submenu ?>

        <!-- Section of Content -->

        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Entrance</h3>
                <?php if ($editStatus) : ?>
                    <button id="ubahEntrance" class="btn btn-secondary"><i class="fa fa-pencil"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">

                    <tbody>
                        <tr>
                            <td>Date of Entrance</td>
                            <td><?= !empty($dataEntrance->entrance) ? date_format(date_create($dataEntrance->entrance), 'd F Y') : "-" ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>First Vows</h3>
                <?php if ($editStatus) : ?>
                    <button id="ubahKaulPertama" class="btn btn-secondary"><i class="fa fa-pencil"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">

                    <tbody>
                        <tr>
                            <td>Date of First Vows</td>
                            <td><?= !empty($dataKaulPertama->tanggalKaulPertama) ? date_format(date_create($dataKaulPertama->tanggalKaulPertama), 'd F Y') : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Place of First Vows</td>
                            <td><?= !empty($dataKaulPertama->tempatKaulPertama) ? ($dataKaulPertama->tempatKaulPertama) : "-" ?></td>
                            </td>
                        </tr>
                        <tr>
                            <td>Recieved by</td>
                            <td><?= !empty($dataKaulPertama->penerimaKaulPertama) ? ($dataKaulPertama->penerimaKaulPertama) : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Personal Letter</td>
                            <td>
                                <?php if (!empty($dataKaulPertama->suratPribadi)) : ?>
                                    <a class="btn btn-primary" href="<?= base_url('/uploads/dokumen-kaul-Pertama/') . $dataKaulPertama->suratPribadi ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                <?php else : ?>
                                    -
                                <?php endif ?>
                            </td>
                        </tr>
                        <tr>
                            <td>First Vows Text
                            <td>
                                <?php if (!empty($dataKaulPertama->teksKaulPertama)) : ?>
                                    <a class="btn btn-primary" href="<?= base_url('/uploads/dokumen-kaul-Pertama/') . $dataKaulPertama->teksKaulPertama ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                <?php else : ?>
                                    -
                                <?php endif ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Lektor Akolit</h3>
                <?php if ($editStatus) : ?>
                    <button id="ubahLektorAkolit" class="btn btn-secondary"><i class="fa fa-pencil"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">

                    <tbody>
                        <tr>
                            <td>Date </td>
                            <td><?= !empty($dataLektorAkolit->tanggalLektorAkolit) ? date_format(date_create($dataLektorAkolit->tanggalLektorAkolit), 'd F Y') : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Place </td>
                            <td><?= !empty($dataLektorAkolit->tempatLektorAkolit) ? $dataLektorAkolit->tempatLektorAkolit : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Conferred by</td>
                            <td><?= !empty($dataLektorAkolit->penerimaLektorAkolit) ? $dataLektorAkolit->penerimaLektorAkolit : "-" ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Deacon Ordination</h3>
                <?php if ($editStatus) : ?>
                    <button id="ubahDeaconOrdination" class="btn btn-secondary"><i class="fa fa-pencil"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">

                <table class="table table-stiped">

                    <tbody>
                        <tr>
                            <td>Date </td>
                            <td><?= !empty($dataTahbisanDiakon->tanggalTahbisanDiakon) ? date_format(date_create($dataTahbisanDiakon->tanggalTahbisanDiakon), 'd F Y') : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Place </td>
                            <td><?= !empty($dataTahbisanDiakon->tempatTahbisanDiakon) ? $dataTahbisanDiakon->tempatTahbisanDiakon : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Ordaining Bishop</td>
                            <td><?= !empty($dataTahbisanDiakon->pentahbis) ? $dataTahbisanDiakon->pentahbis : "-" ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Priesthood Ordination</h3>
                <?php if ($editStatus) : ?>
                    <button id="ubahPriesthoodOrdination" class="btn btn-secondary"><i class="fa fa-pencil"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">

                    <tbody>
                        <tr>
                            <td>Date </td>
                            <td><?= !empty($dataTahbisanImamat->tanggalTahbisanImamat) ? date_format(date_create($dataTahbisanImamat->tanggalTahbisanImamat), 'd F Y') : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Place </td>
                            <td><?= !empty($dataTahbisanImamat->tempatTahbisanImamat) ? $dataTahbisanImamat->tempatTahbisanImamat : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Ordaining Bishop</td>
                            <td><?= !empty($dataTahbisanImamat->ordainer) ? $dataTahbisanImamat->ordainer : "-" ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Tertianship</h3>
                <?php if ($editStatus) : ?>
                    <button id="ubahTersiat" class="btn btn-secondary"><i class="fa fa-pencil"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">

                    <tbody>
                        <tr>
                            <td>Starting Date </td>
                            <td><?= !empty($dataTersiat->fromDateTersiat) ? date_format(date_create($dataTersiat->fromDateTersiat), 'd F Y') : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>End Date </td>
                            <td><?= !empty($dataTersiat->endDateTersiat) ? date_format(date_create($dataTersiat->endDateTersiat), 'd F Y') : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Place </td>
                            <td><?= !empty($dataTersiat->tempatTersiat) ? $dataTersiat->tempatTersiat : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Instructor </td>
                            <td><?= !empty($dataTersiat->instrukturTersiat) ? $dataTersiat->instrukturTersiat : "-" ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>


        <?php if ($this->session->role == "Administrator" || $this->session->idAnggota == $dataPribadi->idDelegat) : ?>
            <section>
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Information of the Noviciate and Tertianship</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th></th>
                            <?php if (!$editStatus) : ?>
                                <th>Documents</th>
                            <?php else : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Catatan Saat Primi</td>
                                <?php if (!$editStatus) : ?>
                                    <td>
                                        <?php if (!empty($dataNovisiatTersiat->catatanPrimi)) : ?>
                                            <a class="btn btn-primary" href="<?= base_url('/uploads/informasi-novisiat-tersiat/') . $dataNovisiatTersiat->catatanPrimi ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <button class="btn btn-danger btn-sm hapusBahasa" onclick="hapusInformasi('catatanPrimi')" <?= empty($dataNovisiatTersiat->catatanPrimi) ? "disabled" : "" ?>>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm editBahasa" onclick="editInformasi('catatanPrimi')">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td>Catatan Saat Secundi</td>
                                <?php if (!$editStatus) : ?>
                                    <td>
                                        <?php if (!empty($dataNovisiatTersiat->catatanSecundi)) : ?>
                                            <a class="btn btn-primary disabled" href="<?= base_url('/uploads/informasi-novisiat-tersiat/') . $dataNovisiatTersiat->catatanSecundi ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <button class="btn btn-danger btn-sm hapusBahasa" onclick="hapusInformasi('catatanSecundi')" <?= empty($dataNovisiatTersiat->catatanSecundi) ? "disabled" : "" ?>>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm editBahasa" onclick="editInformasi('catatanSecundi')">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td>Catatan Saat Tersiat</td>
                                <?php if (!$editStatus) : ?>
                                    <td>
                                        <?php if (!empty($dataNovisiatTersiat->catatanTersiat)) : ?>
                                            <a class="btn btn-primary" href="<?= base_url('/uploads/informasi-novisiat-tersiat/') . $dataNovisiatTersiat->catatanTersiat ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <button class="btn btn-danger btn-sm hapusBahasa" onclick="hapusInformasi('catatanTersiat')" <?= empty($dataNovisiatTersiat->catatanTersiat) ? "disabled" : "" ?>>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm editBahasa" onclick="editInformasi('catatanTersiat')">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="form-floating mt-4">
                        <textarea class="form-control" placeholder="Leave a comment here" id="catatanNovisiat" <?= !empty($dataNovisiatTersiat->novisiat) ? "rows='10'" : "rows='3'" ?> style="height:100%;" <?= $editStatus ? "" : "disabled" ?>><?= !empty($dataNovisiatTersiat->novisiat) ? $dataNovisiatTersiat->novisiat : "" ?></textarea>
                        <label for="catatanNovisiat">Noviciate</label>
                    </div>
                    <?php if ($editStatus) : ?>
                        <div class="mt-2 d-flex justify-content-end">
                            <button class="btn btn-primary btn-sm" onClick="simpanCatatan('novisiat')">
                                <i class="fa fa-save"></i>
                                <span>Save Comment</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <div class="form-floating mt-4">
                        <textarea class="form-control" placeholder="Leave a comment here" id="catatanTersiat" <?= !empty($dataNovisiatTersiat->tersiat) ? "rows='10'" : "rows='3'" ?> style="height:100%;" <?= $editStatus ? "" : "disabled" ?>><?= !empty($dataNovisiatTersiat->tersiat) ? $dataNovisiatTersiat->tersiat : "" ?></textarea>
                        <label for="catatanTersiat">Tertianship</label>
                    </div>
                    <?php if ($editStatus) : ?>
                        <div class="mt-2 d-flex justify-content-end">
                            <button class="btn btn-primary btn-sm" onClick="simpanCatatan('tersiat')">
                                <i class="fa fa-save"></i>
                                <span>Save Comment</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>
        <?php if ($this->session->role == "Administrator" || $this->session->idAnggota == $dataPribadi->idDelegat) : ?>
            <section>
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Informations</h3>
                    <?php if ($editStatus) : ?>
                        <div class="d-flex">
                            <button id="ubahInfo" class="btn btn-secondary"><i class="fa fa-pencil"></i></button>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-stiped">
                        <thead>
                            <th>Description</th>
                            <th>Documents</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Institution</td>
                                <td>
                                    <?php if (!empty($dataInfo->institusi)) : ?>
                                        <a class="btn btn-primary" href="<?= base_url('/uploads/dokumen-informationes/') . $dataInfo->institusi ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                    <?php else : ?>
                                        -
                                    <?php endif ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Before Theology</td>
                                <td>
                                    <?php if (!empty($dataInfo->sebelumTeologi)) : ?>
                                        <a class="btn btn-primary" href="<?= base_url('/uploads/dokumen-informationes/') . $dataInfo->sebelumTeologi ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                    <?php else : ?>
                                        -
                                    <?php endif ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Before Ordination</td>
                                <td>
                                    <?php if (!empty($dataInfo->sebelumTahbisan)) : ?>
                                        <a class="btn btn-primary" href="<?= base_url('/uploads/dokumen-informationes/') . $dataInfo->sebelumTahbisan ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                    <?php else : ?>
                                        -
                                    <?php endif ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Before Final Vows</td>
                                <td>
                                    <?php if (!empty($dataInfo->sebelumKaulAkhir)) : ?>
                                        <a class="btn btn-primary" href="<?= base_url('/uploads/dokumen-informationes/') . $dataInfo->sebelumKaulAkhir ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                    <?php else : ?>
                                        -
                                    <?php endif ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </section>


        <?php endif; ?>
        <?php if ($this->session->role == "Administrator" || $this->session->idAnggota == $dataPribadi->idDelegat) : ?>
            <section>
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Information from the Delegates</h3>
                    <?php if ($editStatus) : ?>
                        <div class="d-flex">
                            <button id="ubahInfo" class="btn btn-secondary"><i class="fa fa-pencil"></i></button>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-floating mt-4">
                    <textarea class="form-control" placeholder="Leave a comment here" id="komentar" <?= !empty($dataKomentar->textKomentar) ? "rows='10'" : "rows='3'" ?> style="height:100%;" <?= $editStatus ? "" : "disabled" ?>><?= !empty($dataKomentar->textKomentar) ? $dataKomentar->textKomentar : "" ?></textarea>
                    <label for="komentar">Write your comments</label>
                </div>
                <?php if ($editStatus) : ?>
                    <div class="mt-2 d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm" id="simpanKomentar">
                            <i class="fa fa-save"></i>
                            <span>Save Information</span>
                        </button>
                    </div>
                <?php endif; ?>
            </section>

        <?php endif; ?>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Final Vows</h3>
                <?php if ($editStatus) : ?>
                    <button id="ubahKaulAkhir" class="btn btn-secondary"><i class="fa fa-pencil"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">

                    <tbody>
                        <tr>
                            <td>Date </td>
                            <td><?= !empty($dataKaulAkhir->tanggalKaulAkhir) ? date_format(date_create($dataKaulAkhir->tanggalKaulAkhir), 'd F Y') : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Place </td>
                            <td><?= !empty($dataKaulAkhir->tempatKaulAkhir) ? $dataKaulAkhir->tempatKaulAkhir : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Received by</td>
                            <td><?= !empty($dataKaulAkhir->penerimaKaulAkhir) ? $dataKaulAkhir->penerimaKaulAkhir : "-" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Grade</td>
                            <td><?= !empty($dataKaulAkhir->gradasilKaulAkhir) ? $dataPribadi->namaGradasi : "-" ?></td>
                        </tr>
                        <tr>
                            <td>Personal Letter</td>
                            <td>
                                <?php if (!empty($dataKaulAkhir->suratPribadi)) : ?>
                                    <a class="btn btn-primary" href="<?= base_url('/uploads/dokumen-kaul-akhir/') . $dataKaulAkhir->suratPribadi ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                <?php else : ?>
                                    -
                                <?php endif ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Decree</td>
                            <td>
                                <?php if (!empty($dataKaulAkhir->dekritKaul)) : ?>
                                    <a class="btn btn-primary" href="<?= base_url('/uploads/dokumen-kaul-akhir/') . $dataKaulAkhir->dekritKaul ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                <?php else : ?>
                                    -
                                <?php endif ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Final Vows Text</td>
                            <td>
                                <?php if (!empty($dataKaulAkhir->teksKaul)) : ?>
                                    <a class="btn btn-primary" href="<?= base_url('/uploads/dokumen-kaul-akhir/') . $dataKaulAkhir->teksKaul ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                <?php else : ?>
                                    -
                                <?php endif ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Renunciation of Possessions</td>
                            <td>
                                <?php if (!empty($dataKaulAkhir->teksPelepasan)) : ?>
                                    <a class="btn btn-primary" href="<?= base_url('/uploads/dokumen-kaul-akhir/') . $dataKaulAkhir->teksPelepasan ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                <?php else : ?>
                                    -
                                <?php endif ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Notary Testament</td>
                            <td>
                                <?php if (!empty($dataKaulAkhir->testamenNotaris)) : ?>
                                    <a class="btn btn-primary" href="<?= base_url('/uploads/dokumen-kaul-akhir/') . $dataKaulAkhir->testamenNotaris ?>" target="_blank"><i class="fa fa-file-lines"></i></a>
                                <?php else : ?>
                                    -
                                <?php endif ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Academic Training</h3>
                <?php if ($editStatus) : ?>
                    <button id="tambahKeahlian" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>Year</th>
                        <th>Institution</th>
                        <th>GPA</th>
                        <?php if (!$editStatus) : ?>
                            <th>Certificate</th>
                        <?php else : ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php foreach ($dataKeahlian as $keahlian) : ?>
                            <tr>
                                <td><?= $keahlian->studiKhusus ?></td>
                                <td><?= $keahlian->namaInstitusi ?></td>
                                <td><?= $keahlian->levelKeahlian ?></td>
                                <?php if (!$editStatus) : ?>
                                    <td>
                                        <a href="<?= base_url("/uploads/sertifikat-keahlian/") . $keahlian->dokumen ?>" class="btn btn-primary" target="_blank"><i class="fa fa-file-lines"></i></a>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <button class="btn btn-primary btn-sm" id="ubahKeahlian" onClick="editKeahlian(<?= $keahlian->id ?>)">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" id="hapusKeahlian" onClick="hapusKeahlian(<?= $keahlian->id ?>)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Publication</h3>
                <?php if ($editStatus) : ?>
                    <button id="tambahPublikasi" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>Title</th>
                        <th>Year of Publication</th>
                        <th>Publisher</th>
                        <th>Category</th>
                        <?php if ($editStatus) : ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php foreach ($dataPublikasi as $publikasi) : ?>
                            <tr>
                                <td><?= $publikasi->judul ?></td>
                                <td><?= $publikasi->tahunTerbit ?></td>
                                <td><?= $publikasi->penerbit ?></td>
                                <td><?= $publikasi->jenis ?></td>
                                <?php if ($editStatus) : ?>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onClick="editPublikasi(<?= $publikasi->id ?>)">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onClick="hapusPublikasi(<?= $publikasi->id ?>)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>


        <section>
            <div class="d-flex justify-content-between align-items-center">
                <h3>Medical Records</h3>
                <?php if ($editStatus) : ?>
                    <button id="tambahKesehatan" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-stiped">
                    <thead>
                        <th>Diagnosis</th>
                        <th>Hospital</th>
                        <th>Date</th>
                        <th>Notes</th>
                        <?php if (!$editStatus) : ?>
                            <th>Document</th>
                        <?php else : ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php foreach ($dataKesehatan as $kesehatan) : ?>
                            <tr>
                                <td><?= $kesehatan->diagnosis ?></td>
                                <td><?= $kesehatan->hospital ?></td>
                                <td><?= $kesehatan->date ?></td>
                                <td><?= $kesehatan->notes ?></td>
                                <?php if (!$editStatus) : ?>
                                    <td>
                                        <a href="<?= base_url("/uploads/dokumen-rumahsakit/") . $kesehatan->dokumen ?>" class="btn btn-primary" target="_blank"><i class="fa fa-file-lines"></i></a>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <button class="btn btn-primary btn-sm" id="ubahKesehatan" onClick="editKesehatan(<?= $kesehatan->id ?>)">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" id="hapusKesehatan" onClick="hapusKesehatan(<?= $kesehatan->id ?>)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- End of Content -->
        <section class="d-flex justify-content-end">
            <?php if ($editStatus) : ?>
                <a href="<?= base_url("/anggota/formasi/$dataPribadi->id") ?>"><button class="btn btn-success px-5 btn-lg">Selesai</button></a>
            <?php else : ?>
                <a href="<?= base_url("/anggota/formasi/$dataPribadi->id?edit=true") ?>"><button class="btn btn-primary px-5 btn-lg">Edit</button></a>
            <?php endif; ?>
        </section>
    </div>
    <?= $footer ?>

    <?php if ($editStatus) : ?>

        <script>
            $("#tambahSerikat").click(() => {
                Swal.fire({
                    title: 'Tambah Data Serikat Jesus',
                    html: `
                    <form id="formSerikat" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Keterangan</label>
                            <select class="form-select" name="keterangan" required>
                                <option value="" hidden>Pilih Keterangan</option>
                                <option value="Masuk Novisiat">Masuk Novisiat</option>
                                <option value="Kaul Pertama">Kaul Pertama</option>
                                <option value="Juniorat">Juniorat</option>
                                <option value="Filsafat">Filsafat</option>
                                <option value="Tahun Orientasi Kerasulan">Tahun Orientasi Kerasulan</option>
                                <option value="Teologi">Teologi</option>
                                <option value="Tahbisan Diakon">Tahbisan Diakon</option>
                                <option value="Tahbisan Imamat">Tahbisan Imamat</option>
                                <option value="Tersiat">Tersiat</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="namaSerikat">Tanggal dan Tempat</label>
                            <textarea name="tanggalTempat" class="form-control" maxlength="255" required></textarea>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Superior</label>
                            <input name="pembimbing" class="form-control" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Dokumen</label>
                            <input name="fileData" type="file" class="form-control" accept="application/pdf" />
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

                $("#formSerikat").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formSerikat")[0]);
                    formData.append("tambahSerikat", 1);
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

            const editSerikat = (id) => {
                let tempData;
                axios.get(`<?= base_url("api/dataSerikat") ?>?idSerikat=${id}`).then(
                    res => {
                        tempData = res.data;
                        Swal.fire({
                            title: 'Ubah Data Serikat',
                            html: `
                    <form id="formEditSerikat" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Keterangan</label>
                            <select class="form-select" name="keterangan" required>
                                <option value="Masuk Novisiat" ${tempData.keterangan == "Masuk Novisiat" ? "selected" : ""}>Masuk Novisiat</option>
                                <option value="Kaul Pertama" ${tempData.keterangan == "Kaul Pertama" ? "selected" : ""}>Kaul Pertama</option>
                                <option value="Juniorat" ${tempData.keterangan == "Juniorat" ? "selected" : ""}>Juniorat</option>
                                <option value="Filsafat" ${tempData.keterangan == "Filsafat" ? "selected" : ""}>Filsafat</option>
                                <option value="Tahun Orientasi Kerasulan" ${tempData.keterangan == "Tahun Orientasi Kerasulan" ? "selected" : ""}>Tahun Orientasi Kerasulan</option>
                                <option value="Teologi" ${tempData.keterangan == "Teologi" ? "selected" : ""}>Teologi</option>
                                <option value="Tahbisan Diakon" ${tempData.keterangan == "Tahbisan Diakon" ? "selected" : ""}>Tahbisan Diakon</option>
                                <option value="Tahbisan Imamat" ${tempData.keterangan == "Tahbisan Imamat" ? "selected" : ""}>Tahbisan Imamat</option>
                                <option value="Tersiat" ${tempData.keterangan == "Tersiat" ? "selected" : ""}>Tersiat</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="namaSerikat">Tanggal dan Tempat</label>
                            <textarea name="tanggalTempat" class="form-control" maxlength="255" required>${tempData.tanggalTempat}</textarea>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Pembimbing</label>
                            <input name="pembimbing" class="form-control" value="${tempData.pembimbing}" required />
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Dokumen</label>
                            <input name="fileData" type="file" class="form-control" accept="application/pdf" />
                            <small class="form-text text-muted">${tempData.dokumen || ""}</small>
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

                        $("#formEditSerikat").submit(() => {
                            event.preventDefault();
                            const formData = new FormData($("#formEditSerikat")[0]);
                            formData.append("editSerikat", 1);
                            formData.append("id", id);
                            formData.append("idAnggota", "<?= $dataPribadi->id ?>");
                            if (tempData.dokumen != "" && tempData.dokumen != null) {
                                formData.append("lastFile", tempData.dokumen);
                            }
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
                    })
            }

            const hapusSerikat = (id) => {
                axios.get(`<?= base_url("api/dataSerikat") ?>?idSerikat=${id}`).then(
                    res => {
                        tempData = res.data;
                        Swal.fire({
                            title: 'Hapus Data Serikat',
                            text: "Apakah anda yakin ingin menghapus data ini?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Ya, Hapus!"
                        }).then(result => {
                            if (result.isConfirmed) {
                                const formData = new FormData();
                                formData.append("hapusSerikat", 1);
                                formData.append("id", id);
                                formData.append("lastFile", tempData.dokumen);
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
                    })
            }

            $("#ubahKaulPertama").click(() => {
                Swal.fire({
                    title: 'Ubah Data Kaul Pertama',
                    html: `
		            <form id="formKaulPertama" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Tanggal Kaul Pertama</label>
                            <input type="date" class="form-control" name="tanggalKaulPertama" required />
                        </div>
                        <div class="mb-1">
                            <label>Tempat Kaul Pertama</label>
                            <input type="text" class="form-control" name="tempatKaulPertama" required />
                        </div>
                        <div class="mb-1">
                            <label>Penerima Kaul Pertama</label>
                            <input type="text" class="form-control" name="penerimaKaulPertama" required />
                        </div>
                        <div class="mb-1">
                            <label>Surat Pribadi</label>
                            <input class="form-control" name="suratPribadi" type="file" accept="application/pdf" />
                        </div>
                        <div class="mb-1">
                            <label>Teks Kaul Pertama</label>
                            <input class="form-control" name="teksKaulPertama" type="file" accept="application/pdf" />
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

                $("#formKaulPertama").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formKaulPertama")[0]);
                    formData.append("editKaulPertama", 1);
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

            $("#ubahEntrance").click(() => {
                Swal.fire({
                    title: 'Ubah Data Entrance',
                    html: `
		            <form id="formEntrance" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Tanggal Masuk SJ</label>
                            <input type="date" class="form-control" name="tanggalEntrance" required />
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

                $("#formEntrance").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formEntrance")[0]);
                    formData.append("editEntrance", 1);
                    formData.append("id", "<?= $dataEntrance->id ?>");
                    axios.post("<?= base_url("api/editEntrance") ?>", formData).then(res => {
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

            $("#ubahLektorAkolit").click(() => {
                Swal.fire({
                    title: 'Ubah Data Lektor Akolit',
                    html: `
                    <form id="formLektorAkolit" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Tanggal Lektor Akolit</label>
                            <input type="date" class="form-control" name="tanggalLektorAkolit"/>
                        </div>
                        <div class="mb-1">
                            <label>Tempat Lektor Akolit</label>
                            <input type="text" class="form-control" name="tempatLektorAkolit"/>
                        </div>
                        <div class="mb-1">
                            <label>Penerima Lektor Akolit</label>
                            <input type="text" class="form-control" name="penerimaLektorAkolit"/>
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

                $("#formLektorAkolit").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formLektorAkolit")[0]);
                    formData.append("editLektorAkolit", 1);
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

            $("#ubahDeaconOrdination").click(() => {
                Swal.fire({
                    title: 'Ubah Data Deacon Ordination',
                    html: `
                    <form id="formDeaconOrdination" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Tanggal Tahbisan Diakon</label>
                            <input type="date" class="form-control" name="tanggalDeaconOrdination"/>
                        </div>
                        <div class="mb-1">
                            <label>Tempat Tahbisan Diakon</label>
                            <input type="text" class="form-control" name="tempatDeaconOrdination"/>
                        </div>
                        <div class="mb-1">
                            <label>Uskup Tahbisan Diakon</label>
                            <input type="text" class="form-control" name="penerimaDeaconOrdination"/>
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

                $("#formDeaconOrdination").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formDeaconOrdination")[0]);
                    formData.append("editDeaconOrdination", 1);
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

            $("#ubahPriesthoodOrdination").click(() => {
                Swal.fire({
                    title: 'Ubah Data Tahbisan Imam',
                    html: `
                    <form id="formTahbisanImamat" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Tanggal Tahbisan Imam</label>
                            <input type="date" class="form-control" name="tanggalTahbisanImamat"/>
                        </div>
                        <div class="mb-1">
                            <label>Tempat Tahbisan Imam</label>
                            <input type="text" class="form-control" name="tempatTahbisanImamat"/>
                        </div>
                        <div class="mb-1">
                            <label>Uskup Tahbisan Imam</label>
                            <input type="text" class="form-control" name="ordainer"/>
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

                $("#formTahbisanImamat").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formTahbisanImamat")[0]);
                    formData.append("updateTahbisanImamat", 1);
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

            $("#ubahTersiat").click(() => {
                Swal.fire({
                    title: 'Ubah Data Tertianship',
                    html: `
                    <form id="formTersiat" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Tanggal Masuk Tersiat</label>
                            <input type="date" class="form-control" name="fromDateTersiat" required />
                        </div>
                        <div class="mb-1">
                            <label>Tanggal Berakhir Tersiat</label>
                            <input type="date" class="form-control" name="endDateTersiat" required />
                        </div>
                        <div class="mb-1">
                            <label>Tempat Tersiat</label>
                            <input type="text" class="form-control" name="tempatTersiat" required />
                        </div>
                        <div class="mb-1">
                            <label>Instruktur Utama Tersiat</label>
                            <input type="text" class="form-control" name="instrukturTersiat" required />
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

                $("#formTersiat").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formTersiat")[0]);
                    formData.append("updateTersiat", 1);
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

            $("#ubahInfo").click(() => {
                Swal.fire({
                    title: 'Ubah Data Informationes',
                    html: `
                    <form id="formInfo" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Jenis Informationes</label>
                            <select class="form-select" name="jenisInformationes" required>
                                <option value="" hidden>Pilih Jenis Informationes</option>
                                <option value="Institusi">Institusi</option>
                                <option value="Sebelum Teologi">Sebelum Teologi</option>
                                <option value="Sebelum Tahbisan">Sebelum Tahbisan</option>
                                <option value="Sebelum Kaul Akhir">Sebelum Kaul Akhir</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label>Dokumen</label>
                            <input type="file" class="form-control" name="fileData" accept="application/pdf"/>
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

                $("#formInfo").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formInfo")[0]);
                    formData.append("editInfo", 1);
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

            $("#simpanKomentar").click(() => {
                const komentar = $("#komentar").val();
                if (komentar.length > 0) {
                    const formData = new FormData();
                    formData.append("komentar", 1);
                    formData.append("textKomentar", komentar);
                    formData.append("idAnggota", "<?= $dataPribadi->id ?>");
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

            $("#ubahKaulAkhir").click(() => {
                Swal.fire({
                    title: 'Ubah Data Kaul Akhir',
                    html: `
                    <form id="formKaulAkhir" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Tanggal Kaul Akhir</label>
                            <input type="date" class="form-control" name="tanggalKaulAkhir" required />
                        </div>
                        <div class="mb-1">
                            <label>Tempat Kaul Akhir</label>
                            <input class="form-control" name="tempatKaulAkhir" required />
                        </div>
                        <div class="mb-1">
                            <label>Penerima Kaul Akhir</label>
                            <input class="form-control" name="penerimaKaulAkhir" required />
                        </div>
                        <div class="mb-1">
                            <label>Surat Pribadi</label>
                            <input class="form-control" name="fileSuratPribadi" type="file" accept="application/pdf" />
                        </div>
                        <div class="mb-1">
                            <label>Dekrit Kaul</label>
                            <input class="form-control" name="fileDekritKaul" type="file" accept="application/pdf" />
                        </div>
                        <div class="mb-1">
                            <label>Teks Kaul</label>
                            <input class="form-control" name="fileTeksKaul" type="file" accept="application/pdf" />
                        </div>
                        <div class="mb-1">
                            <label>Teks Pelepasan</label>
                            <input class="form-control" name="fileTeksPelepasan" type="file" accept="application/pdf" />
                        </div>
                        <div class="mb-1">
                            <label>Testamen Notaris</label>
                            <input class="form-control" name="fileTestamenNotaris" type="file" accept="application/pdf" />
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

                $("#formKaulAkhir").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formKaulAkhir")[0]);
                    formData.append("editKaulAkhir", 1);
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

            $("#tambahKeahlian").click(() => {
                Swal.fire({
                    title: 'Tambah Data Keahlian',
                    html: `
                    <form id="formKeahlian" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Year</label>
                            <input class="form-control" name="studiKhusus" required />
                        </div>
                        <div class="mb-1">
                            <label>Institution</label>
                            <input class="form-control" name="namaInstitusi" required />
                        </div>
                        <div class="mb-1">
                            <label>IPK</label>
                            <input class="form-control" name="levelKeahlian" required />
                        </div>
                        <div class="mb-1">
                            <label>KHS/Ijazah</label>
                            <input type="file" class="form-control" name="fileData" required />
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

                $("#formKeahlian").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formKeahlian")[0]);
                    formData.append("tambahKeahlian", 1);
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

            const editKeahlian = (id) => {
                axios.get(`<?= base_url("api/datakeahlian?idKeahlian=") ?>${id}`).then(res => {
                    const data = res.data;
                    Swal.fire({
                        title: 'Edit Data Keahlian',
                        html: `
                    <form id="formKeahlian" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Year</label>
                            <input class="form-control" name="studiKhusus" value='${data.studiKhusus}' required />
                        </div>
                        <div class="mb-1">
                            <label>Institution</label>
                            <input class="form-control" name="namaInstitusi" value='${data.namaInstitusi}' required />
                        </div>
                        <div class="mb-1">
                            <label>IPK</label>
                            <input class="form-control" name="levelKeahlian" value='${data.levelKeahlian}' required />
                        </div>
                        <div class="mb-1">
                            <label>KHS/Ijazah</label>
                            <input type="file" class="form-control" name="fileData" accept="application/pdf, image/png, image/jpeg" />
                            <small class="form-text text-muted">${data.dokumen}</small>
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

                    $("#formKeahlian").submit(() => {
                        event.preventDefault();
                        const formData = new FormData($("#formKeahlian")[0]);
                        formData.append("editKeahlian", 1);
                        formData.append("lastFile", data.dokumen);
                        formData.append("id", id);
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
            }

            const hapusKeahlian = (id) => {
                let tempData;
                axios.get(`<?= base_url("api/dataKeahlian") ?>?idKeahlian=${id}`).then(
                    res => {
                        tempData = res.data;
                        Swal.fire({
                            title: 'Hapus Data Keahlian',
                            text: "Apakah anda yakin ingin menghapus data ini?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Ya, Hapus!"
                        }).then(result => {
                            if (result.isConfirmed) {
                                const formData = new FormData();
                                formData.append("hapusKeahlian", 1);
                                formData.append("id", id);
                                formData.append("lastFile", tempData.dokumen);
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
                    })
            }

            $("#tambahPublikasi").click(() => {
                Swal.fire({
                    title: 'Tambah Data Publikasi',
                    html: `
                    <form id="formPublikasi" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Judul</label>
                            <input class="form-control" name="judul" required />
                        </div>
                        <div class="mb-1">
                            <label>Tahun Terbit</label>
                            <input type="number" class="form-control onlyYears" name="tahunTerbit" maxlength="4" required />
                        </div>
                        <div class="mb-1">
                            <label>Penerbit</label>
                            <input class="form-control" name="penerbit" required />
                        </div>
                        <div class="mb-1">
                            <label>Jenis</label>
                            <input class="form-control" name="jenis" required />
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

                $("#formPublikasi").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formPublikasi")[0]);
                    formData.append("tambahPublikasi", 1);
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
            })

            const editPublikasi = (id) => {
                axios.get(`<?= base_url("api/datapublikasi?idPublikasi=") ?>${id}`).then(res => {
                    const data = res.data;
                    Swal.fire({
                        title: 'Edit Data Publikasi',
                        html: `
                    <form id="formPublikasi" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Judul</label>
                            <input class="form-control" name="judul" value='${data.judul}' required />
                        </div>
                        <div class="mb-1">
                            <label>Tahun Terbit</label>
                            <input type="number" class="form-control onlyYears" name="tahunTerbit" maxlength="4" value='${data.tahunTerbit}' required />
                        </div>
                        <div class="mb-1">
                            <label>Penerbit</label>
                            <input class="form-control" name="penerbit" value='${data.penerbit}' required />
                        </div>
                        <div class="mb-1">
                            <label>Jenis</label>
                            <input class="form-control" name="jenis" value='${data.jenis}' required />
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

                    $("#formPublikasi").submit(() => {
                        event.preventDefault();
                        const formData = new FormData($("#formPublikasi")[0]);
                        formData.append("editPublikasi", 1);
                        formData.append("lastFile", data.dokumen);
                        formData.append("id", id);
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
            }

            const hapusPublikasi = (id) => {
                Swal.fire({
                    title: 'Hapus Data Publikasi',
                    text: "Apakah anda yakin ingin menghapus data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!"
                }).then(result => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append("hapusPublikasi", 1);
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


            $("#tambahKesehatan").click(() => {
                Swal.fire({
                    title: 'Tambah Data Kesehatan',
                    html: `
                    <form id="formKesehatan" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Diagnosis</label>
                            <input class="form-control" name="diagnosis" required />
                        </div>
                        <div class="mb-1">
                            <label>Name of Hospital</label>
                            <input class="form-control" name="hospital" required />
                        </div>
                        <div class="mb-1">
                            <label>Date</label>
                            <input class="form-control" name="date" required />
                        </div>
                        <div class="mb-1">
                            <label>Notes</label>
                            <input class="form-control" name="notes" />
                        </div>
                        <div class="mb-1">
                            <label>Dokumen dari Rumah Sakit</label>
                            <input type="file" class="form-control" required name="fileData" accept="application/pdf" />
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

                $("#formKesehatan").submit(() => {
                    event.preventDefault();
                    const formData = new FormData($("#formKesehatan")[0]);
                    formData.append("tambahKesehatan", 1);
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

            const editKesehatan = (id) => {
                axios.get(`<?= base_url("api/datakesehatan?idKesehatan=") ?>${id}`).then(res => {
                    const data = res.data;
                    Swal.fire({
                        title: 'Edit Data Kesehatan',
                        html: `
                    <form id="formKesehatan" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>Diagnosis</label>
                            <input class="form-control" name="diagnosis" value='${data.diagnosis}' required />
                        </div>
                        <div class="mb-1">
                            <label>Name of Hospital</label>
                            <input class="form-control" name="hospital" value='${data.hospital}' required />
                        </div>
                        <div class="mb-1">
                            <label>Date</label>
                            <input class="form-control" name="date" value='${data.date}' required />
                        </div>
                        <div class="mb-1">
                        <label>Notes from Doctor</label>
                        <input class="form-control" name="notes" value='${data.notes}' />
                        </div>
                        <div class="mb-1">
                            <label>Document</label>
                            <input type="file" class="form-control" name="fileData" accept="application/pdf, image/png, image/jpeg" />
                            <small class="form-text text-muted">${data.dokumen}</small>
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

                    $("#formKesehatan").submit(() => {
                        event.preventDefault();
                        const formData = new FormData($("#formKesehatan")[0]);
                        formData.append("editKesehatan", 1);
                        formData.append("lastFile", data.dokumen);
                        formData.append("id", id);
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
            }

            const hapusKesehatan = (id) => {
                let tempData;
                axios.get(`<?= base_url("api/dataKesehatan") ?>?idKesehatan=${id}`).then(
                    res => {
                        tempData = res.data;
                        Swal.fire({
                            title: 'Hapus Data Kesehatan',
                            text: "Apakah anda yakin ingin menghapus data ini?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Ya, Hapus!"
                        }).then(result => {
                            if (result.isConfirmed) {
                                const formData = new FormData();
                                formData.append("hapusKesehatan", 1);
                                formData.append("id", id);
                                formData.append("lastFile", tempData.dokumen);
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
                    })
            }

            const editInformasi = (columnField) => {
                axios.get(`<?= base_url("api/informasinovisiattersiat?idAnggota=$dataPribadi->id") ?>`).then(res => {
                    const data = res.data;

                    Swal.fire({
                        title: "Edit Data Informasi Novisiat dan Tersiat",
                        html: `
                    <form id="formCatatanInformasi" class="px-1 mt-3" style="text-align: left !important" autocomplete="off">
                        <div class="mb-1">
                            <label>${columnField === "catatanPrimi" ? "Catatan Saat Primi" : (columnField === "catatanSecundi" ? "Catatan Saat Secundi" : "Catatan Saat Tersiat")}</label>
                            <input type="file" class="form-control" name="fileData" accept="application/pdf" required />
                            ${data[columnField] ? `<small class="form-text text-muted">${data[columnField]}</small>` : ""}
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

                    $("#formCatatanInformasi").submit(() => {
                        event.preventDefault();
                        const formData = new FormData($("#formCatatanInformasi")[0]);
                        formData.append("editInformasi", 1);
                        formData.append("columnField", columnField);
                        formData.append("idAnggota", "<?= $dataPribadi->id ?>")
                        axios.post("<?= base_url("api/informasinovisiattersiat") ?>", formData).then(
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
                })
            }

            const hapusInformasi = (columnField) => {
                axios.get(`<?= base_url("api/informasinovisiattersiat?idAnggota=$dataPribadi->id") ?>`).then(res => {
                    const data = res.data;

                    Swal.fire({
                        title: 'Hapus Data Informasi Novisiat dan Tersiat',
                        text: "Apakah anda yakin ingin menghapus data ini?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Hapus!"
                    }).then(result => {
                        if (result.isConfirmed) {
                            const formData = new FormData();
                            formData.append("deleteInformasi", 1);
                            formData.append("columnField", columnField);
                            formData.append("idAnggota", "<?= $dataPribadi->id ?>");
                            formData.append("lastFile", data[columnField]);
                            axios.post("<?= base_url("api/informasinovisiattersiat") ?>", formData).then(
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
                })
            }

            const simpanCatatan = (columnField) => {
                const catatan = columnField === "tersiat" ? $("#catatanTersiat").val() : $("#catatanNovisiat").val();
                const formData = new FormData();
                formData.append("editCatatan", 1);
                formData.append("columnField", columnField);
                formData.append("idAnggota", "<?= $dataPribadi->id ?>");
                formData.append("catatan", catatan);
                axios.post("<?= base_url("api/informasinovisiattersiat") ?>", formData).then(res => {
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
        </script>

    <?php endif; ?>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $css?>
    <?= $js?>
</head>

<style>
</style>

<body>
    <section class="form-title">
        <h1>FORMULIR PERMOHONAN IZIN</h1>
        <h1>BEPERGIAN KE LUAR NEGERI</h1>
    </section>
    <section class="nama-anggota">
        <p><b>Nama : <u><?= $formData->ndAnggota." ".$formData->nbAnggota ?></u></b></p>
    </section>
    <section class="content">
        <table>
            <tr>
                <td><b>1.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Kapan Anda berangkat ke luar negeri?</td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= date_format(date_create($formData->q1), 'd F Y') ?></td>
            </tr>
            <tr>
                <td><b>2.</td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Kapan Anda akan kembali ke Indonesia?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= date_format(date_create($formData->q2), 'd F Y') ?></td>
            </tr>
            <tr>
                <td><b>3.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Ke mana Anda ke luar negeri kali ini?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= $formData->q3 ?></td>
            </tr>
            <tr>
                <td><b>4.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Untuk keperluan apa Anda ke luar negeri kali ini?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= $formData->q4 ?></td>
            </tr>
            <tr>
                <td><b>5.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Lewat mana saja rute perjalanan Anda?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= $formData->q5 ?></td>
            </tr>
            <tr>
                <td><b>6.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Berapa kurang lebih biaya perjalanan serta biaya hidup selama di luar negeri dan bagamainana
                        rinciannya?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= $formData->q6 ?></td>
            </tr>
            <tr>
                <td><b>7.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Siapa yang akan menanggung biaya Anda kali ini?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= $formData->q7 ?></td>
            </tr>
            <?php if ($formData->q8 != "Superior"): ?>
            <tr>
                <td><b>8.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Bagaimana urusan pekerjaan selama Anda di luar negeri?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= $formData->q9 ?></td>
            </tr>
            <tr>
                <td><b>9.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Sebelum ini, kapan Anda terakhir ke luar negeri? Dari (tanggal/bulan/tahun) hingga
                        (tanggal/bulan/tahun)? Ke mana? Untuk keperluan apa? Siapa sponsornya?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= $formData->q10 ?></td>
            </tr>
            <tr>
                <td><b>10.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Apakah Anda membutuhkan Affidavit dan/atau Surat Keterangan Bank?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= $formData->q11 ?></td>
            </tr>
            <?php else:?>
                <tr>
                <td><b>8.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Bagaimana urusan pekerjaan selama Anda di luar negeri?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= $formData->q9 ?></td>
            </tr>
            <tr>
                <td><b>9.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Sebelum ini, kapan Anda terakhir ke luar negeri? Dari (tanggal/bulan/tahun) hingga
                        (tanggal/bulan/tahun)? Ke mana? Untuk keperluan apa? Siapa sponsornya?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= $formData->q10 ?></td>
            </tr>
            <tr>
                <td><b>10.</b></td>
                <td><b>Pertanyaan<b></td>
                <td><b> : <b></td>
                <td><b>Apakah Anda membutuhkan Affidavit dan/atau Surat Keterangan Bank?</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban</td>
                <td> : </td>
                <td><?= $formData->q11 ?></td>
            </tr>
            <?php endif; ?>
            
        </table>
    </section>
    
    <section class="tanggal-submit">
        <table>
        <?php if ($formData->q8 != "Superior"): ?>
            <tr>
                <td>Tanggal dikirim ke Superior</td>
                <td> : </td>
                <td><?= !empty($formData->tsToSuperior) ? date_format(date_create($formData->tsToSuperior), 'd F Y') : "-" ?>
                </td>
            </tr>
        <?php endif; ?>
            <tr>
                <td>Tanggal dikirim ke Provinsial</td>
                <td> : </td>
                <td><?= !empty($formData->tsToProvinsial) ? date_format(date_create($formData->tsToProvinsial), 'd F Y') : "-" ?>
                </td>
            </tr>
        </table>
    </section>
    <?php if ($formData->q8 != "Superior"): ?>
    <section class="tanggapan-persetujuan">
        <h3>Tanggapan dan Persetujuan Superior</h3>
        <p><?= !empty($formData->tanggapanSuperior) ? $formData->tanggapanSuperior : "<em>(belum ada tanggapan)</em>" ?>
        </p>
        <?php if(!empty($formData->tanggapanSuperior) || $formData->statusSuperior): ?>
        <p>Dengan ini saya selaku superior komunitas <?= $formData->komunitas ?>,
            <?= $formData->statusSuperior ? "" : "tidak" ?> menyetujui keberangkatan
            <?= $formData->ndAnggota." ".$formData->nbAnggota ?>.</p>
        <?php endif; ?>
    </section>
    <?php endif; ?>
    <section class="tanggapan-persetujuan">
        <h3>Tanggapan dan Persetujuan Pater Provinsial</h3>
        <p><?= !empty($formData->tanggapanProvinsial) ? $formData->tanggapanProvinsial : "<em>(belum ada tanggapan)</em>" ?>
        </p>
        <?php if(!empty($formData->tanggapanProvinsial) || $formData->statusProvinsial): ?>
        <p>Dengan ini saya selaku pater provinsial, <?= $formData->statusProvinsial ? "" : "tidak" ?> menyetujui
            keberangkatan
            <?= $formData->ndAnggota." ".$formData->nbAnggota ?>.</p>
        <?php endif; ?>
    </section>
    <i class="fa fa-trash"></i>
</body>

</html>
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
     <style>
        .chart-container {
            position: relative;
            margin: auto;
            height: 400px;  /* Sesuaikan tinggi */
            width: 400px;   /* Sesuaikan lebar */
        }
    </style>
</head>

<body>
    <?= $navbar?>
   <div class="container px-4 px-md-0">
        <div>
            <h2 class="text-center mb-3">Statistik</h2>
             <div class="row">
                <div class="col-md-6">
                    <canvas id="umurChart"></canvas>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rentang Umur</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($umurAnggota as $rentang => $jumlah) : ?>
                                <tr>
                                    <td><?php echo $rentang; ?></td>
                                    <td><?php echo $jumlah; ?></td>
                                </tr>
                            <?php endforeach; ?>
                                 <tr>
                                    <td>Total</td>
                                    <td><?php echo $jumlahJesuit; ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="chart-container">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Dekad</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($anggotaPerDekad as $dekad => $jumlah) : ?>
                                <tr>
                                    <td><?php echo $dekad; ?></td>
                                    <td><?php echo $jumlah; ?></td>
                                </tr>
                            <?php endforeach; ?>
                                 <tr>
                                    <td>Total</td>
                                    <td><?php echo $jumlahJesuit; ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="chart-container">
                        <canvas id="anggotaChart"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>Status Keanggotaan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jumlahAnggota as $status => $jumlah) : ?>
                                <tr>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $jumlah; ?></td>
                                </tr>
                                
                            <?php endforeach; ?>
                                <tr>
                                    <td>Total</td>
                                    <td><?php echo $jumlahJesuit; ?></td>
                                </tr>
                        </tbody>
                </table>
                </div>
            </div>

            <!-- Menampilkan anggota per status keanggotaan -->
           
        </div>

    </div>
     
      
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       <script>
                var ctx = document.getElementById('umurChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode(array_keys($umurAnggota)); ?>,
                        datasets: [{
                            label: 'Jumlah Anggota',
                            data: <?php echo json_encode(array_values($umurAnggota)); ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)', // 18-22
                                'rgba(54, 162, 235, 0.2)', // 23-27
                                'rgba(255, 206, 86, 0.2)', // 28-32
                                'rgba(75, 192, 192, 0.2)', // 33-37
                                'rgba(153, 102, 255, 0.2)', // 38-42
                                'rgba(255, 159, 64, 0.2)', // 43-47
                                'rgba(220, 220, 220, 0.2)', // 48-52
                                'rgba(176, 224, 230, 0.2)', // 53-57
                                'rgba(135, 206, 235, 0.2)', // 58-62
                                'rgba(102, 102, 153, 0.2)', // 63-67
                                'rgba(255, 215, 0, 0.2)', // 68-72
                                'rgba(128, 0, 0, 0.2)' // 72++
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)', // 18-22
                                'rgba(54, 162, 235, 1)', // 23-27
                                'rgba(255, 206, 86, 1)', // 28-32
                                'rgba(75, 192, 192, 1)', // 33-37
                                'rgba(153, 102, 255, 1)', // 38-42
                                'rgba(255, 159, 64, 1)', // 43-47
                                'rgba(220, 220, 220, 1)', // 48-52
                                'rgba(176, 224, 230, 1)', // 53-57
                                'rgba(135, 206, 235, 1)', // 58-62
                                'rgba(102, 102, 153, 1)', // 63-67
                                'rgba(255, 215, 0, 1)', // 68-72
                                'rgba(128, 0, 0, 1)' // 72++
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Jumlah Anggota Jesuit Menurut Rentang Usia'
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode(array_keys($anggotaPerDekad)); ?>,
                        datasets: [{
                            label: 'Jumlah Anggota',
                            data: <?php echo json_encode(array_values($anggotaPerDekad)); ?>,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Jumlah Anggota Jesuit per 10 Tahun kelahiran'
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
            
            <script>
                var ctx = document.getElementById('anggotaChart').getContext('2d');
                var anggotaChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: <?php echo json_encode(array_keys($jumlahAnggota)); ?>,
                        datasets: [{
                            label: 'Jumlah Anggota',
                            data: <?php echo json_encode(array_values($jumlahAnggota)); ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Anggota Per Status Keanggotaan'
                            }
                        }
                    }
                });
            </script>
    <?= $footer ?>
</body>

</html>
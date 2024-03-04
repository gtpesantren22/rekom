<?php $this->load->view('head'); ?>
<link rel="stylesheet" href="<?= base_url('assets/apex-charts/apexcharts.css') ?>">

<div class="container mt-3">
    <h3 class="text-center">Selamat Datang, <?= $user->nama ?></h3>
    <!-- <h5 class="text-center text-success"></h5> -->
    <p class="text-center">Aplikasi Rekomendasi Liburan Santri</p>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Santri Putra</h5>
                    <div id="putra"></div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Prosentase Pelunasan Santri Putra</h5>
                    <div id="putraDetail"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Santri Putri</h5>
                    <div id="putri"></div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Prosentase Pelunasan Santri Putri</h5>
                    <div id="putriDetail"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('foot'); ?>
<script src="<?= base_url('assets/apex-charts/apexcharts.min.js') ?>"></script>
<script>
    var options = {
        series: [{
            name: 'Pelunasan',
            data: [<?= $putraLunas ?>, <?= $putraBelum ?>]
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                    position: 'top', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return val + "%";
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },

        xaxis: {
            categories: ["Lunas", "Belum"],
            position: 'top',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function(val) {
                    return val + "%";
                }
            }

        },
        title: {
            text: 'Pelunasan tanggungan santri putra',
            floating: true,
            offsetY: 330,
            align: 'center',
            style: {
                color: '#444'
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#putra"), options);
    chart.render();
</script>
<script>
    var options = {
        series: [{
            name: 'LUNAS',
            data: [
                <?php
                $tindakan = $this->db->query("SELECT id_tindakan FROM tindakan WHERE jkl = 'Laki-laki' ")->result();
                foreach ($tindakan as $tindak) {
                    $hasil = $this->db->query("SELECT nis FROM rekap JOIN tindakan ON rekap.id_tindakan=tindakan.id_tindakan WHERE jkl = 'Laki-laki' AND nominal != 0 AND status = 'lunas' AND rekap.id_tindakan = '$tindak->id_tindakan' ")->num_rows();
                    echo $hasil . ',';
                }
                ?>
            ]
        }, {
            name: 'BELUM',
            data: [
                <?php
                $tindakan = $this->db->query("SELECT id_tindakan FROM tindakan WHERE jkl = 'Laki-laki' ")->result();
                foreach ($tindakan as $tindak) {
                    $hasil = $this->db->query("SELECT nis FROM rekap JOIN tindakan ON rekap.id_tindakan=tindakan.id_tindakan WHERE jkl = 'Laki-laki' AND nominal != 0 AND status = 'belum' AND rekap.id_tindakan = '$tindak->id_tindakan' ")->num_rows();
                    echo $hasil . ',';
                }
                ?>
            ]
        }, ],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            stackType: '100%'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        xaxis: {
            categories: [
                <?php
                $tindakan = $this->db->query("SELECT nama FROM tindakan WHERE jkl = 'Laki-laki' ")->result();
                foreach ($tindakan as $tindak) {
                    echo "'" . $tindak->nama . "'" . ',';
                }
                ?>
            ],
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'right',
            offsetX: 0,
            offsetY: 50
        },
    };

    var chart = new ApexCharts(document.querySelector("#putraDetail"), options);
    chart.render();
</script>

<script>
    var options = {
        series: [{
            name: 'Pelunasan',
            data: [<?= $putriLunas ?>, <?= $putriBelum ?>]
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                    position: 'top', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return val + "%";
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },

        xaxis: {
            categories: ["Lunas", "Belum"],
            position: 'top',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function(val) {
                    return val + "%";
                }
            }

        },
        title: {
            text: 'Pelunasan tanggungan santri putri',
            floating: true,
            offsetY: 330,
            align: 'center',
            style: {
                color: '#444'
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#putri"), options);
    chart.render();
</script>
<script>
    var options = {
        series: [{
            name: 'LUNAS',
            data: [
                <?php
                $tindakan = $this->db->query("SELECT id_tindakan FROM tindakan WHERE jkl = 'Laki-laki' ")->result();
                foreach ($tindakan as $tindak) {
                    $hasil = $this->db->query("SELECT nis FROM rekap JOIN tindakan ON rekap.id_tindakan=tindakan.id_tindakan WHERE jkl = 'Laki-laki' AND nominal != 0 AND status = 'lunas' AND rekap.id_tindakan = '$tindak->id_tindakan' ")->num_rows();
                    echo $hasil . ',';
                }
                ?>
            ]
        }, {
            name: 'BELUM',
            data: [
                <?php
                $tindakan = $this->db->query("SELECT id_tindakan FROM tindakan WHERE jkl = 'Laki-laki' ")->result();
                foreach ($tindakan as $tindak) {
                    $hasil = $this->db->query("SELECT nis FROM rekap JOIN tindakan ON rekap.id_tindakan=tindakan.id_tindakan WHERE jkl = 'Laki-laki' AND nominal != 0 AND status = 'belum' AND rekap.id_tindakan = '$tindak->id_tindakan' ")->num_rows();
                    echo $hasil . ',';
                }
                ?>
            ]
        }, ],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            stackType: '100%'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        xaxis: {
            categories: [
                <?php
                $tindakan = $this->db->query("SELECT nama FROM tindakan WHERE jkl = 'Laki-laki' ")->result();
                foreach ($tindakan as $tindak) {
                    echo "'" . $tindak->nama . "'" . ',';
                }
                ?>
            ],
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'right',
            offsetX: 0,
            offsetY: 50
        },
    };

    var chart = new ApexCharts(document.querySelector("#putriDetail"), options);
    chart.render();
</script>
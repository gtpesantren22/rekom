<?php $this->load->view('head'); ?>

<style>
    #loading-indicator {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 4px solid #fff;
        border-top-color: #007bff;
        animation: spin 1s infinite linear;
    }

    @keyframes spin {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }
</style>

<!-- Spinner loader -->
<div id="loading-indicator">
    <div class="spinner"></div>
</div>

<div class="container mt-3">
    <div class="card">
        <h5 class="card-header">
            Detail Tanggungan Santri
            <button href="#" class="btn btn-success btn-sm confirm-act float-right" value="<?= $id_tindakan ?>"><i class="fa fa-envelope"></i> Sinkron Data ke Aplikasi Santri</button>
        </h5>
        <div class="card-body">
            <!-- <h5 class="card-title">Data Santri Putra</h5> -->
            <div class="table-responsive">
                <table class="table table-sm datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Tanggungan</th>
                            <th>Nominal</th>
                            <!-- <th colspan="2">Ket</th> -->
                            <!-- <th>Lunas</th> -->
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data as $dt) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $dt->nis ?></td>
                                <td><?= $dt->names ?></td>
                                <td><?= $dt->tindakan ?></td>
                                <td><?= rupiah($dt->nominal) ?></td>
                                <!-- <td><?= $dt->ket ?></td>
                                <td><?= $dt->status == 'lunas' ? "<span class='badge badge-success'><i class='fa fa-check'></i></span>" : "<span class='badge badge-danger'><i class='fa fa-times'></i></span>" ?></td> -->
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Act
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="<?= base_url("listdata/edit/$dt->id_rekap") ?>">Edit</a>
                                            <!-- <a class="dropdown-item tbl-confirm" value="Tanggungan akan dilunasi" href="<?= base_url("listdata/lunas/$dt->id_rekap") ?>">Lunas</a> -->
                                            <!-- <a class="dropdown-item tombol-hapus" href="<?= base_url('listdata/delRekap/' . $dt->id_rekap) ?>">Hapus</a> -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('foot'); ?>

<script>
    $(document).ready(function() {
        $('.confirm-act').on('click', function(e) {

            e.preventDefault();
            const hreh = $(this).attr('href');
            const isi = 'Data ini akan dikirimkan ke aplikasi wali santri dan membutuhkan waktu';
            const id = $(this).attr('value');

            iziToast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Yakin ?',
                message: isi,
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', function(instance, toast) {
                        // document.location.href = hreh
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                        showLoadingIndicator();
                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('listdata/sinkron') ?>',
                            dataType: 'json',
                            data: {
                                id_tindakan: id,
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    hideLoadingIndicator();
                                    iziToast.success({
                                        title: 'Berhasil',
                                        message: response.pesan,
                                        position: 'topRight',
                                    });
                                } else {
                                    hideLoadingIndicator();
                                    iziToast.error({
                                        title: 'Gagal',
                                        message: response.pesan,
                                        position: 'topRight',
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                hideLoadingIndicator();
                                console.log('Gagal menyimpan data. Kesalahan: ' + status + ' - ' + error);
                            }
                        })
                    }, true],
                    ['<button>NO</button>', function(instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');
                    }],
                ],
            });

        });
    })

    function showLoadingIndicator() {
        document.getElementById('loading-indicator').style.display = 'block';
    }

    // Menyembunyikan indikator loading setelah proses Ajax selesai
    function hideLoadingIndicator() {
        document.getElementById('loading-indicator').style.display = 'none';
    }
</script>
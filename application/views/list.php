<?php $this->load->view('head'); ?>

<div class="container mt-3">
    <div class="card">
        <h5 class="card-header">Data List Tanggungan Santri</h5>
        <div class="card-body">
            <!-- <h5 class="card-title">Data Santri Putra</h5> -->
            <div class="table-responsive">
                <table class="table table-sm datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>PJ</th>
                            <th>Ket</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data as $dt) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $dt->nama ?></td>
                                <td><?= $dt->pj ?></td>
                                <td><?= $dt->jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?></td>
                                <td>
                                    <?php if ($user->id_user === $dt->id_user || $user->level == 'admin') : ?>
                                        <a href="<?= base_url("listdata/detail/$dt->id_tindakan") ?>" class="btn btn-warning btn-sm"><i class="fa fa-list"></i> Lihat List Santri</a>
                                        <a href="<?= base_url("listdata/del/$dt->id_tindakan") ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-times"></i> Drop</a>
                                    <?php endif ?>
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
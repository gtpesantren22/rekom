<?php $this->load->view('head'); ?>

<div class="container mt-3">
    <div class="card">
        <h5 class="card-header">Data Santri</h5>
        <div class="card-body">
            <!-- <h5 class="card-title">Data Santri Putra</h5> -->
            <div class="table-responsive">
                <table class="table table-sm datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Kelas</th>
                            <th>Kamar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data as $dt) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $dt->nama ?></td>
                                <td><?= $dt->desa . '-' . $dt->kec ?></td>
                                <td><?= $dt->k_formal . '-' . $dt->t_formal ?></td>
                                <td><?= $dt->kamar ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('foot'); ?>
<?php $this->load->view('head'); ?>

<div class="container mt-3">
    <div class="card">
        <h5 class="card-header">
            Data Santri
            <button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#staticBackdrop">Tambah Data</button>
        </h5>
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
                                        <a href="<?= base_url("tanggungan/del/$dt->id_tindakan") ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Del</a>
                                        <a href="<?= base_url("tanggungan/conv/$dt->id_tindakan") ?>" class="btn btn-primary btn-sm"><i class="fa fa-exchange"></i> Konversi</a>
                                        <a href="<?= base_url("tanggungan/generate/$dt->id_tindakan") ?>" class="btn btn-info btn-sm tbl-confirm" value="Generete tanggungan untuk semua santri"><i class="fa fa-refresh"></i> Generate</a>
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
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('tanggungan/add') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Tanggungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Tanggungan</label>
                        <input type="text" name="nama" id="nama" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pj">Penanggung Jawab</label>
                        <input type="text" name="pj" id="pj" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jkl">Keterangan</label>
                        <select name="jkl" id="jkl" required class="form-control">
                            <option value=""> -pilih- </option>
                            <option value="Laki-laki"> Putra </option>
                            <option value="Perempuan"> Putri </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('foot'); ?>
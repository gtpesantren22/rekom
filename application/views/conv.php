<?php $this->load->view('head'); ?>

<div class="container mt-3">
    <div class="card">
        <h5 class="card-header">
            Data Konversi Tindakan
            <button class="btn btn-sm btn-warning float-right" onclick="window.location='<?= base_url($data->jkl == 'Laki-laki' ? 'tanggungan/putra' : 'tanggungan/putri') ?>' ">Kembali</button>
        </h5>
        <div class="card-body">
            <!-- <h5 class="card-title">Data Santri Putra</h5> -->
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm">
                        <tr>
                            <th>Nama Tindakan</th>
                            <td><?= $data->nama ?></td>
                        </tr>
                        <tr>
                            <th>PJ</th>
                            <td><?= $data->pj ?></td>
                        </tr>
                        <tr>
                            <th>Ket</th>
                            <td><?= $data->jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?></td>
                        </tr>
                    </table>
                    <form action="<?= base_url('tanggungan/addConv') ?>" method="post">
                        <input type="hidden" name="id_tindakan" value="<?= $data->id_tindakan ?>">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control uang" id="nominal" name="nominal" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ket" class="col-sm-3 col-form-label">Ket</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ket" name="ket">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-sm ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Ket</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($conversi as $dt) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $dt->nama ?></td>
                                        <td><?= rupiah($dt->nominal) ?></td>
                                        <td><?= $dt->ket ?></td>
                                        <td>
                                            <a href="<?= base_url("tanggungan/delConv/$dt->id_konversi") ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Del</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view('foot'); ?>
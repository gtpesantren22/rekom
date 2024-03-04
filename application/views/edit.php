<?php $this->load->view('head'); ?>
<link rel="stylesheet" href="<?= base_url('assets/select2/css/select2.min.css') ?>">
<div class="container mt-3">
    <div class="card">
        <h5 class="card-header">
            Edit Tanggungan Santri
            <button class="btn btn-info btn-sm float-right" onclick="window.location='<?= base_url('listdata/detail/' . $tindakan->id_tindakan) ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
            <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus-circle"></i> Tambah Tanggungan</button>
        </h5>
        <div class="card-header">
            <select name="" id="selectOptions" class="form-control form-control-sm select2" onchange="gantiSantri()">
                <option value=""> -ganti santri- </option>
                <?php foreach ($santriRekap as $str) : ?>
                    <option value="<?= base_url('listdata/edit/' . $str->id_rekap) ?>"><?= $str->nama ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Identitas Santri</h5>
                    <table class="table table-sm">
                        <tr>
                            <td>NIS</td>
                            <td>:</td>
                            <td><?= $santri->nis ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $santri->nama ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $santri->desa . '-' . $santri->kec ?></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td><?= $santri->k_formal . '-' . $santri->t_formal ?></td>
                        </tr>
                        <tr>
                            <td>Kamar</td>
                            <td>:</td>
                            <td><?= $santri->kamar ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Informasi Tanggungan</h5>
                    <table class="table table-sm">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $tindakan->nama ?></td>
                        </tr>
                        <tr>
                            <td>PJ</td>
                            <td>:</td>
                            <td><?= $tindakan->pj ?></td>
                        </tr>
                        <tr>
                            <td>Ket</td>
                            <td>:</td>
                            <td><?= $tindakan->jkl == 'Laki-laki' ? 'Putra' : 'Putri' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table-sm table">
                            <thead>
                                <tr>
                                    <th>Ket</th>
                                    <th>Nominal</th>
                                    <th>Total</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataRekap as $dtr) : ?>
                                    <tr>
                                        <td><?= $dtr->status == 'lunas' ? "<span class='badge badge-success'><i class='fa fa-check-circle'></i></span>" : "<span class='badge badge-danger'><i class='fa fa-times-circle'></i></span>" ?>
                                            <?= $dtr->nama ?>
                                        </td>
                                        <td><?= number_format($dtr->nominal) . ' x ' . $dtr->jumlah ?></td>
                                        <td><?= rupiah($dtr->nominal * $dtr->jumlah) ?></td>
                                        <td>
                                            <a href="<?= base_url('listdata/delRekap/' . $dtr->id_rekap) ?>" class="btn btn-sm btn-danger tombol-hapus"><i class="fa fa-trash"></i></a>
                                            <a value="Tanggungan akan dilunasi" href="<?= base_url("listdata/lunas/$dtr->id_rekap") ?>" class="btn btn-sm btn-info tbl-confirm"><i class="fa fa-money"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5>List daftar konversi</h5>
                    <div class="table-responsive">
                        <table class="table-sm table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Ket</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($konversi as $konv) : ?>
                                    <tr>
                                        <td><?= $konv->nama ?></td>
                                        <td><?= rupiah($konv->nominal) ?></td>
                                        <td><?= $konv->ket ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#Coba<?= $konv->id_konversi ?>"><i class="fa fa-check"></i></button>
                                            <div class="modal fade" id="Coba<?= $konv->id_konversi ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="<?= base_url('listdata/addKonv') ?>" method="post">
                                                            <input type="hidden" name="id_tindakan2" value="<?= $tindakan->id_tindakan ?>">
                                                            <input type="hidden" name="id_konversi" value="<?= $konv->id_konversi ?>">
                                                            <input type="hidden" name="nis2" value="<?= $rekap->nis ?>">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Tanggungan</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="nama">Nama Tanggungan : <b><?= $konv->nama ?></b></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="pj">Nominal : <b><?= rupiah($konv->nominal) ?></b></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama">Keterangan : <b><?= $konv->ket ?></b></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jumlah">Jumlah</label>
                                                                    <input type="number" class="form-control form-control-sm" name="jumlah" id="jumlah" value="1" required>
                                                                </div>
                                                            </div>
                                                            <div class=" modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('listdata/add') ?>" method="post">
                <input type="hidden" name="id_tindakan2" value="<?= $tindakan->id_tindakan ?>">
                <input type="hidden" name="nis2" value="<?= $rekap->nis ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Tanggungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Tanggungan : <b><?= $tindakan->nama ?></b></label>
                    </div>
                    <div class="form-group">
                        <label for="pj">Penanggung Jawab : <b><?= $tindakan->pj ?></b></label>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="text" class="form-control form-control-sm uang" name="nominal2" id="nominal" required>
                    </div>
                    <div class="form-group">
                        <label for="ket">Keterangan</label>
                        <textarea class="form-control form-control-sm" name="ket2" id="ket" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ket">Status</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="status2" class="custom-control-input" value="belum">
                            <label class="custom-control-label" for="customRadio1">Belum</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="status2" class="custom-control-input" value="lunas">
                            <label class="custom-control-label" for="customRadio2">Lunas</label>
                        </div>
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
<!-- <form action="<?= base_url('listdata/editSave') ?>" method="post">
    <input type="hidden" name="id" value="<?= $rekap->id_rekap ?>">
    <div class="form-group">
        <label for="nominal">Nominal</label>
        <input type="text" class="form-control form-control-sm uang" name="nominal" id="nominal" value="<?= $rekap->nominal ?>" required>
    </div>
    <div class="form-group">
        <label for="ket">Keterangan</label>
        <textarea class="form-control form-control-sm" name="ket" id="ket" rows="3" required><?= $rekap->ket ?></textarea>
    </div>
    <div class="form-group">
        <label for="ket">Status</label>
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio1" name="status" class="custom-control-input" <?= $rekap->status == 'belum' ? 'checked' : '' ?> value="belum">
            <label class="custom-control-label" for="customRadio1">Belum</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio2" name="status" class="custom-control-input" <?= $rekap->status == 'lunas' ? 'checked' : '' ?> value="lunas">
            <label class="custom-control-label" for="customRadio2">Lunas</label>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
    </div>
</form> -->
<?php $this->load->view('foot'); ?>
<script src="<?= base_url('assets/select2/js/select2.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

    function gantiSantri() {
        var selectElement = document.getElementById('selectOptions');
        var selectedValue = selectElement.value;

        // Periksa apakah nilai terpilih adalah tautan yang valid
        if (selectedValue) {
            // Buka tautan pada tab atau jendela baru
            window.location.href = selectedValue;
        }
    }
</script>
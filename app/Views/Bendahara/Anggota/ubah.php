<?= $this->extend('Component/template') ?>
<?= $this->section('content') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Ubah Anggota Koperasi</h3>
                            </div>
                            <?= $validation->listErrors(); ?>
                            <form action="/anggota/update/<?= $anggota['id'] ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $anggota['id'] ?>">
                                <input type="hidden" name="fotoLama" value="<?= $anggota['foto'] ?>">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="kode">Kode Anggota</label>
                                        <input type="text" class="form-control" name="kode" value="<?= (old('kode')) ? old('kode') : $anggota['kode'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama" value="<?= (old('nama')) ? old('nama') : $anggota['nama'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control" name="nip" value="<?= (old('nip')) ? old('nip') : $anggota['nip'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">
                                            <option selected disabled>Silahkan Pilih</option>
                                            <option value="laki-laki">Laki - laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $anggota['alamat'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_fakultas">Fakultas</label>
                                        <select class="custom-select" id="id_fakultas" name="id_fakultas">
                                            <option selected disabled>Silahkan Pilih</option>
                                            <option value="laki-laki">Laki - laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_gabung">Tanggal bergabung</label>
                                        <input type="date" class="form-control" name="tanggal_gabung" value="<?= (old('tanggal_gabung')) ? old('tanggal_gabung') : $anggota['tanggal_gabung'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" name="status" value="<?= (old('status')) ? old('status') : $anggota['status'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="preview_gambar">Preview Gambar</label>
                                        <img src="/ProfilAnggota/<?= $anggota['foto'] ?>" class="img-thumbnail img-preview" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label for="profil_anggota">Upload Gambar</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                            <label class="custom-file-label" for="foto"><?= $anggota['foto'] ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
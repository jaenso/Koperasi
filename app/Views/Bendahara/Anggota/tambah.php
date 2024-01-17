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
                                <h3 class="card-title">Tambah Anggota Koperasi</h3>
                            </div>
                            <?= $validation->listErrors(); ?>
                            <form action="/anggota/simpan" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="kode">Kode Anggota</label>
                                        <input type="text" class="form-control" name="kode" id="kode_anggota">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP">
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
                                        <input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_fakultas">Fakultas</label>
                                        <select class="custom-select" id="id_fakultas" name="id_fakultas" onchange="updateKodeAnggota()">
                                            <option selected disabled>Silahkan Pilih</option>
                                            <?php foreach ($fakultas as $fkt) : ?>
                                                <option value="<?= $fkt['id'] ?>" data-kode="<?= $fkt['kode'] ?>"><?= $fkt['kode'] ?> - <?= $fkt['fakultas'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_gabung">Tanggal bergabung</label>
                                        <input type="date" class="form-control" name="tanggal_gabung">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" name="status">
                                    </div>
                                    <div class="form-group">
                                        <label for="preview_gambar">Preview Gambar</label>
                                        <img src="/ProfilAnggota/default.png" class="img-thumbnail img-preview" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label for="profil_anggota">Upload Gambar</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                            <label class="custom-file-label" for="foto">Choose file</label>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function updateKodeAnggota() {
        var selectedOption = $("#id_fakultas option:selected");
        var kodeFakultas = selectedOption.data('kode');
        var randomKode = generateRandomCode();
        var kodeAnggota = kodeFakultas + '-' + randomKode;
        $("#kode_anggota").val(kodeAnggota);
    }

    function generateRandomCode() {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var randomCode = '';
        for (var i = 0; i < 6; i++) {
            var randomIndex = Math.floor(Math.random() * characters.length);
            randomCode += characters.charAt(randomIndex);
        }
        return randomCode;
    }
</script>
<?= $this->endSection() ?>
<?= $this->extend('Component/template') ?>
<?= $this->section('content') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>
                        <a href="/anggota/tambah" class="btn btn-success mb-3">Tambah</a>
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Fakultas</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Status</th>
                                    <th>Profil</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            $i = 1;
                            foreach ($anggota as $agt) : ?>
                                <tbody>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $agt['kode'] ?></td>
                                        <td><?= $agt['nama'] ?></td>
                                        <td><?= $agt['nip'] ?></td>
                                        <td><?= $agt['jenis_kelamin'] ?></td>
                                        <td><?= $agt['alamat'] ?></td>
                                        <td><?= $agt['id_fakultas'] ?></td>
                                        <td><?= $agt['tanggal_gabung'] ?></td>
                                        <td><?= $agt['status'] ?></td>
                                        <td><img class="img-thumbnail" src="<?= base_url('ProfilAnggota/' . $agt['foto']) ?>" alt=""></td>
                                        <td>
                                            <a href="/anggota/edit/<?= $agt['id'] ?>" class="btn btn-warning">Edit</a>
                                            <a href="/anggota/<?= $agt['id'] ?>" class="btn btn-primary">Detail</a>
                                            <form action="/anggota/<?= $agt['id'] ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm ('Apakah anda yakin?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
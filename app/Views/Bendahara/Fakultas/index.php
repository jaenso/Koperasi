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
                        <a href="/fakultas/tambah" class="btn btn-success mb-3">Tambah</a>
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Fakultas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            $i = 1;
                            foreach ($fakultas as $fkt) : ?>
                                <tbody>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $fkt['kode'] ?></td>
                                        <td><?= $fkt['fakultas'] ?></td>
                                        <td>
                                            <a href="/fakultas/edit/<?= $fkt['id'] ?>" class="btn btn-warning">Edit</a>
                                            <a href="/fakultas/<?= $fkt['id'] ?>" class="btn btn-primary">Detail</a>
                                            <form action="/fakultas/<?= $fkt['id'] ?>" method="post" class="d-inline">
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
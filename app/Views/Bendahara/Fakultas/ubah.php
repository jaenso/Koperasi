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
                                <h3 class="card-title">Ubah Fakultas</h3>
                            </div>
                            <?= $validation->listErrors(); ?>
                            <form action="/fakultas/update/<?= $fakultas['id'] ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $fakultas['id'] ?>">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="kode">Kode</label>
                                        <input type="text" class="form-control" name="kode" value="<?= (old('kode')) ? old('kode') : $fakultas['kode'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="fakultas">Fakultas</label>
                                        <input type="text" class="form-control" name="fakultas" value="<?= (old('fakultas')) ? old('fakultas') : $fakultas['fakultas'] ?>">
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
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1>Edit Mata Kuliah</h1>

    <?php if (session()->has('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/mata-kuliah/<?= $mata_kuliah['id'] ?>" method="post">
        
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $mata_kuliah['name'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="credits" class="form-label">Credits</label>
            <input type="number" step="0.01" class="form-control" id="credits" name="credits" value="<?= $mata_kuliah['credits'] ?>" required>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
            Update
        </button>

        <!-- Update Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Confirm Update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to update this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

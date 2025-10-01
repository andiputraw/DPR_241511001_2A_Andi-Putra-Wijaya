<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1>Mata Kuliah</h1>
    <a href="/mata-kuliah/new" class="btn btn-primary mb-3">Create Mata Kuliah</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Credits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mata_kuliah as $mk): ?>
                <tr>
                    <td><?= $mk['id'] ?></td>
                    <td > <a href="/mata-kuliah/<?= $mk['id'] ?>"><?= $mk['name'] ?></a> </td>
                    <td><?= $mk['credits'] ?></td>
                    <td>
                        <a href="/mata-kuliah/<?= $mk['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $mk['id'] ?>">
                            Delete
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal-<?= $mk['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel-<?= $mk['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel-<?= $mk['id'] ?>">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this item?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="/mata-kuliah/<?= $mk['id'] ?>" method="post" >
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>

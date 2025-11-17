<main>
    <div class="itso-container">
        <h2>Edit User</h2>
        <form class="w-50">
            <div class="mb-3"><label class="form-label">Full Name</label><input class="form-control" value="Sample Name" /></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" value="sample@feutech.edu.ph" /></div>
            <div class="mb-3"><label class="form-label">Role</label>
                <select class="form-select"><option selected>Associate</option><option>ITSO Personnel</option><option>Student</option></select>
            </div>
            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('users') ?>" class="btn btn-secondary me-2">&larr; Back</a>
                <button class="btn btn-success">Save Changes</button>
            </div>
        </form>
    </div>
</main>

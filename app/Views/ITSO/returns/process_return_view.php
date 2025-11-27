<main>
    <div class="itso-container">
        <h2>Process Return</h2>
         <?php
        if(session('errors')):
        ?>
        <div class="alert alert-danger">
            <p><?= implode('<br>', session('errors')) ?></p>
        </div>
        <?php
        endif;
        ?>
        <form class="w-50" method="POST" action="/itso/returns/completeReturn" >
            <div class="mb-3"><label class="form-label">Email</label><input class="form-control" name="email" type="email" /></div>
            <div class="mb-3"><label class="form-label">Condition</label>
                <select class="form-select" name="condition"><option>Good</option><option>Damaged</option><option>Missing Accessory</option></select>
            </div>
            <p class="text-muted">Note: an email would be sent to the borrower upon processing.</p>
            <div class="mt-3 d-flex justify-content-end">
                <a href="<?= base_url('returns') ?>" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <button class="btn btn-success" type="submit">
                    <i class="bi bi-check-circle"></i> Complete Return
                </button>
            </div>
        </form>
    </div>
</main>

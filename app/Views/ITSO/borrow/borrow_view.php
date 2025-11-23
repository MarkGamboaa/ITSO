<main>
    <div class="itso-container">
        <h2>Borrow Item</h2>
        <?php
        if(session('errors')):
        ?>
        <div class="alert alert-danger">
            <p><?= implode('<br>', session('errors')) ?></p>
        </div>
        <?php
        endif;
        ?>
        <form class="w-50" method="post" action="<?= base_url('borrowing/insert') ?>">
            <div class="mb-3"><label class="form-label">Borrower (Associate / Student)</label><input class="form-control" name="email" /></div>
            <div class="mb-3"><label class="form-label">Item</label><input class="form-control" name="equipment_id" placeholder="EQ-001 - Laptop" /></div>
            <div class="mb-3"><label class="form-label">Quantity</label><input class="form-control" type="number" name="borrow_quantity" value="1" min="1" /></div>
            <p class="text-muted">Note: when an item is borrowed, an email would be sent.</p>
            <div class="mt-3 d-flex justify-content-start">
                <a href="<?= base_url('borrowing') ?>" class="btn btn-secondary me-2">&larr; Back</a>
                <button class="btn btn-success" type="submit">Confirm Borrow</button>
            </div>
        </form>
    </div>
</main>

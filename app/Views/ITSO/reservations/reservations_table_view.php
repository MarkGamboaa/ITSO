<main>
    <div class="itso-container">
        <h2>Reservations</h2>
        <a href="<?= base_url('reservations/reserve') ?>" class="btn btn-primary mb-3">Reserve Equipment</a>
        <p>Only Associates can make reservations.</p>
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User</th>
                    <th>Item</th>
                    <th>Reserved Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reservations as $reservation): ?>
                <tr>
                    <td><?= $reservation['user_id'] ?></td>
                    <td><?= $reservation['user_name'] ?></td>
                    <td><?= $reservation['equipment_name'] ?></td>
                    <td><?= date('Y-m-d', strtotime($reservation['updated_at'])) ?></td>
                    <td><?= $reservation['status'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links(); ?>
    </div>
</main>

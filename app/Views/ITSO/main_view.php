<?php ?>
<style>
    :root{--feu-green:#007a3d;--feu-yellow:#ffd400;--muted:#f5f8f6;--text-dark:#08321a}
    .itso-container{max-width:1100px;margin:0 auto;padding:2.25rem 1rem}
    .itso-hero{background:linear-gradient(180deg,var(--feu-green) 0%,#0a7a3f 60%);color:#fff;padding:2rem;border-radius:10px}
    .itso-card{background:#fff;border-radius:8px;padding:1rem;box-shadow:0 6px 18px rgba(3,27,15,.06)}
    .itso-stats{display:flex;gap:1rem;flex-wrap:wrap}
    .stat-tile{flex:1 1 220px;padding:1rem;border-radius:8px;background:#fff;box-shadow:0 6px 18px rgba(3,27,15,.04)}
    .stat-value{font-size:1.6rem;font-weight:800;color:var(--feu-green)}
    .card-actions{display:flex;gap:.5rem;justify-content:flex-end}
    .small-muted{font-size:.9rem;color:#6b6b6b}
    .recent-table td, .recent-table th{vertical-align:middle}
</style>

<main>
    <div class="itso-container">
        <div class="itso-hero mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="h3 mb-1"><?= isset($title) ? esc($title) : 'ITSO Dashboard' ?></h1>
                </div>
                <div class="text-end">
                    <a href="<?= base_url('users/register') ?>" class="btn btn-outline-light me-2">
                        <i class="bi bi-person-plus"></i> New User
                    </a>
                </div>
            </div>
        </div>

        <div class="itso-card mb-4">
            <div class="itso-stats">
                <div class="stat-tile">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small-muted">Total Users</div>
                            <div class="stat-value" ><?= $totalUsers ?></div>
                        </div>
                    </div>
                </div>
                <div class="stat-tile">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small-muted">Active Borrowings</div>
                            <div class="stat-value" ><?= $totalBorrowed ?></div>
                        </div>
                    </div>
                </div>
                <div class="stat-tile">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small-muted">Total Equipment</div>
                            <div class="stat-value" ><?= $totalEquipment ?></div>
                        </div>
                    </div>
                </div>
                <div class="stat-tile">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small-muted">Pending Reservations</div>
                            <div class="stat-value" ><?= $totalReservations ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="itso-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Recent Activity</h5>
                        <div class="small-muted">Showing latest 8</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm recent-table">
                            <thead>
                                <tr><th>User ID</th><th>Type</th><th>User</th><th>Item</th><th>Date</th><th>Status</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach($borrowing as $borrow): ?>
                                <tr>
                                    <td><?= $borrow['user_id'] ?></td>
                                    <td>Borrow</td>
                                    <td><?= $borrow['user_name'] ?></td>
                                    <td><?= $borrow['equipment_name'] ?></td>
                                    <td><?= $borrow['borrowed_at'] ?></td>
                                    <td><span class="badge bg-success">Borrowed</span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-actions mt-2">
                        <a href="<?= base_url('borrowing') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-list"></i> View All Activity
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="itso-card mb-3">
                    <h6 class="mb-2">Quick Actions</h6>
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('equipment/add') ?>" class="btn btn-outline-success">
                            <i class="bi bi-plus-circle"></i> Add Equipment
                        </a>
                        <a href="<?= base_url('borrowing/borrow') ?>" class="btn btn-outline-primary">
                            <i class="bi bi-box"></i> Borrow Item
                        </a>
                        <a href="<?= base_url('reservations/reserve') ?>" class="btn btn-outline-warning">
                            <i class="bi bi-calendar-plus"></i> Reserve Equipment
                        </a>
                        <a href="<?= base_url('users/register') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-person-plus"></i> Register User
                        </a>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
    </div>
</main>

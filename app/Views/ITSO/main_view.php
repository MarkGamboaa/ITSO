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
                    <a href="<?= base_url('users/register') ?>" class="btn btn-outline-light me-2">New User</a>
                    <a href="<?= base_url('equipment/add') ?>" class="btn btn-warning" style="background:var(--feu-yellow);color:var(--text-dark);border:0">Add Equipment</a>
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
                                <tr><th>Ref</th><th>Type</th><th>User</th><th>Item</th><th>Date</th><th>Status</th></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="<?= base_url('borrowing/history') ?>">BR-001</a></td>
                                    <td>Borrow</td>
                                    <td>Juan Dela Cruz</td>
                                    <td>Laptop (EQ-001)</td>
                                    <td>2025-11-15</td>
                                    <td><span class="badge bg-success">Borrowed</span></td>
                                </tr>
                                <tr>
                                    <td><a href="<?= base_url('returns/process') ?>">RT-002</a></td>
                                    <td>Return</td>
                                    <td>Anna Santos</td>
                                    <td>Projector (EQ-012)</td>
                                    <td>2025-11-14</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td><a href="<?= base_url('reservations') ?>">RSV-001</a></td>
                                    <td>Reservation</td>
                                    <td>Mark Lee</td>
                                    <td>DLP (EQ-021)</td>
                                    <td>2025-11-20</td>
                                    <td><span class="badge bg-info text-dark">Reserved</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-actions mt-2">
                        <a href="<?= base_url('borrowing/history') ?>" class="btn btn-sm btn-outline-secondary">View All Activity</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="itso-card mb-3">
                    <h6 class="mb-2">Quick Actions</h6>
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('equipment/add') ?>" class="btn btn-outline-success">Add Equipment</a>
                        <a href="<?= base_url('borrowing/borrow') ?>" class="btn btn-outline-primary">Borrow Item</a>
                        <a href="<?= base_url('reservations/reserve') ?>" class="btn btn-outline-warning">Reserve Equipment</a>
                        <a href="<?= base_url('users/register') ?>" class="btn btn-outline-secondary">Register User</a>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">Logout</a>
                </div>
    </div>
</main>

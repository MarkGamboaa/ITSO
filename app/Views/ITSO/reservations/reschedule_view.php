<main>
    <div class="itso-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="itso-card">
                    <h2 class="mb-4">Reschedule Reservation</h2>
                    
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Current Reservation Details -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Current Reservation Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>User:</strong> <?= esc($reservation['user_name']) ?></p>
                                    <p><strong>Equipment:</strong> <?= esc($reservation['equipment_name']) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Quantity:</strong> <?= esc($reservation['quantity']) ?></p>
                                    <p><strong>Current Date:</strong> <?= date('Y-m-d', strtotime($reservation['reserved_date'])) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reschedule Form -->
                    <form action="<?= base_url('reservations/updateSchedule/' . $reservation['reservation_id']) ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="reserved_date" class="form-label">New Reservation Date</label>
                            <input type="date" class="form-control" id="reserved_date" name="reserved_date" 
                                   value="<?= old('reserved_date', date('Y-m-d', strtotime($reservation['reserved_date']))) ?>" 
                                   required>
                            <div class="form-text">
                                Please select a new date for your reservation. The date must be at least 1 day in advance.
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('reservations') ?>" class="btn" 
                               style="background-color: #6c757d; color: #fff; border: 1px solid #6c757d;">
                                <i class="bi bi-arrow-left"></i> Back to Reservations
                            </a>
                            <button type="submit" class="btn" 
                                    style="background-color: #28a745; color: #fff; border: 1px solid #28a745;">
                                <i class="bi bi-check-circle"></i> Update Reservation Date
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set minimum date to tomorrow
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('reserved_date');
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const minDate = tomorrow.toISOString().split('T')[0];
            dateInput.setAttribute('min', minDate);
        });
    </script>
</main>
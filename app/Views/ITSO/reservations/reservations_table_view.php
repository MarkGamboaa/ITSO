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
                    <th>Accessories</th>
                    <th>Quantity</th>
                    <th>Reserved Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reservations as $reservation): ?>
                <tr>
                    <td><?= $reservation['user_id'] ?></td>
                    <td><?= $reservation['user_name'] ?></td>
                    <td><?= $reservation['equipment_name'] ?></td>
                    <td><?= $reservation['accessories'] ?></td>
                    <td><?= $reservation['quantity'] ?></td>
                    <td><?= date('Y-m-d', strtotime($reservation['updated_at'])) ?></td>
                    <td><?= $reservation['status'] ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="<?= base_url('reservations/reschedule/' . $reservation['reservation_id']) ?>" 
                               class="btn btn-sm" 
                               style="background-color: #ffc107; color: #000; border: 1px solid #ffc107;"
                               title="Reschedule">
                                <i class="bi bi-calendar-event"></i> Reschedule
                            </a>
                            <button type="button" class="btn btn-sm" 
                                    style="background-color: #dc3545; color: #fff; border: 1px solid #dc3545;"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#cancelModal"
                                    data-reservation-id="<?= $reservation['reservation_id'] ?>"
                                    data-user-name="<?= $reservation['user_name'] ?>"
                                    data-equipment-name="<?= $reservation['equipment_name'] ?>"
                                    title="Cancel Reservation">
                                <i class="bi bi-x-circle"></i> Cancel
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links(); ?>
    </div>

    <!-- Cancel Confirmation Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Cancel Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel the reservation for:</p>
                    <ul>
                        <li><strong>User:</strong> <span id="modalUserName"></span></li>
                        <li><strong>Equipment:</strong> <span id="modalEquipmentName"></span></li>
                    </ul>
                    <p class="text-danger"><strong>This action cannot be undone!</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" 
                            style="background-color: #6c757d; color: #fff; border: 1px solid #6c757d;" 
                            data-bs-dismiss="modal">Keep Reservation</button>
                    <form id="cancelForm" method="POST" style="display: inline;">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn" 
                                style="background-color: #dc3545; color: #fff; border: 1px solid #dc3545;">
                            Yes, Cancel Reservation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle cancel modal data population
        document.addEventListener('DOMContentLoaded', function() {
            const cancelModal = document.getElementById('cancelModal');
            if (cancelModal) {
                cancelModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const reservationId = button.getAttribute('data-reservation-id');
                    const userName = button.getAttribute('data-user-name');
                    const equipmentName = button.getAttribute('data-equipment-name');
                    
                    // Update modal content
                    document.getElementById('modalUserName').textContent = userName;
                    document.getElementById('modalEquipmentName').textContent = equipmentName;
                    
                    // Update form action
                    const form = document.getElementById('cancelForm');
                    form.action = '<?= base_url('reservations/cancel/') ?>' + reservationId;
                });
            }
        });
    </script>
</main>

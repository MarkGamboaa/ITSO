<main>
    <div class="itso-container">
        <h2>Reservations</h2>
        <a href="<?= base_url('reservations/reserve') ?>" class="btn btn-primary mb-3">
            <i class="bi bi-calendar-plus"></i> Reserve Equipment
        </a>
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
                            <button type="button" class="btn btn-sm cancel-btn" 
                                    style="background-color: #dc3545; color: #fff; border: 1px solid #dc3545;"
                                    data-reservation-id="<?= $reservation['reservation_id'] ?>"
                                    data-user-name="<?= esc($reservation['user_name']) ?>"
                                    data-equipment-name="<?= esc($reservation['equipment_name']) ?>"
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
        <div class="modal-dialog modal-dialog-centered">
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
            console.log('DOM loaded, setting up modal event listeners');
            
            const cancelModal = document.getElementById('cancelModal');
            const modalUserName = document.getElementById('modalUserName');
            const modalEquipmentName = document.getElementById('modalEquipmentName');
            const cancelForm = document.getElementById('cancelForm');
            
            if (cancelModal && modalUserName && modalEquipmentName && cancelForm) {
                console.log('Modal elements found');
                
                // Initialize Bootstrap modal
                const bsModal = new bootstrap.Modal(cancelModal);
                
                // Add click event listeners to all cancel buttons
                const cancelButtons = document.querySelectorAll('.cancel-btn');
                console.log('Found cancel buttons:', cancelButtons.length);
                
                cancelButtons.forEach(function(button, index) {
                    button.addEventListener('click', function(e) {
                        console.log('Cancel button clicked:', index);
                        
                        const reservationId = this.getAttribute('data-reservation-id');
                        const userName = this.getAttribute('data-user-name');
                        const equipmentName = this.getAttribute('data-equipment-name');
                        
                        console.log('Button data:', {
                            id: reservationId,
                            user: userName,
                            equipment: equipmentName
                        });
                        
                        // Update modal content
                        modalUserName.textContent = userName;
                        modalEquipmentName.textContent = equipmentName;
                        
                        // Update form action
                        cancelForm.action = '<?= base_url('reservations/cancel/') ?>' + reservationId;
                        
                        console.log('Form action set to:', cancelForm.action);
                        
                        // Show modal
                        bsModal.show();
                        console.log('Modal should be showing now');
                    });
                });
            } else {
                console.error('Some modal elements not found:', {
                    modal: !!cancelModal,
                    userName: !!modalUserName,
                    equipmentName: !!modalEquipmentName,
                    form: !!cancelForm
                });
            }
        });
    </script>
</main>

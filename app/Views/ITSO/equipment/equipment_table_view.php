<main>
    <div class="itso-container">
        <h2>Equipment Management</h2>
        <a href="<?= base_url('equipment/add') ?>" class="btn btn-success mb-3">
            <i class="bi bi-plus-circle"></i> Add Equipment
        </a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($equipment)): ?>
                    <?php foreach ($equipment as $item): ?>
                        <tr>
                            <td><?= $item['equipment_id']  ?></td>
                            <td><?= esc($item['name']) ?></td>
                            <td><?= esc($item['available_count']) ?> / <?= esc($item['total_count']) ?></td>
                            <td><?= $item['is_active'] ? 'Available' : 'Inactive' ?></td>
                            <td class="d-flex gap-2">
                                <a class="btn btn-sm btn-primary" href="<?= base_url('equipment/view/'.$item['equipment_id']) ?>">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a class="btn btn-sm btn-secondary" href="<?= base_url('equipment/edit/'.$item['equipment_id']) ?>">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a class="btn btn-sm btn-danger deactivate-equipment-btn" 
                                   data-equipment-id="<?= $item['equipment_id'] ?>"
                                   data-equipment-name="<?= esc($item['name']) ?>"
                                   title="Deactivate Equipment">
                                    <i class="bi bi-x-circle"></i> Deactivate
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center">No equipment found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Deactivate Equipment Confirmation Modal -->
    <div class="modal fade" id="deactivateEquipmentModal" tabindex="-1" aria-labelledby="deactivateEquipmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deactivateEquipmentModalLabel">Deactivate Equipment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to deactivate the following equipment?</p>
                    <ul>
                        <li><strong>Equipment:</strong> <span id="modalDeactivateEquipmentName"></span></li>
                        <li><strong>Equipment ID:</strong> <span id="modalDeactivateEquipmentId"></span></li>
                    </ul>
                    <div class="alert alert-warning">
                        <strong>Warning:</strong> This action will make the equipment unavailable for borrowing and reservations.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" 
                            style="background-color: #6c757d; color: #fff; border: 1px solid #6c757d;" 
                            data-bs-dismiss="modal">
                        <i class="bi bi-x"></i> Cancel
                    </button>
                    <form id="deactivateEquipmentForm" method="POST" style="display: inline;">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn" 
                                style="background-color: #dc3545; color: #fff; border: 1px solid #dc3545;">
                            <i class="bi bi-x-circle"></i> Yes, Deactivate Equipment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle deactivate equipment modal
        document.addEventListener('DOMContentLoaded', function() {
            const deactivateEquipmentModal = document.getElementById('deactivateEquipmentModal');
            const modalDeactivateEquipmentName = document.getElementById('modalDeactivateEquipmentName');
            const modalDeactivateEquipmentId = document.getElementById('modalDeactivateEquipmentId');
            const deactivateEquipmentForm = document.getElementById('deactivateEquipmentForm');
            
            if (deactivateEquipmentModal && modalDeactivateEquipmentName && modalDeactivateEquipmentId && deactivateEquipmentForm) {
                const bsModal = new bootstrap.Modal(deactivateEquipmentModal);
                
                const deactivateButtons = document.querySelectorAll('.deactivate-equipment-btn');
                
                deactivateButtons.forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        const equipmentId = this.getAttribute('data-equipment-id');
                        const equipmentName = this.getAttribute('data-equipment-name');
                        
                        modalDeactivateEquipmentName.textContent = equipmentName;
                        modalDeactivateEquipmentId.textContent = equipmentId;
                        
                        deactivateEquipmentForm.action = '<?= base_url('equipment/deactivate/') ?>' + equipmentId;
                        
                        bsModal.show();
                    });
                });
            }
        });
    </script>
</main>

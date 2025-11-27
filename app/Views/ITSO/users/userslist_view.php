<main>
    <div class="itso-container">
        <h2>Users</h2>
        <a href="<?= base_url('users/register') ?>" class="btn btn-success mb-3">
            <i class="bi bi-person-plus"></i> Register New User
        </a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user['user_id'] ?></td>
                    <td><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><?= $user['is_active'] == 1 ? 'Active' : 'Deactivated' ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a class="btn btn-sm" 
                               style="background-color: #007bff; color: #fff; border: 1px solid #007bff;"
                               href="<?= base_url('users/view/' . $user['user_id']) ?>">
                                <i class="bi bi-eye"></i> View
                            </a> 
                            <a class="btn btn-sm" 
                               style="background-color: #6c757d; color: #fff; border: 1px solid #6c757d;"
                               href="<?= base_url('users/edit/' . $user['user_id']) ?>">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <?php if($user['is_active'] == 1): ?>
                            <button type="button" class="btn btn-sm deactivate-user-btn" 
                               style="background-color: #dc3545; color: #fff; border: 1px solid #dc3545;"
                               data-user-id="<?= $user['user_id'] ?>"
                               data-user-name="<?= esc($user['first_name'] . ' ' . $user['last_name']) ?>"
                               title="Deactivate User">
                                <i class="bi bi-person-x"></i> Deactivate
                            </button>
                            <?php else: ?>
                            <button type="button" class="btn btn-sm activate-user-btn" 
                               style="background-color: #28a745; color: #fff; border: 1px solid #28a745;"
                               data-user-id="<?= $user['user_id'] ?>"
                               data-user-name="<?= esc($user['first_name'] . ' ' . $user['last_name']) ?>"
                               title="Activate User">
                                <i class="bi bi-person-check"></i> Activate
                            </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links(); ?>
    </div>

    <!-- Activate User Confirmation Modal -->
    <div class="modal fade" id="activateUserModal" tabindex="-1" aria-labelledby="activateUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateUserModalLabel">Activate User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to activate the following user?</p>
                    <ul>
                        <li><strong>User:</strong> <span id="modalActivateUserName"></span></li>
                        <li><strong>User ID:</strong> <span id="modalActivateUserId"></span></li>
                    </ul>
                    <div class="alert alert-success">
                        <strong>Note:</strong> This action will allow the user to access the system again.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" 
                            style="background-color: #6c757d; color: #fff; border: 1px solid #6c757d;" 
                            data-bs-dismiss="modal">
                        <i class="bi bi-x"></i> Cancel
                    </button>
                    <form id="activateUserForm" method="POST" style="display: inline;">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn" 
                                style="background-color: #28a745; color: #fff; border: 1px solid #28a745;">
                            <i class="bi bi-person-check"></i> Yes, Activate User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Deactivate User Confirmation Modal -->
    <div class="modal fade" id="deactivateUserModal" tabindex="-1" aria-labelledby="deactivateUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deactivateUserModalLabel">Deactivate User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to deactivate the following user?</p>
                    <ul>
                        <li><strong>User:</strong> <span id="modalDeactivateUserName"></span></li>
                        <li><strong>User ID:</strong> <span id="modalDeactivateUserId"></span></li>
                    </ul>
                    <div class="alert alert-warning">
                        <strong>Warning:</strong> This action will prevent the user from accessing the system.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" 
                            style="background-color: #6c757d; color: #fff; border: 1px solid #6c757d;" 
                            data-bs-dismiss="modal">
                        <i class="bi bi-x"></i> Cancel
                    </button>
                    <form id="deactivateUserForm" method="POST" style="display: inline;">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn" 
                                style="background-color: #dc3545; color: #fff; border: 1px solid #dc3545;">
                            <i class="bi bi-person-x"></i> Yes, Deactivate User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle activate and deactivate user modals
        document.addEventListener('DOMContentLoaded', function() {
            // Activate User Modal
            const activateUserModal = document.getElementById('activateUserModal');
            const modalActivateUserName = document.getElementById('modalActivateUserName');
            const modalActivateUserId = document.getElementById('modalActivateUserId');
            const activateUserForm = document.getElementById('activateUserForm');
            
            if (activateUserModal && modalActivateUserName && modalActivateUserId && activateUserForm) {
                const bsActivateModal = new bootstrap.Modal(activateUserModal);
                
                const activateButtons = document.querySelectorAll('.activate-user-btn');
                
                activateButtons.forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        const userId = this.getAttribute('data-user-id');
                        const userName = this.getAttribute('data-user-name');
                        
                        modalActivateUserName.textContent = userName;
                        modalActivateUserId.textContent = userId;
                        
                        activateUserForm.action = '<?= base_url('users/confirmActivate/') ?>' + userId;
                        
                        bsActivateModal.show();
                    });
                });
            }

            // Deactivate User Modal
            const deactivateUserModal = document.getElementById('deactivateUserModal');
            const modalDeactivateUserName = document.getElementById('modalDeactivateUserName');
            const modalDeactivateUserId = document.getElementById('modalDeactivateUserId');
            const deactivateUserForm = document.getElementById('deactivateUserForm');
            
            if (deactivateUserModal && modalDeactivateUserName && modalDeactivateUserId && deactivateUserForm) {
                const bsModal = new bootstrap.Modal(deactivateUserModal);
                
                const deactivateButtons = document.querySelectorAll('.deactivate-user-btn');
                
                deactivateButtons.forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        const userId = this.getAttribute('data-user-id');
                        const userName = this.getAttribute('data-user-name');
                        
                        modalDeactivateUserName.textContent = userName;
                        modalDeactivateUserId.textContent = userId;
                        
                        deactivateUserForm.action = '<?= base_url('users/confirmDeactivate/') ?>' + userId;
                        
                        bsModal.show();
                    });
                });
            }
        });
    </script>
</main>

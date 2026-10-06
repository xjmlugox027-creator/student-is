<?= $this->extend('Layout/layout') ?>
<?= $this->section('content') ?>
<div>


    <h1>Users</h1>

    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addUser">Add User</button>
    <div class="modal fade" id="addUser">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">

                        <h4>

                            Add User
                        </h4>
                    </div>
                </div>
                <form action="<?= base_url('users') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-body">

                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>

                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmmPassword" required>

                        <label class="form-label">User Role</label>
                        <select name="role" class="form-select">
                            <option value="user">User</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div>
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('message')) ?>
            </div>
        <?php endif; ?>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>User Role</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $count => $user) : ?>
                    <tr>
                        <th><?= $count + 1 ?></th>
                        <td><?= esc($user['username']) ?></td>
                        <td><?= esc($user['role']) ?></td>
                        <td><?= date('M d, Y H:s', strtotime(esc($user['created_at']))) ?></td>
                        <td>
                            <button
                                type="button" class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal<?= esc($user['username']) ?>">
                                Edit
                            </button>
                            <div class="modal fade" id="editModal<?= esc($user['username']) ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title">
                                                <h4>Edit<?= esc($user['username']) ?></h4>
                                            </div>
                                        </div>

                                        <form action="/users/<?= esc($user['id']) ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">

                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" name="username" value="<?= esc($user['username']) ?>" required>
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                                                <label class="form-label">Role</label>
                                                <select name="role" class="form-select" required>
                                                    <?php
                                                    $role = ['user', 'admin'];
                                                    foreach ($role as $rl) : ?>
                                                        <option value="<?= esc($rl) ?>" <?= $rl === $user['role'] ? 'selected' : '' ?>>
                                                            <?= ucwords(esc($rl)) ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
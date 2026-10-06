<?= $this->extend('Layout/layout') ?>
<?= $this->section('content') ?>
<div>
    <div>
        <h1>Students</h1>
        <div>
            <!-- Add Modal -->
            <div class="modal fade" id="addModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">
                                Add Student
                            </h3>
                            <span class="btn-close" data-bs-dismiss="modal"></span>
                        </div>
                        <form action="<?= base_url('students') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <!-- Edit First Name -->
                                <label class="form-label">First Name</label>
                                <input class="form-control" name="firstName" type="text" required>
                                <!-- Edit Middle Name -->
                                <label class="form-label">Middle Name</label>
                                <input class="form-control" name="middleName" type="text">
                                <!-- Edit Last Name -->
                                <label class="form-label">Last Name</label>
                                <input class="form-control" name="lastName" type="text" required>
                                <!-- Edit Name Extension -->
                                <label class="form-label">Name Extension</label>
                                <input class="form-control" name="nameExtension" type="text">
                                <!-- Edit Course  -->
                                <label class="form-label">Course</label>
                                <input class="form-control" name="course" type="text" required>
                                <!-- Edit Year -->
                                <label class="form-label">Year</label>
                                <select class="form-select" name="year" required>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>
                                    <option value="4th">4th</option>
                                </select>
                                <!-- Edit Enrollment Date -->
                                <label class="form-label">Enrollment Date</label>
                                <input class="form-control" name="enrollmentDate" type="Date" required>
                                <!-- Edit Status -->
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="graduated">Graduated</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="d-flex gap-2 justify-content-between">
            <form class="d-flex gap-2 " action="/students" method="get">
                <input type="search" name="search" class="form-control">
                <button class="btn btn-primary">Search</button>
            </form>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
        </div>
        <table class="table mt-2">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Enrollment Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $i => $student) : ?>
                    <tr class="shadow-sm">
                        <th><?= $i + 1 ?></th>
                        <td>
                            <?= esc($student['last_name']) ?>,
                            <?= esc($student['first_name']) ?>
                            <?= !empty($student['middle_name']) ? esc($student['middle_name']) : '' ?>
                            <?= !empty($student['name_extension']) ? esc($student['name_extension']) : '' ?>
                        </td>
                        <td><?= esc($student['course']) ?></td>
                        <td><?= esc($student['year']) ?></td>
                        <td><?= date('M d, Y', strtotime(esc($student['enrollment_date']))) ?></td>
                        <td>
                            <span class="p-2 badge text-bg-<?= $student['status'] === 'active' ? 'success' : ($student['status'] === 'inactive' ? 'dark' : 'warning') ?>"><?= esc($student['status']) ?></span>
                        </td>
                        <td>
                            <a href="/<?= esc($student['id']) ?>" class="btn btn-danger">Delete</a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= esc($student['id']) ?>">
                                Edit
                            </button>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?= esc($student['id']) ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">
                                                Edit <?= esc($student['last_name']) ?>,
                                                <?= esc($student['first_name']) ?>
                                                <?= !empty($student['middle_name']) ? esc($student['middle_name']) : '' ?>
                                                <?= !empty($student['name_extension']) ? esc($student['name_extension']) : '' ?>
                                            </h3>
                                            <span class="btn-close" data-bs-dismiss="modal"></span>
                                        </div>
                                        <form action="/edit/<?= esc($student['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <!-- Edit First Name -->
                                                <label class="form-label">First Name</label>
                                                <input class="form-control" name="firstName" value="<?= esc($student['first_name']) ?>" type="text" required>
                                                <!-- Edit Middle Name -->
                                                <label class="form-label">Middle Name</label>
                                                <input class="form-control" name="middleName" value="<?= esc($student['middle_name']) ?>" type="text">
                                                <!-- Edit Last Name -->
                                                <label class="form-label">Last Name</label>
                                                <input class="form-control" name="lastName" value="<?= esc($student['last_name']) ?>" type="text" required>
                                                <!-- Edit Name Extension -->
                                                <label class="form-label">Name Extension</label>
                                                <input class="form-control" name="nameExtension" value="<?= esc($student['name_extension']) ?>" type="text">
                                                <!-- Edit Course  -->
                                                <label class="form-label">Course</label>
                                                <input class="form-control" name="course" value="<?= esc($student['course']) ?>" type="text" required>
                                                <!-- Edit Year -->
                                                <label class="form-label">Year</label>
                                                <select class="form-select" name="year" required>
                                                    <?php
                                                    $year = ['1st', '2nd', '3rd', '4th'];
                                                    foreach ($year as $y) : ?>
                                                        <option value="<?= esc($y) ?>" <?= $y === $student['year'] ? 'selected' : '' ?>><?= ucwords(esc($y)) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <!-- Edit Enrollment Date -->
                                                <label class="form-label">Enrollment Date</label>
                                                <input class="form-control" name="enrollmentDate" value="<?= esc($student['enrollment_date']) ?>" type="Date" required>
                                                <!-- Edit Status -->
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status" required>
                                                    <?php
                                                    $stats = ['active', 'inactive', 'graduated'];
                                                    foreach ($stats as $stat) : ?>
                                                        <option value="<?= esc($stat) ?>" <?= $stat === $student['status'] ? 'selected' : '' ?>><?= ucwords(esc($stat)) ?></option>
                                                    <?php endforeach; ?>
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
        <?= $pager->links('default', 'bootstrap') ?>
    </div>
</div>
<?= $this->endSection() ?>
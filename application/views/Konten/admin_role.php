<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?= $title; ?> </span> <?= $subtitle; ?></h4>
        <?= $this->session->flashdata('message'); ?>

        <!-- Basic Bootstrap Table -->
        <a class="btn btn-success mb-3" href="#" data-bs-toggle="modal" data-bs-target="#addSubMenu">Add Role</a>
        <div class="card">
            <h5 class="card-header"><?= $title; ?></h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $i = 1; ?>
                        <?php foreach ($role as $sm) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><i class="fab fa-angular fa-lg text-danger"></i><strong><?= $sm['role']; ?></strong></td>
                                <td>
                                    <?php
                                    $acc = $sm['is_active'];
                                    if ($acc == 1) {
                                        echo "<span class='badge bg-label-primary me-1'>Active</span>
                                            ";
                                    } else {
                                        echo "<span class='badge bg-label-danger me-1'>Disabled</span>
                                            ";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= base_url('admin/roleaccess/') . $sm['id']; ?>"><i class="bx bx-user me-1"></i> Change Access</a>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editmenu<?php echo $sm['id']; ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="<?= base_url('admin/deleterole/') . $sm['id']; ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addSubMenu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubMenuTitle">Add <?= $title; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php echo form_open_multipart('admin/role'); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="role" class="form-label">New Role</label>
                        <input type="text" id="role" name="role" class="form-control" placeholder="Role Name" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-0">
                        <label for="is_active" class="form-label">Status</label>
                        <input type="number" id="is_active" name="is_active" class="form-control" placeholder="Submenu Status" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="input" class="btn btn-success">Add Role</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--/ Basic Bootstrap Table -->
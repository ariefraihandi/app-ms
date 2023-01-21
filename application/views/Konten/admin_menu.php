<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?= $title; ?> /</span> <?= $subtitle; ?></h4>
        <?= $this->session->flashdata('message'); ?>

        <!-- Basic Bootstrap Table -->
        <a class="btn btn-success mb-3" href="#" data-bs-toggle="modal" data-bs-target="#addMenu">Add Menu</a>
        <div class="card">
            <h5 class="card-header"><?= $title; ?></h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Menu</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?= $m['menu']; ?></strong></td>
                                <td><span class="badge bg-label-primary me-1">Active</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editmenu<?php echo $m['id']; ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="<?= base_url('admin/deletemenu/') . $m['id']; ?>"><i class="bx bx-trash me-1"></i> Delete</a>
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
<!-- edit menu modal -->
<?php
$no = 0;
foreach ($menu as $sm) : ?>

    <?php
    $id = $sm['id'];
    $query = $this->db->get_where('user_menu', ['id' => $id])->row_array();
    ?>
    <div class="modal fade" id="editmenu<?php echo $sm['id']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmenuTitle">Edit <?= $title; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php echo form_open_multipart('admin/changemenu'); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="menu" class="form-label">Name</label>
                            <input type="text" id="menu" name="menu" class="form-control" value="<?= $query['menu']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="collid" class="form-label">Coll ID</label>
                            <input type="text" id="collid" name="collid" class="form-control" value="<?= $query['collid']; ?>" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    <input type="hidden" id="menuid" name="menuid" value="<?= $query['id']; ?>">
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="modal fade" id="addMenu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMenuTitle">Add <?= $title; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php echo form_open_multipart('admin/menu'); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="menu" class="form-label">Menu</label>
                        <input type="text" id="menu" name="menu" class="form-control" placeholder="Menu Name" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="idcoll" class="form-label">Menu</label>
                        <input type="text" id="idcoll" name="idcoll" class="form-control" placeholder="Menu Name" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="input" class="btn btn-success">Add Menu</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--/ Basic Bootstrap Table -->
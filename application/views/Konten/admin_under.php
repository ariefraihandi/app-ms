<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?= $title; ?> </span> <?= $subtitle; ?></h4>
        <?= $this->session->flashdata('message'); ?>

        <!-- Basic Bootstrap Table -->
        <a class="btn btn-success mb-3" href="#" data-bs-toggle="modal" data-bs-target="#addSubMenu">Add Under Sub Menu</a>
        <div class="card">
            <h5 class="card-header"><?= $title; ?></h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Under Menu</th>
                            <th>Sub Menu</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $i = 1; ?>
                        <?php foreach ($susubmenu as $sm) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><i class="fab fa-angular fa-lg text-danger"></i><strong><?= $sm['title']; ?></strong></td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i><strong>
                                        <?php
                                        $menid      = $sm['id_submenu'];
                                        $result     = $this->db->select('title')->from('user_sub_menu')->where('id', $menid)->limit(1)->get()->row();
                                        echo $result->title;
                                        ?>
                                    </strong>
                                </td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i><strong><?= $sm['url']; ?></strong></td>
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
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editmenu<?php echo $sm['id']; ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="<?= base_url('admin/deleteundersubmenu/') . $sm['id']; ?>"><i class="bx bx-trash me-1"></i> Delete</a>
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
foreach ($susubmenu as $sm) : ?>

    <?php
    $id = $sm['id'];
    $query = $this->db->get_where('user_under_sub_menu', ['id' => $id])->row_array();
    ?>
    <div class="modal fade" id="editmenu<?php echo $sm['id']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmenuTitle">Edit <?= $title; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php echo form_open_multipart('admin/changesubnu'); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="id_submenu" class="form-label">Sub Menu</label>
                            <select name="id_submenu" id="id_submenu" class="form-control">
                                <option value="<?= $query['id_submenu']; ?>"> -
                                    <?php
                                    $menid      = $sm['id_submenu'];
                                    $result = $this->db->select('title')->from('user_sub_menu')->where('id', $menid)->limit(1)->get()->row();
                                    echo $result->title;
                                    ?> -
                                </option>
                                <?php foreach ($submenu as $m) : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="title" class="form-label">Submenu</label>
                            <input type="text" id="title" name="title" class="form-control" value="<?= $query['title']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="text" id="url" name="url" class="form-control" value="<?= $query['url']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="is_active" class="form-label">Status</label>
                            <input type="text" id="is_active" name="is_active" class="form-control" value="<?= $query['is_active']; ?>" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    <input type="hidden" id="id" name="id" value="<?= $query['id']; ?>">
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="modal fade" id="addSubMenu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubMenuTitle">Add <?= $title; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php echo form_open_multipart('admin/subnu'); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="id_submenu" class="form-label">Sub Menu</label>
                        <select name="id_submenu" id="id_submenu" class="form-control">
                            <option value="">Select Sub Menu</option>
                            <?php foreach ($submenu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="title" class="form-label">Under Submenu</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Under Submenu Name" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="text" id="url" name="url" class="form-control" placeholder="Submenu URL" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-0">
                        <label for="is_active" class="form-label">Status</label>
                        <input type="text" id="is_active" name="is_active" class="form-control" placeholder="Submenu Status" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="input" class="btn btn-success">Add Under Submenu</button>
            </div>
        </div>
    </div>
</div>
<!--/ Basic Bootstrap Table -->
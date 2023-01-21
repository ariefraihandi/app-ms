<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?= $title; ?> </span> <?= $subtitle; ?></h4>
        <?= $this->session->flashdata('message'); ?>
        <!-- Basic Bootstrap Table -->

        <!-- <a class="btn btn-success mb-3" href="#" data-bs-toggle="modal" data-bs-target="#akses<?= $user['role_id'] ?>">Akses Sub Menu</a> -->
        <div class="row">
            <div class="col-lg-4 mb-4 order-0">
                <div class="card">
                    <h5 class="card-header"><?= $title; ?> Menu</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Access</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php foreach ($menu as $m) : ?>
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger"></i><strong><?= $m['menu']; ?></strong></td>
                                        <td>
                                            <div class="form-check form-switch me-3">
                                                <input class="form-check-input " type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                            </div>
                                        </td>

                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 mb-4 order-0">
                <div class="card">
                    <h5 class="card-header"><?= $title; ?> Sub Menu</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Access</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php foreach ($submenu as $sm) : ?>
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger"></i><strong><?= $sm['title']; ?></strong></td>
                                        <td>
                                            <div class="form-check form-switch me-3">
                                                <input class="form-check-input " type="checkbox" <?= check_subaccess($role['id'], $sm['id']); ?> data-role="<?= $role['id']; ?>" data-submenu="<?= $sm['id']; ?>">
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4 order-0">
                <div class="card">
                    <h5 class="card-header"><?= $title; ?> Under Sub Menu</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="myTable1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Access</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php foreach ($undersub as $us) : ?>
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger"></i><strong><?= $us['title']; ?></strong></td>
                                        <td>
                                            <div class="form-check form-switch me-3">
                                                <input class="form-check-input " type="checkbox" <?= check_undersubaccess($role['id'], $us['id']); ?> data-role="<?= $role['id']; ?>" data-undersubmenu="<?= $us['id']; ?>">
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable1");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
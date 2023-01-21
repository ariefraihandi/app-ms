<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?= $title; ?> </span> <?= $subtitle; ?></h4>
        <?= $this->session->flashdata('message'); ?>

        <!-- Basic Bootstrap Table -->
        <div class="row">
            <div class="col-sm-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Temuan Bidang</h5>
                        <!-- <p class="card-text">Klik Tambah Untuk Menambahkan Temuan</p> -->
                        <a href="#" data-toggle="modal" data-target="#prdukModal" class="btn btn-primary">Tambah</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Temuan Triwulan 4</h5>
                        <h2 class="card-title"><strong><?= $total; ?> Temuan </strong></h2>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Tindak Lanjut Triwulan 4</h5>
                        <h2 class="card-title"><strong><?= $tindak; ?> Tindak Lanjut </strong></h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- <a class="btn btn-success mb-3" href="#" data-bs-toggle="modal" data-bs-target="#addMenu">Add Menu</a> -->
        <div class="card">
            <h5 class="card-header"><?= $title; ?></h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengawas</th>
                            <th>Tanggal</th>
                            <th>Bidang</th>
                            <th>Action</th>
                            <th>Whatsapp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($ikms as $sm) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $sm['pengawas']; ?></td>
                                <td><?= $sm['tgl']; ?></td>
                                <td><?= $sm['bidang']; ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal<?php echo $sm['id']; ?>"><i class="bx bxs-photo-album"></i> Lihat Eviden</a>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalTindak<?php echo $sm['id']; ?>"><i class="bx bx-edit-alt me-1"></i> Tindak Lanjut</a>
                                            <a class="dropdown-item" href="<?= base_url('admin/deletemenu/') . $sm['id']; ?>"><i class="bx bx-trash me-1"></i> Hasil</a>
                                        </div>
                                    </div>
                                </td>
                                <!-- <td>
                                    <a href="#" type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modal<?php echo $sm['id']; ?>">Lihat Eviden</a>
                                </td>
                                <td>
                                    <a href="#" type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modalTindak<?php echo $sm['id']; ?>">Tindak</a>
                                    <a href="#" type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#modalTindak<?php echo $sm['id']; ?>">Hasil</a>
                                </td> -->
                                <td>
                                    <a href="<?= base_url('pengawasan/kirim/') . $sm['id']; ?>" target="_blank" class="badge badge-success">Sekretaris</a>
                                    <a href="<?= base_url('pengawasan/kirem/') . $sm['id']; ?>" target="_blank" class="badge badge-warning">Panitera</a>
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

<!-- Eviden Modal-->
<?php
$no = 0;
foreach ($ikms as $sm) : ?>

    <?php
    $id = $sm['id'];
    $query = $this->db->get_where('pengawasan', ['id' => $id])->row_array();
    $panggil         = $query['eviden'];
    ?>

    <div class="modal fade" id="modal<?php echo $sm['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!--<div class="modal fade" id="myModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
        <div class="modal-dialog" role="document">
            <div class="modal-content">



            </div>
        </div>
    </div>
<?php endforeach; ?>

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
                    <h5 class="modal-title" id="exampleModalLabel">Eviden <?= $query['bidang']; ?> <a href="<?php echo base_url('assets/img/pengawasan/'); ?><?= $panggil; ?>" download="<?= $panggil; ?>"><i class="fa fa-download"></i></a></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <img src="<?php echo base_url('assets/img/pengawasan/'); ?><?= $panggil; ?>" width="470px" height="470px" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning py-2 px-3 me-3">Tutup</button>
                        <a href="#" type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modalTindak<?php echo $sm['id']; ?>">Tindak Lanjut</a>
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
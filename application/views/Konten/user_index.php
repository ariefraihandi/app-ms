<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Account</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="row mb-5">
                <!-- Status -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4 cent">
                        <img src="<?php echo base_url('vendor/'); ?>/assets/img/icons/ms-logo.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <button type="button" class="btn btn-success">
                                <span class="d-none d-sm-block"></span>&nbsp; <?= $user['jabatan']; ?> <?= $user['instansi']; ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Examples -->
            <div class="row mb-5">
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card h-100 ">
                        <div class="card-body ">
                            <h5 class="card-title cent">Profile</h5>
                            <div class="d-flex align-items-start align-items-sm-center gap-4 cent">
                                <img src="<?php echo base_url('vendor/'); ?>/assets/img/pegawai/<?= $user['image']; ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                <button type="button" class="btn btn-primary">
                                    <span class="tf-icons bx bx-check-square"></span>&nbsp; Aktif
                                </button>
                            </div>
                            <br>
                            <p class="text mb-0 cent"><?= $user['name']; ?></p>
                            <p class="text mb-0 cent">(<?= $user['jabatan']; ?>)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-lg-4 mb-3">
                    <div class="card h-100 ">
                        <div class="card-body ">
                            <h5 class="card-title cent">Sisa Cuti</h5>
                            <div class="d-flex align-items-start align-items-sm-center gap-4 cent">
                                <?php
                                $jum = '14';
                                $ambil = '13';
                                $sisa = $jum - $ambil;
                                $id = $sisa / 14 * 100;

                                ?>
                                <div role="progressbar" aria-valuenow="7" aria-valuemin="0" max="100" style="--value:<?= $id; ?>"></div>
                                <a class="btn btn-primary mb-3" href="#" data-bs-toggle="modal" data-bs-target="#ct">Ajukan Cuti</a>
                            </div>
                            <br>
                            <p class="text mb-0 cent">Jika data berbeda, Hubungi Admin</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title cent">Performa Kehadiran</h5>
                            <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                            <!-- <img class="img-fluid d-flex mx-auto my-4" src="../assets/img/elements/4.jpg" alt="Card image cap" /> -->
                            <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Examples -->
            <div class="card mb-4">
                <hr class="my-0" />
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Name Lengkap</label>
                                <input class="form-control" type="text" id="name" name="name" value="<?= $user['name']; ?>" autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Username</label>
                                <input class="form-control" type="text" name="lastName" id="lastName" value="<?= $user['username']; ?>" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="email" id="email" name="email" value="<?= $user['email']; ?>" placeholder="john.doe@example.com" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Instansi</label>
                                <input type="text" class="form-control" id="organization" name="organization" value="<?= $user['instansi']; ?>" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Nomor HP</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">ID (+62)</span>
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="<?= $user['whatsapp']; ?>" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?= $user['tempat_lahir']; ?>" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">Tanggal Lahir</label>
                                <input class="form-control" type="text" id="state" name="state" value="<?= $user['tgl_lahir']; ?>" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $user['alamat']; ?>" maxlength="6" />
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ct" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubMenuTitle">Form Pengajuan Cuti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php echo form_open_multipart('admin/submenu'); ?>
            <div class="modal-body">

                <div class="row">
                    <div class="col mb-3">
                        <label for="title" class="form-label">Nama</label>
                        <input type="text" id="title" name="title" class="form-control" value="<?= $user['name']; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="menu_id" class="form-label">Jenis Cuti</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Pilih Jenis Cuti</option>
                            <?php foreach ($cuti as $m) : ?>
                                <option value="<?= $m['name']; ?>"><?= $m['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="alcut" class="form-label">Alasan Cuti</label>
                        <textarea type="text" id="alcut" name="alcut" class="form-control" placeholder="Alasan Pengajuan Cuti"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3 input-group input-group-merge">
                        <input type="number" class="form-control" id="durcut" name="durcut" placeholder="Lamanya Cuti" aria-label="Recipient's username" aria-describedby="basic-addon33" />
                        <span class="input-group-text" id="basic-addon33">Hari</span>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="dartgl" class="form-label">Dari Tanggal</label>
                        <input type="date" id="dartgl" name="dartgl" class="form-control" value="<?= $date; ?>" />
                    </div>
                    <div class="col mb-0">
                        <label for="samtgl" class="form-label">Sampai Tanggal</label>
                        <input type="date" id="samtgl" name="samtgl" class="form-control" value="<?= $date; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="alamat" class="form-label">Alamat Selama Cuti</label>
                        <textarea type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="input" class="btn btn-success">Ajukan Cuti</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tambah Pengunjung</h5>
                    <p class="card-text">Data Pemohon Informasi MS Lhokseumawe</p>
                    <a href="#" data-toggle="modal" data-target="#prdukModal" class="btn btn-primary">Tambah Pemohon</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Pemohon Informasi Bulan <?= $awal; ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="header">
                                    <th>Name</th>
                                    <th>No</th>
                                    <!-- <th>Tanggal</th>
                                    <th>Whatsapp</th>
                                    <th>Alamat</th>
                                    <th>Pekerjaan</th>
                                    <th>Informasi</th>
                                    <th>Tujuan</th>
                                    <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($undersub as $sm) : ?>
                                    <tr>
                                        <td><?= $sm['title']; ?></td>
                                        <th scope="row"><?= $i; ?></th>
                                        <!-- <td><?= $sm['tanggal']; ?></td>
                                        <td><?= $sm['whatsapp']; ?></td>
                                        <td><?= $sm['alamat']; ?></td>
                                        <td><?= $sm['pekerjaan']; ?></td>
                                        <td><?= $sm['informasi']; ?></td>
                                        <td><?= $sm['tujuan']; ?></td> -->
                                        <!-- <td>
                                            <a href="<?= base_url('survey/ikm/') . $sm['id']; ?>" target="_blank" class="badge badge-success">a</a>
                                            <a href="<?= base_url('produk/kirim/') . $sm['id']; ?>" target="_blank" class="badge badge-warning">b</a>
                                        </td> -->
                                    </tr>
                                    <?php $i++; ?>
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
        table = document.getElementById("myTable");
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
<!-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?php echo base_url('vendor/'); ?>/assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?php echo base_url('vendor/'); ?>/assets/vendor/libs/popper/popper.js"></script>
<script src="<?php echo base_url('vendor/'); ?>/assets/vendor/js/bootstrap.js"></script>
<script src="<?php echo base_url('vendor/'); ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="<?php echo base_url('vendor/'); ?>/assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?php echo base_url('vendor/'); ?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="<?php echo base_url('vendor/'); ?>/assets/js/main.js"></script>

<!-- Page JS -->
<script src="<?php echo base_url('vendor/'); ?>/assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });

  $('.form-check-input').on('click', function() {
    const menuID = $(this).data('menu');
    const roleID = $(this).data('role');

    $.ajax({
      url: "<?= base_url('admin/changeaccess'); ?>",
      type: 'post',
      data: {
        menuID: menuID,
        roleID: roleID
      },
      success: function() {
        document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleID;
      }

    });

  });
</script>

<script>
  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });

  $('.form-check-input').on('click', function() {

    const submenuID = $(this).data('submenu');
    const roleID = $(this).data('role');

    $.ajax({
      url: "<?= base_url('admin/changesubaccess'); ?>",
      type: 'post',
      data: {
        submenuID: submenuID,
        roleID: roleID
      },
      success: function() {
        document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleID;
      }

    });

  });
</script>
<!-- Page level plugins -->
<script>
  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });

  $('.form-check-input').on('click', function() {

    const undersubmenuID = $(this).data('undersubmenu');
    const roleID = $(this).data('role');

    $.ajax({
      url: "<?= base_url('admin/changeundersubaccess'); ?>",
      type: 'post',
      data: {
        undersubmenuID: undersubmenuID,
        roleID: roleID
      },
      success: function() {
        document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleID;
      }

    });

  });
</script>

<script src="<?php echo base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/datatables/datatables-demo.js"></script>

<script>
  var table = $('#example').DataTable();

  new $.fn.dataTable.Responsive(table, {
    details: false
  });
</script>
<script>
  $(document).ready(function() {
    var table = $('#example').DataTable({
      responsive: true
    });

    new $.fn.dataTable.FixedHeader(table);
  });
</script>
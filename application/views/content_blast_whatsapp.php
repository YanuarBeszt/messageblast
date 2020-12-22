<style>
  .dataTables_filter {
    text-align: left !important;
  }

  table#Group,
  table td {
    border: hidden !important;
  }
</style><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= $title ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <!-- <li class="breadcrumb-item"><?= $brdcrmb; ?></li> -->
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Send New Message</h3>
            </div>
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="phoneto">To :</label>
                  <textarea class="form-control" style="height: 40px;" name="phoneto" id="phoneto" placeholder="To:" data-toggle='tooltip' data-placement='top' title='Select Contact Group beside to add phone number!' readonly></textarea>
                </div>
                <div class="form-group">
                  <textarea name="phonemessage" id="phonemessage" readonly></textarea>
                </div>
              </div>
              <div class="card-footer">
                <div class="float-right">
                  <div class="row">
                    <button type="button" class="btn btn-primary sendWa"><i class="far fa-envelope"></i> Send</button>
                  </div>
                </div>
                <a href="<?= base_url("Whatsapp/draft")?>" class="btn btn-default"><i class="fas fa-times"></i> Discard</a>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title">Contact Group</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table id="Group" class="table table-bordered nowrap" cellspacing="0" width="100%">
                  <thead style="display: none;">
                    <tr>
                      <td></td>
                    </tr>
                  </thead>
                  <div class="form-group">
                    <tbody id="BodyGroupTB">
                    </tbody>
                  </div>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
  </section>
  <script type="text/javascript" src="<?= base_url() . 'assets/js/custom/wablast.js?' . 'random=' . uniqid() ?> "></script>

  <script>
    
    $('[data-toggle="tooltip"]').tooltip();
    $(window).on("load", function() {
      $('#overlay').fadeOut(400);
    });
  </script>
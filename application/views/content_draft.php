<!-- Content Wrapper. Contains page content -->
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
      <div class="card card-info card-outline">
        <div class="card-header">
          <h3 class="card-title" style="padding-top: 8px;">Draft Email</h3>
          <div class="card-tools" data-toggle="tooltip" data-placement="top" title="Add new draft">
            <a class="btn float-right" style="color: grey;" data-toggle="modal" data-target="#modal-draft"><i class="fa fa-plus"></i></a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table id="draftTB" class="table table-bordered nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width=80px>No</th>
                  <th>Subject</th>
                  <th width=200px>Created date</th>
                  <th width=200px>Status</th>
                  <th width=170px>#</th>
                </tr>
              </thead>
              <tbody id="Bodydraft">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-draft">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add new draft</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form role="form" id="draftForm">
            <div class="modal-body">
              <div class="form-group" id="statusForm" style="display: none;">
                <label for="statusDraft">statusDraft</label>
                <select class="form-control select" name="statusDraft" id="statusDraft">
                  <option value="n">Active</option>
                  <option value="y">Non-Active</option>
                </select>
              </div>
              <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Name ..." required />
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" required></textarea>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="hidden" id="id" name="id">
              <button type="submit" class="btn btn-primary" id="save_draft">Save</button>
              <button type="submit" class="btn btn-primary" id="update_draft" style="display: none;">Save</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<!-- /.col -->
</section>
<script type="text/javascript" src="<?= base_url() . 'assets/js/custom/draft.js?' . 'random=' . uniqid() ?> "></script>

<script>
  CKEDITOR.replace("message", {
    filebrowserImageBrowseUrl: '<?php echo base_url('assets/kcfinder/browse.php'); ?>',
    height: '400px'
  });
  $(window).on("load", function() {
    $('#overlay').fadeOut(400);
  });
</script>
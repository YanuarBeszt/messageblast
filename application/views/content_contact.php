<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= $title; ?></h1>
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
        <!-- card-left -->
        <div class="col-sm-4">
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title" style="padding-top: 8px;">Data Group</h3>
              <div class="card-tools" data-toggle="tooltip" data-placement="top" title="Add new group">
                <a class="btn float-right" id="tambah_grup" style="color: grey;" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="groupCol">

            </div>
          </div>
        </div>
        <!-- /.card-left -->
        <!-- card-right -->
        <div class="col-sm-8">
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title" style="padding-top: 8px;">Data Contact</h3>
              <div class="card-tools">
                <div class="dropdown no-caret" data-toggle="tooltip" data-placement="top" title="Option">
                  <button class="btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#modal-contact">Add new data</a>
                    <form id="importForm">
                      <a class="dropdown-item" href="javascript:void(0);" id="importExcel">Import data excel</a>
                      <input type="file" id="inputFile" name="inputFile" style="display: none;" accept=".xls, .xlsx, .csv">
                      <input type="submit" name="importExcelButton" id="importExcelButton" name="importExcelButton" style="display: none;" accept=".xls, .xlsx">
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table id="ContactTB" class="table table-bordered nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody id="BodyContactTB">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-right -->
      </div>

      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add new group</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="group">Group Name</label>
                <input type="text" class="form-control" id="nameGroup" name="nameGroup" placeholder="New group ...">
                <input type="hidden" name="groupId" id="groupId">
                <hr>
                <label for="group">Choose Contact</label>
                <div class="table-responsive text-nowrap">
                  <table id="contactGroupTB" class="table table-bordered nowrap" width="100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Created date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($contact_group != null) { ?>
                        <?php foreach ($contact_group as $key) { ?>
                          <tr>
                            <td><input type="checkbox" name="contactGroup" id="contactGroup" value="<?= $key->id; ?>"></td>
                            <td> <?= $key->name ?></td>
                            <td> <?= $key->phone ?></td>
                            <td> <?= $key->email ?></td>
                            <td> <?= $key->created_date ?></td>
                          </tr>
                        <?php } ?>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <input type="hidden" id="idGroup" name="idGroup"> -->
              <button type="submit" class="btn btn-primary" id="submitGroup">Save</button>
              <button type="button" class="btn btn-primary" id="updateGroup" style="display: none;">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modal-contact">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add new contact</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form role="form" id="contactForm">
              <div class="modal-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Name ..." required />
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email ..." required />
                </div>
                <div class="form-group">
                  <label for="number">Phone</label>
                  <input type="number" class="form-control" name="number" id="number" maxlength="12" minlength="11" placeholder="Phone ..." required>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="hidden" id="id" name="id">
                <button type="submit" class="btn btn-primary" id="save_contact">Save</button>
                <button type="submit" class="btn btn-primary" id="update_contact" style="display: none;">Save</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
  </section>
</div>
<!-- /.col -->
<script type="text/javascript" src="<?= base_url() . 'assets/js/custom/contact.js?' . 'random=' . uniqid() ?> "></script>
<script type="text/javascript" src="<?= base_url() . 'assets/js/custom/group.js?' . 'random=' . uniqid() ?> "></script>

<script>
  $('[data-toggle="tooltip"]').tooltip();
  $(window).on("load", function() {
    $('#overlay').fadeOut(400);
  });
</script>
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
      <div class="col-sm-12">
        <div class="card card-info card-outline">
          <div class="card-header">
            <h3 class="card-title" style="padding-top: 8px;">Data User</h3>
            <div class="card-tools" data-toggle="tooltip" data-placement="top" title="Add new user">
              <a class="btn float-right addData" style="color: grey;" data-toggle="modal" data-target="#modal-user"><i class="fa fa-plus"></i></a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table id="UserTB" class="table table-bordered nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody id="BodyUserTB">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
  </section>
  <div class="modal fade" id="modal-user">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add new user</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" id="userForm">
          <div class="modal-body">
            <div class="form-group statusUser" style="display: none;">
              <label for="status">User status</label>
              <select class="form-control select status" style="width: 100%;" id="status" name="status">
                <option value="n">Active</option>
                <option value="y">Non-Active</option>
              </select>
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Name ..." required />
              <input type="hidden" class="form-control" name="id" id="id"/>
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Username ..." maxlength="30" required />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="text" class="form-control" name="password" id="password" placeholder="Password ..." required />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Email ..." required />
            </div>
            <div class="form-group">
              <label for="number">Phone</label>
              <input type="number" class="form-control" name="number" id="number" minlength="11" maxlength="12" placeholder="Phone ..." required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="save_user">Save</button>
            <button type="submit" class="btn btn-primary" id="update_user" style="display: none;">Save</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <script type="text/javascript" src="<?= base_url() . 'assets/js/custom/user.js?' . 'random=' . uniqid() ?> "></script>

  <script>
    $(window).on("load", function() {
      $('#overlay').fadeOut(400);
    });
  </script>
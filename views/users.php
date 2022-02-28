<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
  <img class="mr-2 img-responsive" src="<?php echo base_url("assets/rdlip/img/nrcp.png");?>" width="1.5%" height="1.5%"><a class="navbar-brand" href="#">RDLIP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class=" nav-item">
        <a class="nav-link" href="<?php echo base_url('rdlip/admin/dashboard_ilc');?>">Paper Presentation <span class="sr-only">(current)</span>
        <?php if($ilc_count > 0){?>
        <span class="badge badge-danger"><?php echo $ilc_count;?></span>
        <?php } ?>
        </a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('rdlip/admin/dashboard_pub');?>">Publication Grant
        <?php if($pub_count > 0){?>
        <span class="badge badge-danger"><?php echo $pub_count;?></span>
        <?php }?>
        </a>
      </li> 
    </ul>
     <!-- Topbar Navbar -->
     <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 font-weight-bold"><?php echo $this->session->userdata('_rdlip_name');?></span>
                <!-- <img class="img-profile rounded-circle"
                    src="img/undraw_profile.svg"> -->
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="<?php echo base_url('rdlip/admin/profile');?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a> -->
                <?php if($this->session->userdata('_rdlip_role') == 1){ ?>
                    <a class="dropdown-item" href="<?php echo base_url('rdlip/admin/activity_logs');?>">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Logs
                    </a>
                    <a class="dropdown-item" href="<?php echo base_url('rdlip/admin/users');?>">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Manage Users
                    </a>
                    <a class="dropdown-item" href="<?php echo base_url('rdlip/admin/csf_feedbacks');?>">
                        <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                        Feedbacks
                    </a>
                    <a class="dropdown-item" href="<?php echo base_url('rdlip/admin/backup_import');?>">
                        <i class="fas fa-database fa-sm fa-fw mr-2 text-gray-400"></i>
                        Backup/Restore Database
                    </a>
                <div class="dropdown-divider"></div>
                <?php } ?>
                <a class="dropdown-item" href="<?php echo base_url('rdlip/admin/logout');?>">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

        </ul>


  </div>
</nav>

<div class="container"> 
<!-- Content Row -->
<div class="row pt-5">
  <div class="col mt-5 text-white font-weight-bold mb-1"><h1>User Management</h1></div></div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3  d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add_user_modal"><span class="fa fa-plus" ></span> Add User</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-dark" id="user_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($users as $row){
                                        $role = ($row->usr_role == 1) ? 'Superadmin' : 'Admin'; 
                                        $date = date("d M Y,  h:m a", strtotime($row->date_created));
                                       echo '<tr> 
                                            <td>' . $row->row_id .'</td> 
                                            <td>' . $row->usr_username . '</td> 
                                            <td>' . $role . '</td> 
                                            <td>' . $date . '</td>
                                            <td><button class="btn btn-sm btn-outline-secondary w-100" data-toggle="modal" data-target="#edit_user_modal"
                                            onclick="get_user_by_id(' . $row->row_id . ')"><span class="fas fa-pen-square"></span> Edit</button></td>
                                          </div></td> 
                                        </tr>';
                                     } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" tabindex="-1" id="add_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_user_form">
            <div class="form-group">
                <label for="usr_username">Username</label>
                <input type="email" class="form-control" id="usr_username" name="usr_username" placeholder="Type email address" >
            </div>
            <div class="form-group">
                <label for="usr_password">Password</label>
                <input type="password" class="form-control" id="usr_password" name="usr_password" placeholder="Type password" >
            </div>
            <div class="form-group">
                <label for="repeat_password">Repeat Password</label>
                <input type="password" class="form-control" id="repeat_password" name="repeat_password" placeholder="Repeat password" >
            </div>
            <div class="form-group">
                <label for="usr_role">User Role</label>
                <select class="form-control" id="usr_role" name="usr_role">
                <option value="">Select here</option>
                <option value="1">Superadmin</option>
                <option value="2">Admin</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" tabindex="-1" id="edit_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="edit_user_form">
            <div class="form-group">
                <label for="usr_username">Username</label>
                <input type="email" class="form-control" id="usr_username" name="usr_username" placeholder="Type email address" >
                <input type="hidden" class="form-control" id="row_id" name="row_id">
            </div>
            <div class="form-group">
                <label for="usr_password">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password"  placeholder="Type password" readonly>
            </div>
            <div class="form-group">
                <label for="usr_password">New Password</label>
                <input type="password" class="form-control" id="usr_password" name="usr_password" placeholder="Type password" >
            </div>
            <div class="form-group">
                <label for="repeat_password">Repeat Password</label>
                <input type="password" class="form-control" id="repeat_password" name="repeat_password" placeholder="Repeat password" >
            </div>
            <div class="form-group">
                <label for="usr_role">User Role</label>
                <select class="form-control" id="usr_role" name="usr_role">
                <option value="">Select here</option>
                <option value="1">Superadmin</option>
                <option value="2">Admin</option>
                </select>
            </div>
            <!-- <button class="btn btn-outline-danger w-100">Deactivate Account</button> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger mr-auto" data-toggle="modal" data-target="#remove_user_modal">Remove User</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Remove User -->
<div class="modal fade" tabindex="-1" id="remove_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Remove</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to remove this user?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="remove_user()">Remove</button>
      </div>
    </div>
  </div>
</div>
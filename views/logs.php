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
<div class="row pt-5"><div class="col mt-5 text-white font-weight-bold mb-1"><h1>Activity Logs</h1></div></div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of all activites</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-dark" id="log_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Activity</th>
                                            <th>Login Attempt</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($logs as $row){
                                        $cat = ($row->log_cat == 1) ? 'Admin' : 'Member'; 
                                        $date = date("d M Y,  h:m a", strtotime($row->date_created));
                                       echo '<tr> 
                                            <td>' . $row->log_usr_id .'</td> 
                                            <td>' . $row->log_activity . '</td> 
                                            <td>' . $row->log_catch . '</td> 
                                            <td>' . $cat . '</td> 
                                            <td>' . $date . '</td>
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
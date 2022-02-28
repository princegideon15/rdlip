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
        <a class="nav-link  font-weight-bold text-primary border-bottom-primary" href="<?php echo base_url('rdlip/admin/dashboard_pub');?>">Publication Grant
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
                
                <?php if($this->session->userdata('_rdlip_role') == 2){ ?>
                    <a class="dropdown-item" href="javscript:void(0);" data-toggle="modal" data-target="#deadline_modal">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Deadline of application
                    </a>
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
    <div class="col mt-5 text-white font-weight-bold mb-1"><h1>Publication Grant</h1>
        <h5>Deadline of application : <span class="text-warning"><?php echo $deadline; ?></span>
        <button class="btn btn-sm btn-light ml-2"  data-toggle="modal" data-target="#deadline_modal"><span class="fas fa-edit"></span> Update</button></h5>
    </div>
</div>
<div class="row">
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4" >
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Associate</div>
                </div>
                <div class="col-auto">
                    <h1><?php echo $asso_count;?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Regular (Special Provision)</div>
                </div>
                <div class="col-auto">
                    <h1><?php echo $reg_special_count;?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Regular</div>
                </div>
                <div class="col-auto">
                    <h1><?php echo $reg_count;?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Honorary</div>
                </div>
                <div class="col-auto">
                    <h1><?php echo $hon_count;?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Content Row -->

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Applications</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-dark" id="pub_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Membership</th>
                                            <th>Date Submitted</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($pub_apps as $row){
                                        $status = ($row->pub_status == 0) ? 'NEW' : 'APPROVED'; 
                                        $color = ($row->pub_status == 0) ? 'text-warning' : 'text-success'; 
                                        $date = date("d M Y,  h:m a", strtotime($row->date_submitted));
                                       echo '<tr> 
                                            <td>' . $row->pp_first_name . ' ' . $row->pp_middle_name . ' ' . $row->pp_last_name .'</td> 
                                            <td>' . $row->membership_type_name . '</td> 
                                            <td>' . $date . '</td> 
                                            <td class="font-weight-bold ' . $color .'">' . $status . '</td> 
                                            <td><div class="btn-group btn-group-sm w-100" role="group" aria-label="Basic example">
                                            <button type="button"  onclick="get_pub(' . $row->pub_user_id . ')" class="btn btn-outline-secondary" data-toggle="modal" data-target="#info_modal">View Application</button>
                                            <button type="button" class="btn btn-primary">Approve</button>
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

<!-- Info Modal -->
<div class="modal fade" id="info_modal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-dark">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="docx">
            <div class="WordSection1">
                <table class="table table-bordered" id="info_table">
                    <thead class="thead-light">
                    <tr class="text-center"><th  colspan="2">Publication Grant</th></tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="export_pub()">Export</button>
      </div>
    </div>
  </div>
</div>

<!-- Deadline Modal -->
<div class="modal fade" id="deadline_modal" tabindex="-1" aria-labelledby="deadline_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deadline of application</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="<?php echo base_url('/rdlip/admin/update_deadline');?>" id="app_deadline_form" name="app_deadline_form">
        <input type="date" class="form-control" value="<?php echo $deadline; ?>" id="app_deadline" name="app_deadline"  required/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /.Deadline Modal -->
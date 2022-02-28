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
  <div class="col mt-5 text-white font-weight-bold mb-1"><h1>Backup/Restore Database</h1></div></div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3  d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Backup/Restore Database</h6>
                            
                        </div>
          <div class="card">
            <div class="card-header">
                Backup Database
            </div>
            <div class="card-body">
                <form id="export_db_form" action="<?php echo site_url('rdlip/backup/export');?>" method="POST">
                
                <strong>Export method:</strong>
                <hr/>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="export_method" id="quick_export" value="1" checked>
                    <label class="form-check-label" for="quick_export">
                        Quick - Create backup of the database
                    </label>
                </div>
                <div class="form-check mt-1 mb-3">
                    <input class="form-check-input" type="radio" name="export_method" id="custom_export" value="2">
                    <label class="form-check-label" for="custom_export">
                        Custom - Select specific table to backup
                    </label>
                </div>
                <!-- <strong>Format:</strong>
                <hr/>
                <select class="form-control w-25 form-control-sm" id="export_format" name="export_format">
                    <option value="sql">SQL</option>
                    <option value="csv">CSV</option>
                </select> -->
                <table id="sd_table" class="table table-striped mt-3 table-sm table-bordered w-50">
                        <thead>
                            <tr>
                            <th scope="col">Table</th>
                            <th scope="col">Structure</th>
                            <th scope="col">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="table-warning"><td>Select all</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="select_all_structure" name="select_all_structure">
                                    <label class="form-check-label" for="defaultCheck1">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="select_all_data" name="select_all_data">
                                    <label class="form-check-label" for="defaultCheck1">
                                    </label>
                                </div>
                            </td>
                        </tr>
                    <?php  foreach($tables as $table){

                    echo '<tr> 
                              <td>' . $table . '</td> 
                              <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="table_structure[]" value="'. $table .'" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                    </label>
                                </div>
                              </td> 
                              <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="table_data[]" value="'. $table .'" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                    </label>
                                </div>
                              </td> 
                         </tr>';
                      }?>
                        </tbody>
                    </table>
                    <div class="mt-3">
                      <button type="submit" id="export_button" class="btn btn-dark">Go</button>
                    </div>
                    </form>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                Import Backup
            </div>
            <div class="card-body">
                <form id="import_db_form" method="POST" enctype="multipart/form-data">
                
                    <div class="input-group is-invalid w-50">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="import_file" name="import_file">
                        <label class="custom-file-label" for="import_file">Choose file...</label>
                        </div>
                        <div class="input-group-append">
                        <button type="submit" class="btn btn-dark" >Go</button>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                    </div>
                </form>

                
				    <div id="success_import" class="mt-3  w-50"></div>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- csf feedback -->
<div class="modal fade" id="csf_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Client Satisfaction Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /.csf feedback -->
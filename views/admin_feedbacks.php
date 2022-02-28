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
  <div class="col mt-5 text-white font-weight-bold mb-1"><h1>Feedbacks</h1></div></div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3  d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Customer Service Feedbacks</h6>
                            
                        </div>
                        <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <!-- <li class="nav-item" role="presentation">
            <a class="nav-link active" id="uiux-tab" data-toggle="tab" href="#uiux" role="tab" aria-controls="uiux" aria-selected="true">UI/UX Feedbacks</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="uiux-grph-tab" onclick="generate_uiux_graph()" data-toggle="tab" href="#uiux-grph" role="tab" aria-controls="uiux-grph" aria-selected="false">UI/UX Graph</a>
          </li> -->
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="csf-tab" data-toggle="tab" href="#csf" role="tab" aria-controls="csf" aria-selected="false">Client Satisfaction Feedbacks</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="csf-grph-tab"  onclick="generate_csf_graph(0)" data-toggle="tab" href="#csf-grph" role="tab" aria-controls="csf-grph" aria-selected="false">CSF Graph</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="csf" role="tabpanel" aria-labelledby="csf-tab">
             <div class="table-responsive mt-3">
              <table class="table table-hover" id="cfs_table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Feedback</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $c = 1;foreach ($csf_feedbacks as $row): ?>
                  <?php $sex = ($row->pp_sex == 1) ? 'Male' : 'Female'; ?>
                    <td><?php echo $c++; ?></td>
                    <td><?php echo $row->pp_first_name . ' ' . $row->pp_middle_name . ' ' . $row->pp_last_name; ?></td>
                    <td><?php echo $sex; ?></td>
                    <td><?php echo $row->pp_email; ?></td>
                    <td><?php echo date_format(new DateTime($row->date_submitted), 'F j, Y g:i a'); ?></td>
                    <td><button class="btn btn-light text-primary" data-toggle="modal" data-target="#csf_modal" onclick="view_csf_feedback('<?php echo $row->svc_fdbk_ref; ?>')">View Feedback</button></td>
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="uiux-grph" role="tabpanel" aria-labelledby="uiux-grph-tab">
            <div class="alert alert-secondary" role="alert">
              User Interface Feedbacks
            </div>
            <div class="row">
              <div class="col-8">
                <canvas id="ui_bar_chart" height="100"></canvas>
              </div>
              <div class="col-4">
                <canvas id="ui_pie_chart" height="100"></canvas>
              </div>
						</div>
            <div class="alert alert-secondary" role="alert">
              User Experience Feedbacks
            </div>
            <div class="row">
              <div class="col-8">
                <canvas id="ux_bar_chart" height="100"></canvas>
              </div>
              <div class="col-4">
                <canvas id="ux_pie_chart" height="100"></canvas>
              </div>
						</div>
          </div>
          <div class="tab-pane fade" id="csf-grph" role="tabpanel" aria-labelledby="csf-grph-tab" >
            <select class="form-control" id="csf_questions" onchange="generate_csf_graph()">
            <option value="0">Overall Satisfcation</option>
            <?php foreach($questions as $q){
              if($q->svc_fdbk_q_id != 12 && $q->svc_fdbk_q_id != 13) // question w/o choices
              echo '<option value="'. $q->svc_fdbk_q_id . '">' . $q->svc_fdbk_q . '</option>';  } ?>
            </select>

            <div class="row">
              <div class="col-8 csf-bar">
                <canvas id="csf_bar_chart" height="100"></canvas>
              </div>
              <div class="col-4 csf-pie">
                <canvas id="csf_pie_chart" height="100"></canvas>
              </div>
						</div>
          </div>
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
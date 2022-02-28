<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
  <img class="mr-2 img-responsive" src="<?php echo base_url("assets/rdlip/img/nrcp.png");?>" width="1.5%" height="1.5%"><a class="navbar-brand" href="#">RDLIP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class=" nav-item">
        <a class="nav-link font-weight-bold text-primary border-bottom-primary" href="<?php echo base_url('rdlip/application/ilc');?>">Paper Presentation <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <span class="nav-link ml-3 mr-3 text-muted">|</span></li>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('rdlip/application/pub_gr');?>">Publication Grant</a>
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
                <!-- <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="<?php echo base_url('rdlip/login/logout');?>">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

        </ul>


  </div>
</nav>

<div class="container" >

        <!-- Outer Row -->
        <div class="row justify-content-center " >

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg" style="top:5%"> 
                    <div class="card-body text-dark ">
                        <?php if($verify_ilc == 1){ ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-warning text-center font-weight-bold" role="alert">
                                        <span class="fa fa-exclamation-triangle"></span> APPLICATION SUBMITTED SUCCESSFULLY! WAIT FOR CONFIRMATION...
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-lg-12 p-5" >
                                <h2 class="font-weight-bold mb-5 text-center">Paper Presentation</h2>
                                    <hr/>
                                    <?php foreach($personal as $row){ 

                                        $parts = explode('/', $row->pp_date_of_birth);

                                        if(count($parts) > 1){
                                            $age = date('Y') - $parts[2];
                                        }else{
                                            $parts = explode('-', $row->pp_date_of_birth);
                                            $age = date('Y') - $parts[2];
                                        }
                                    ?>
                                    <div class="form-group row pt-3">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Title</label>
                                        <div class="col-sm-1">
                                        <input type="text"  class="form-control ignore" readonly value="<?php echo $row->title_name;?>">
                                        </div>
                                        <label class="col-sm-2 col-form-label font-weight-bold">Full Name</label>
                                        <div class="col-sm-5">
                                        <input type="text" class="form-control ignore" readonly value="<?php echo $row->pp_first_name . ' ' . $row->pp_middle_name . ' ' . $row->pp_last_name . ' ' . $row->pp_extension;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Sex</label>
                                        <div class="col-sm-1">
                                        <input type="text" class="form-control ignore" readonly value="<?php echo $row->sex[0];?>">
                                        </div>
                                        <label  class="col-sm-2 col-form-label font-weight-bold">Date of Birth</label>
                                        <div class="col-sm-2">
                                        <input type="text" class="form-control ignore" readonly value="<?php echo $row->pp_date_of_birth;?>">
                                        </div>
                                        <label  class="col-sm-1 col-form-label font-weight-bold">Age</label>
                                        <div class="col-sm-2">
                                        <input type="text" class="form-control ignore" readonly value="<?php echo $age;?>">
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php foreach($home as $row){ ?> 
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Home Address</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control ignore" readonly value="<?php echo $row->adr_street_subdv . ' ' . 
                                                                                                           $row->adr_brgy . ' ' . 
                                                                                                           $row->city_name . ' ' . 
                                                                                                           $row->province_name . ' ' . 
                                                                                                           $row->adr_zip_code . ' ' . 
                                                                                                           $row->region_name . ' ' . 
                                                                                                           $row->country_name;?>">
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <hr/>
                                    <?php foreach($employment as $row){ ?> 
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Position</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control ignore" readonly value="<?php echo $row->emp_pos;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Institution</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control ignore" readonly value="<?php echo $row->emp_ins;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Office Address</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control ignore" readonly value="<?php echo $row->emp_address;?>">
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <hr/>
                                    <?php foreach($membership as $row){ ?> 
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Type of Membership</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control ignore" readonly value="<?php echo $row->membership_type_name;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Division</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control ignore" readonly value="<?php echo $row->division;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Date Approval of Membership</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control ignore" readonly value="<?php echo $row->mem_date_elected;?>">
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                <form id="rdilc_form" name="rdilc_form" action="submit_rdilc" method="post"  enctype="multipart/form-data">
                                <!-- <form id="rdilc_form" name="rdilc_form" enctype="multipart/form-data"> -->
                                    <div class="form-group row">
                                        <label for="rd_nibra_align" class="col-sm-4 col-form-label font-weight-bold text-right">NIBRA Alignment <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="rd_nibra_align" name="rd_nibra_align" required>
                                                <option value="">Select here</option>
                                                <?php foreach($nibra as $row) { ?>
                                                    <option value="<?php echo $row->nibra_id;?>"><?php echo $row->nibra_name;?></option> 
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rd_title_res_proj" class="col-sm-4 col-form-label font-weight-bold text-right">Title of Research Project <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="rd_title_res_proj" name="rd_title_res_proj" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rd_res_fund" class="col-sm-4 col-form-label font-weight-bold text-right">Research Funding Agency <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="rd_res_fund" name="rd_res_fund" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rd_years_involve" class="col-sm-4 col-form-label font-weight-bold text-right">Year/s of Research Involvement  <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-2">
                                        <input type="number" class="form-control w-75" id="rd_years_involve" name="rd_years_involve" min="1" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">First time to present this research paper? <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="rd_ft_present_1" name="rd_ft_present" class="custom-control-input" value="1" checked >
                                                <label class="custom-control-label" for="rd_ft_present_1">No</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="rd_ft_present_2" name="rd_ft_present" class="custom-control-input" value="2">
                                                <label class="custom-control-label" for="rd_ft_present_2">Yes</label>
                                            </div>
                                        </div>
                                    </div>
                                    <span id="rd_ft_yes">
                                    <div class="form-group row">
                                        <label for="rd_title_conf" class="col-sm-4 col-form-label font-weight-bold text-right">Title of Conference <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="rd_title_conf" name="rd_title_conf" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rd_conf_loc" class="col-sm-4 col-form-label font-weight-bold text-right">Location <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="rd_conf_loc" name="rd_conf_loc" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="rd_conf_period_from" class="col-sm-4 col-form-label font-weight-bold text-right">Period from <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                        <input class="form-control w-50" id="rd_conf_period_from" name="rd_conf_period_from" type="date" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rd_conf_period_to" class="col-sm-4 col-form-label font-weight-bold text-right">Period to <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                        <input class="form-control w-50" id="rd_conf_period_to" name="rd_conf_period_to" type="date" disabled>
                                        </div>
                                    </div>
                                    </span>
                         
                                    <hr/>
                                    <span id="rd_attachments">
                                     <div class="alert alert-danger text-center text-danger font-weight-bold p-1" role="alert">
                                        <span class="fa fa-exclamation-triangle"></span> Upload PDF file only - 250 KB Max File Size
                                    </div>
                                    <!--<div class="form-group row mt-3">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Endorsment Letter from the Head of Agency</label>
                                        <div class="col-sm-8">
                                            <div class="custom-file rd_end mb-3">
                                                <input type="file" class="custom-file-input" id="rd_end" name="rd_end" accept="application/pdf" required>
                                                <label class="custom-file-label" for="rd_end">Choose file...</label>
                                                <div class="file-name"></div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <h5>GENERAL REQUIREMENTS FOR ONLINE, HYBRID, OR ONSITE CONFERENCES</H5>
                                    <div class="form-group row mt-3">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Conforme signed by all the authors/members of the research team  <span class="text-danger font-weight-bold">*</span>
                                        <br/><small>(For fresh graduates with 1-3 members, a conforme from the adviser is needed.)</small></label>
                                        <div class="col-sm-8 rd_conf">
                                            <div class="input-group is-invalid ">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="rd_conf" name="rd_conf" accept="application/pdf" required>
                                                <label class="custom-file-label" for="rd_end">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                            <div class="mt-3 small">
                                            Download: <a class="bnt-lin" href="<?php echo base_url("assets/rdlip/uploads/downloadables/paperpresentation/NRCP RDLIP PAPER PRESENTATION FORM 1 (Conferme).doc");?>">NRCP RDLIP PAPER PRESENTATION FORM 1 (Conforme)</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Abstract  <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8 rd_abs">
                                            <div class="input-group is-invalid">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="rd_abs" name="rd_abs" accept="application/pdf" required>
                                                <label class="custom-file-label" for="rd_abs">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                            <div class="mt-3 small">
                                            Download: <a class="bnt-lin" href="<?php echo base_url("assets/rdlip/uploads/downloadables/paperpresentation/NRCP RDLIP PAPER PRESENTATION FORM 2 (Abstract).docx");?>">NRCP RDLIP PAPER PRESENTATION FORM 2 (Abstract)</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Letter of invitation and letter of acceptance from the conference organizer <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8 rd_invi">
                                            <div class="input-group is-invalid">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="rd_invi" name="rd_invi" accept="application/pdf" required>
                                                <label class="custom-file-label" for="rd_invi">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Conference Program <small>(optional)</small></label>
                                        <div class="col-sm-8 rd_conf_prog">
                                            <div class="input-group is-invalid">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="rd_conf_prog" name="rd_conf_prog" accept="application/pdf">
                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Travel or Conference Report, within 30 days after the conference <small>(optional)</small></label>
                                        <div class="col-sm-8 rd_tcr">
                                            <div class="input-group is-invalid">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="rd_tcr" name="rd_tcr" accept="application/pdf">
                                                <label class="custom-file-label" for="rd_tcr">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                            <div class="mt-3 small">
                                            Download: <a class="bnt-lin" href="<?php echo base_url("assets/rdlip/uploads/downloadables/paperpresentation/NRCP RDLIP PAPER PRESENTATION FORM 3 (Conference Report).docx");?>">NRCP RDLIP PAPER PRESENTATION FORM 3 (Conference Report)</a>
                                            <br/>
                                            Download: <a class="bnt-lin" href="<?php echo base_url("assets/rdlip/uploads/downloadables/paperpresentation/NRCP RDLIP PAPER PRESENTATION FORM 4 (Travel Report).docx");?>">NRCP RDLIP PAPER PRESENTATION FORM 4 (Travel Report)</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Liquidation Report <small>(optional)</small></label>
                                        <div class="col-sm-8 rd_liqr">
                                            <div class="input-group is-invalid">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="rd_liqr" name="rd_liqr" accept="application/pdf" >
                                                <label class="custom-file-label" for="rd_liqr">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <h5>ADDITIONAL REQUIREMENTS OF FOREIGN AND LOCAL TRAVEL (ONSITE)</h5>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Pre and Actual Itinerary of Travel <small>(optional)</small></label>
                                        <div class="col-sm-8 rd_iot">
                                            <div class="input-group is-invalid">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="rd_iot" name="rd_iot" accept="application/pdf">
                                                <label class="custom-file-label" for="rd_iot">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Travel Authority issued by the NRCP <small>(optional)</small></label>
                                        <div class="col-sm-8 rd_auth">
                                            <div class="input-group is-invalid">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="rd_auth" name="rd_auth" accept="application/pdf">
                                                <label class="custom-file-label" for="rd_auth">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Original copy of plane tickets <small>(optional)</small></label>
                                        <div class="col-sm-8 rd_tix">
                                            <div class="input-group is-invalid">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="rd_tix" name="rd_tix" accept="application/pdf" >
                                                <label class="custom-file-label" for="rd_tix">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Other official receipts (Hotels, Transportations, Meals) <small>(optional)</small></label>
                                        <div class="col-sm-8 rd_other_or">
                                            <div class="input-group is-invalid">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="rd_other_or" name="rd_other_or" accept="application/pdf" >
                                                <label class="custom-file-label" for="rd_other_or">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Latest DSA copy <small>(optional)</small></label>
                                        <div class="col-sm-8 rd_dsa">
                                            <div class="input-group is-invalid">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="rd_dsa" name="rd_dsa" accept="application/pdf" >
                                                <label class="custom-file-label" for="rd_dsa">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                        </div>
                                    </div>
                                    </span>
                                    <?php if($verify_ilc == 0){ ?>
                                    <hr/>
                                    <div class="text-right">
                                    <span class="text-danger font-weight-bold mr-3">Once submitted, your application cannot be modified.</span>
                                    <button type="submit" id="submit_flc" name="submit" value="Submit" class="w-25 btn btn-primary border-left-primary">Submit</button>
                                    <!-- <button type="button" id="submit_ilc" class="w-25 btn btn-primary border-left-primary">Submit</button> -->
                                    <!-- data-toggle="modal" data-target="#confirmModal" -->
                                    </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="thankyouModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-striped w-100" id="member_table">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<!-- <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <p>Once submitted, your application cannot be modified.
            </div>
            <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" id="submit_ilc">Proceed</button>
            </div>
        </div>
    </div>
</div> -->
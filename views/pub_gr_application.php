<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
  <img class="mr-2 img-responsive" src="<?php echo base_url("assets/rdlip/img/nrcp.png");?>" width="1.5%" height="1.5%"><a class="navbar-brand" href="#">RDLIP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class=" nav-item">
        <a class="nav-link" href="<?php echo base_url('rdlip/application/ilc');?>">Paper Presentation <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <span class="nav-link ml-3 mr-3 text-muted">|</span></li>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold text-primary border-bottom-primary" href="<?php echo base_url('rdlip/application/pub_gr');?>">Publication Grant</a>
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
        <div class="row justify-content-center" >

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg mb-5" style="top:5%"> 
                    <div class="card-body text-dark ">
                        <?php if($verify_pubgr != ''){ ?>
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
                                <h2 class="font-weight-bold mb-5 text-center">Publication Grant</h2>
                                <form id="rdpubgr_form" action="submit_rdpubgr" method="post"  enctype="multipart/form-data">
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
                                        <input type="text"  class="form-control" readonly value="<?php echo $row->title_name;?>">
                                        </div>
                                        <label class="col-sm-2 col-form-label font-weight-bold">Full Name</label>
                                        <div class="col-sm-5">
                                        <input type="text" class="form-control" readonly value="<?php echo $row->pp_first_name . ' ' . $row->pp_middle_name . ' ' . $row->pp_last_name . ' ' . $row->pp_extension;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Sex</label>
                                        <div class="col-sm-1">
                                        <input type="text" class="form-control" readonly value="<?php echo $row->sex[0];?>">
                                        </div>
                                        <label  class="col-sm-2 col-form-label font-weight-bold">Date of Birth</label>
                                        <div class="col-sm-2">
                                        <input type="text" class="form-control" readonly value="<?php echo $row->pp_date_of_birth;?>">
                                        </div>
                                        <label  class="col-sm-1 col-form-label font-weight-bold">Age</label>
                                        <div class="col-sm-2">
                                        <input type="text" class="form-control" readonly value="<?php echo $age;?>">
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php foreach($home as $row){ ?> 
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Home Address</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $row->adr_street_subdv . ' ' . 
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
                                        <input type="text" class="form-control" readonly value="<?php echo $row->emp_pos;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Institution</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $row->emp_ins;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Office Address</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $row->emp_address;?>">
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <hr/>
                                    <?php foreach($membership as $row){ ?> 
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Type of Membership</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $row->membership_type_name;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Division</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $row->division;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label font-weight-bold text-right">Date Approval of Membership</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $row->mem_date_elected;?>">
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="form-group row">
                                        <label for="pub_nibra_alignment" class="col-sm-4 col-form-label font-weight-bold text-right">NIBRA Alignment <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="pub_nibra_alignment" name="pub_nibra_alignment" required>
                                                <option value="">Select here</option>
                                                <?php foreach($nibra as $row) { ?>
                                                    <option value="<?php echo $row->nibra_id;?>"><?php echo $row->nibra_name;?></option> 
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pub_title_research" class="col-sm-4 col-form-label font-weight-bold text-right">Title of Research Project <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="pub_title_research" name="pub_title_research" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pub_res_fund" class="col-sm-4 col-form-label font-weight-bold text-right">Research Funding Agency <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="pub_res_fund" name="pub_res_fund" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pub_years_involve" class="col-sm-4 col-form-label font-weight-bold text-right">Year/s of Research Involvement <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-2">
                                        <input type="number" class="form-control w-75" id="pub_years_involve" name="pub_years_involve" min="1" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">First time to publish this research paper in ISI/Scopus indexed journal? <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="pub_ft_present_1" name="pub_ft_publish" class="custom-control-input" value="1" checked>
                                                <label class="custom-control-label" for="pub_ft_present_1">No</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="pub_ft_publish_2" name="pub_ft_publish" class="custom-control-input" value="2">
                                                <label class="custom-control-label" for="pub_ft_publish_2">Yes</label>
                                            </div>
                                        </div>
                                    </div>
                                    <span id="pub_ft_yes">
                                    <div class="form-group row">
                                        <label for="pub_publisher" class="col-sm-4 col-form-label font-weight-bold text-right">Name of Publisher <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="pub_publisher" name="pub_publisher" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pub_loc" class="col-sm-4 col-form-label font-weight-bold text-right">Location <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="pub_loc" name="pub_loc" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="pub_date" class="col-sm-4 col-form-label font-weight-bold text-right">Publication date <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8">
                                        <input class="form-control w-50" id="pub_date" name="pub_date" type="date" disabled>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row ">
                                        <label for="pub_period_from" class="col-sm-4 col-form-label font-weight-bold text-right">Period from</label>
                                        <div class="col-sm-8">
                                        <input class="form-control w-50" id="pub_period_from" name="pub_period_from" type="date" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pub_period_to" class="col-sm-4 col-form-label font-weight-bold text-right">Period to</label>
                                        <div class="col-sm-8">
                                        <input class="form-control w-50" id="pub_period_to" name="pub_period_to" type="date" disabled>
                                        </div>
                                    </div> -->
                                    </span>
                         
                                    <hr/>
                                    <span id="pub_attachments">
                                    <div class="alert alert-danger text-center text-danger font-weight-bold p-1" role="alert">
                                        <span class="fa fa-exclamation-triangle"></span> Upload PDF file only - 250 KB Max File Size
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Certification/Conforme <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8 att_cert_oath_conf">
                                            <div class="input-group is-invalid ">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="att_cert_oath_conf" name="att_cert_oath_conf" accept="application/pdf" required>
                                                <label class="custom-file-label" for="att_cert_oath_conf">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                            <div class="mt-3 small">
                                            Download: <a class="bnt-lin" href="<?php echo base_url("assets/rdlip/uploads/downloadables/publicationgrant/NRCP RDLIP Publication Grant Form 1 (Conforme).docx");?>">NRCP RDLIP Publication Grant Form 1 (Conforme)</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Abstract <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8 att_abstract">
                                            <div class="input-group is-invalid ">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="att_abstract" name="att_abstract" accept="application/pdf" required>
                                                <label class="custom-file-label" for="att_abstract">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                            <div class="mt-3 small">
                                            Download: <a class="bnt-lin" href="<?php echo base_url("assets/rdlip/uploads/downloadables/publicationgrant/NRCP RDLIP Publication Grant Form 2 (Abstract).docx");?>">NRCP RDLIP Publication Grant Form 2 (Abstract)</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Conforme signed by all the authors
                                        <small>(optional)</small></label>
                                        <div class="col-sm-8 att_conf">
                                            <div class="input-group is-invalid ">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="att_conf" name="att_conf" accept="application/pdf">
                                                <label class="custom-file-label" for="att_conf">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Notice of acceptance of the manuscript from the Publisher <span class="text-danger font-weight-bold">*</span></label>
                                        <div class="col-sm-8 att_notice">
                                            <div class="input-group is-invalid ">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="att_notice" name="att_notice" accept="application/pdf" required>
                                                <label class="custom-file-label" for="att_notice">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Copy of the publication in the journal
                                         <small>(optional)</small></label>
                                        <div class="col-sm-8 att_copy_pub">
                                            <div class="input-group is-invalid ">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="att_copy_pub" name="att_copy_pub" accept="application/pdf" >
                                                <label class="custom-file-label" for="att_copy_pub">Choose file...</label>
                                                </div>
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary ilc_clear" type="button">Clear</button>
                                                </div>
                                            </div>
                                            <div class="file-validation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label font-weight-bold text-right">Link to the publication
                                         <small>(optional)</small></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="link_pub" name="link_pub" >
                                        </div>
                                    </div>
                                    </span>
                                    <?php if($verify_pubgr == 0){ ?>
                                    <hr/>
                                    <div class="text-right">
                                    <span class="text-danger font-weight-bold mr-3">Once submitted, your application cannot be modified.</span>
                                    <button type="submit" name="submit" value="Submit" class="w-25 btn btn-primary border-left-primary">Submit</button>
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

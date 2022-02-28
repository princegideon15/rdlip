<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg" style="top:50%">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 text-center p-5">
                            <img class="img-fluid" src="<?php echo base_url("assets/rdlip/img/nrcp.png");?>" width="80%" height="80%">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" method="post" action="admin/auth">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg"
                                            id="usr_username" name="usr_username"
                                            placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg"
                                            id="usr_password" name="usr_password" placeholder="Password" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div> -->
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($this->session->flashdata('login_msg')) {
                $msg = $this->session->flashdata('login_msg');
                $message = $msg['msg'];
                $icon = $msg['icon'];?>
                <div class="card-footer  text-white bg-danger">
                <div class="text-center font-weight-bold mb-0" style="font-size:16px">
                <span class="<?php echo $icon; ?>"></span> <?php echo $message; ?>
                </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
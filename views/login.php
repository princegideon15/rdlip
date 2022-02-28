<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg" style="top:50%">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 text-center p-5" style="background-image: url('<?php echo base_url("assets/rdlip/img/nrcp.png");?>');
                        background-position: center; /* Center the image */
                        background-repeat: no-repeat; /* Do not repeat the image */
                        background-size: cover; /* Resize the background image to cover the entire container */">
                                                    <!-- <img class="img-fluid" src="" width="70%" height="70%"> -->
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="">
                                    <h1 class="h4 text-gray-900">Login for Members Only</h1>
                                    <hr/>
                                </div>
                                <form class="user" method="post" action="login/auth">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-lg"
                                            id="usr_name" name="usr_name" aria-describedby="emailHelp"
                                            placeholder="SKMS Username" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg"
                                            id="usr_password" name="usr_password" placeholder="SKMS Password" required>
                                    </div>
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
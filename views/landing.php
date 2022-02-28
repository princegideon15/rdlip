<div class="container-fluid">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg bg-transparent text-white mb-5"  style="top:4%;">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-lg-12 p-1">
                            <div class="text-center">
                            <img src="<?php echo base_url("assets/rdlip/img/nrcp.png");?>" width="10%" height="10%">
                            </div>
                            <!--  -->
                            <h1 class="font-weight-bold">RESEARCH DISSEMINATION IN LOCAL AND INTERNATIONAL PLATFORMS (RDLIP) FINANCIAL GRANTS</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="<?php echo base_url("assets/rdlip/uploads/nrcpvideo.mp4");?>"  allowfullscreen ></iframe>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-3">
                                <span style="font-size:20px;">
                                <p>
                                The Support to Research Dissemination in Local and International Platforms or <b>RDLIP</b> is one of the three components of the new project of the National Research Council of the Philippines titled, 
                                <b>B</b>asic 
                                <b>R</b>esearch 
                                <b>I</b>nformation 
                                <b>T</b>ranslation for 
                                <b>E</b>mpowerment in the
                                <b>R</b>egions Program or BRITER. This project promotes a science culture in the regions for global competitiveness.
                                The RDLIP component gives researchers an opportunity to present their research results locally or abroad and to publish research papers in ISI or Scopus indexed journals.
                                </p>
                                <hr/>
                                <h3><span class="font-weight-bold">Financial Grant for Paper Presentation in Local and International Conferences</span>
                                <br/>
                                <em>(For August 1, 2021 – January 31, 2022 conferences)</em></h3>

                                <br/>
                                <p>
                                Local and international conferences offer an excellent opportunity for disseminating research results. It also provides opportunity to NRCP-member researchers to be updated on the latest developments in their fields of specialization and lead to the establishment of mutually beneficial partnerships with local and international researchers.

This grant is open to all NRCP Members who wish to avail the support to scientific research dissemination in local and international conferences/workshops/fora to present research outputs which are aligned to the NRCP National Integrated Basic Research Agenda (NIBRA). The projects may either be supported by NRCP, other DOST councils, or their respective institutions.

                                </p>   

                                <p>
                                All members, preferably new and young NRCP Members from new partner institutions, can avail of the DOST-NRCP support to research dissemination in local and international conferences/workshops/forums to present research outputs from projects that were either supported by NRCP, other DOST councils, or their institutions which are aligned to the NRCP National Integrated Basic Research Agenda (NIBRA) [basic research]).
                                </p>

                                <hr/>
                                <h3><span class="font-weight-bold">Financial Grant for Publication in ISI and Scopus Indexed Journals</span>
                                <br/>
                                <em>(Publication period from January 1, 2021 – December 31, 2021)</em></h3>

                                <br/>
                                <p>
                                The RDLIP Publication grant of NRCP provides financial support for the publication of research papers in journals that are indexed by SCOPUS, Clarivate, or Thomson Reuters. All NRCP Members are encouraged to apply for this grant. Preference is given to new members of NRCP, those who come from new partner institutions, and up-and-coming researchers, especially those who are in the process of developing and establishing their professional career in research. The review process is merit-based. 
                                </p>

                                <hr/>
                                <!-- See more details, Click <a href="<?php echo base_url("assets/rdlip/uploads/RDLIP_ilc.pdf");?>" target="_blank">here</a>. -->
                                <p class="text-white font-weight-bold">Guidelines and Requirements:</p>
                                <div class="text-white">
                                    <ul class="list-group pl-3">
                                        <li class="btn-link text-white">
                                            <a class="text-white" href="<?php echo base_url("assets/rdlip/uploads/mechanics/FINAL_Proposed-Guidelines-Paper-Presenation.pdf");?>" target="_blank">
                                            Financial Grant for Paper Presentation in Local and International Conferences
                                        </a></li>
                                        <li class="btn-link text-white">
                                            <a class="text-white" href="<?php echo base_url("assets/rdlip/uploads/mechanics/FINAL_Proposed-Guidelines-Publication-Grant-1.pdf");?>" target="_blank">
                                            Financial Grant for Publication in ISI and Scopus Indexed Journals
                                        </a></li>
                                    </ul>  
                                </div>
                                <br/>
                                <div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col text-center">
                                <h5 class="font-weight-bold text-warning"> Deadline of application:  <?php echo date("d M Y", strtotime($deadline));?></span>
                                </h5>
                                <?php if(date("Y-m-d") >= $deadline){
                                // no apply button
                                }else{
                                    $link = base_url('rdlip/login');
                                echo '<a href="' . $link  .'" type="button" class="btn btn-lg btn-light text-primary font-weight-bold w-25">APPLY</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<div class="container-fluid " style="padding-top:70px;padding-bottom:70px;">
	<div class="row justify-content-center pt-3">
	  <div class="col-8">
        <div class="jumbotron">
                <h3>DOST-NRCP Client Satisfaction Feedback Form</h3>
                <p>
The National Research Council of the Philippines (NRCP) of the Department of Science and Technology (DOST) would like to ask for your feedback in order to improve the services it offers to its clients particularly in the research funding and dissemination and NRCP membership application.

Rest assured that your responses will be treated with the utmost confidentiality and personal information provided will be used for verification purposes only.
                </p>
                <form id="csf_form" name="csf_form" action="<?php echo base_url('/rdlip/application/submit_feedback');?>" method="post" accept-charset="utf-8">
                <!-- <input type="hidden" name="client_id" value="<?php echo $client_id;?>"> -->
                <u>Privacy Notice and Consent</u>
                <div class="form-check pt-3"> 
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
                    <label class="form-check-label" for="defaultCheck1">
                    In submitting this form, I agree to my details being used for the purposes of gathering feedback and comments on the services of DOST-NRCP. The information will only be accessed by authorized personnel of DOST-NRCP. I understand my data will be held securely and will not be distributed to third parties. I have a right to change or access my information. I understand that when this information is no longer required for this purpose, DOST-NRCP procedure will be followed to dispose of my data.
                    </label>
                </div>
                <br/>
                <p class="text-danger">Required *</p>
                <hr/>
                <?php foreach($questions as $q){
                     echo '<div class="pb-3"> 
                           <p class="mb-2 font-weight-bold">'. $q->svc_fdbk_q_order . '. ' . $q->svc_fdbk_q . ' <span class="text-danger">*</span></p>';

                     if($q->svc_fdbk_q_choices != ''){   
                         
                        if($q->svc_fdbk_q_id == 1){

                            echo '<input type="hidden" name="svc_fdbk_q_id[]" value="'. $q->svc_fdbk_q_id .'">';
                            foreach($affiliations as $a){
                            
                                echo '<div class="form-check">
                                <input class="form-check-input" type="radio" name="svc_fdbk_q_answer[1]" id="aff'. $a->aff_type_id .'" value="'. $a->aff_type_id .'" required>
                                <label class="form-check-label" for="aff'. $a->aff_type_id .'">'. $a->aff_type .'</label>
                                </div>';
                             }
                        }else if($q->svc_fdbk_q_id == 2){
                            echo '<input type="hidden" name="svc_fdbk_q_id[]" value="'. $q->svc_fdbk_q_id .'">';
                            foreach($services as $s){

                                $checked = ($s->nrcp_svc_id == 1) ? 'checked="checked" enabled' : 'disabled';
                            
                                echo '<div class="form-check">
                                <input class="form-check-input" type="radio" name="svc_fdbk_q_answer[2]" id="service'. $s->nrcp_svc_id .'" value="'. $s->nrcp_svc_id .'" '. $checked .' required>
                                <label class="form-check-label" for="service'. $s->nrcp_svc_id .'">'. $s->nrcp_svc .'</label>
                                </div>';
                             }
                        }else{
                            
                            echo '<input type="hidden" name="svc_fdbk_q_id[]" value="'. $q->svc_fdbk_q_id .'">';
                            foreach($choices as $c){
                            
                                echo '<div class="form-check">
                                <input class="form-check-input" type="radio" name="svc_fdbk_q_answer['. $q->svc_fdbk_q_order .']" id="q'. $q->svc_fdbk_q_order .'_'. $c->svc_fdbk_rating_id .'" value="'. $c->svc_fdbk_rating_id .'" required>
                                <label class="form-check-label" for="q'. $q->svc_fdbk_q_order .'_'. $c->svc_fdbk_rating_id .'">'. $c->svc_fdbk_rating .'</label>
                                </div>';
                             }
                        }
                     }else{
                           echo '<input type="hidden" name="svc_fdbk_q_id[]" value="'. $q->svc_fdbk_q_id .'">';
                           echo '<textarea name="svc_fdbk_q_answer['. $q->svc_fdbk_q_order .']" class="form-control" required></textarea>';
                     }

                     echo '</div>';
                    


                } ?>
                <div class="text-right"><button type="submit" class="btn btn-primary">Submit Feedback</button></div>
                </form>

        </div>
      </div>
    </div>
</div>
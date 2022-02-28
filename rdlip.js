var last_name_for_export;

$(document).ready(function() {



    $(".ilc_clear").click(function() {
        $(this).closest('div.input-group').find("input").val('');
        $(this).closest('div.input-group').find("label").text('Choose file...');
    });

    
    $("input").click(function() {
        $(this).closest('div.input-group').find("input").val('');
        $(this).closest('div.input-group').find("label").text('Choose file...');
    });

    
    // $('.nrcpvideo').get(0).play();
    // document.getElementById('nrcpvideo').play();
    $('#cfs_table').dataTable();
    $('#ilc_table').dataTable();
    $('#pub_table').dataTable();
    $('#log_table').dataTable({
        order: [
            [4, 'desc']
        ]
    });
    $('#user_table').dataTable({
        order: [
            [1, 'desc']
        ]
    });

    // ilc

    $('input[name="rd_ft_present"]').change(function(){
        var val = $('input[name="rd_ft_present"]:checked').val();
        if(val == 2){
            $('#rd_ft_yes input').attr('disabled', false);
            $('#rd_ft_yes input').attr('required', true);
        }else{
            $('#rd_ft_yes input').attr('disabled', true);
            $('#rd_ft_yes input').val('');
            $('#rd_ft_yes input').attr('required', false);
        }
    });

  
    // $('#rd_conf').on('change', function(e){
    $('input[type=file]').on('change', function(e){
        // var tmppath = URL.createObjectURL(e.target.files[0]);
        var filename = $(this)[0].files[0].name;   
        var ext = filename.split('.').pop().toLowerCase();
        var id = $(this)[0].id;


        if($(this)[0].files[0].size > 250000){
            var ele = '<span class="badge badge-danger">File exceeds 250 KB limit.</span>';
            // var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
            //              <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
            //            </div>';
                       $(this).val('');  
        }else{
            if($.inArray(ext, ['pdf']) == -1) {
                var ele = '<span class="badge badge-danger">Invalid format. Please upload PDF file only.</span>';
                // var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center font-weight-bold" role="alert"> \
                //     <span class="fa fa-exclamation-triangle"></span> Please upload PDF format file only.\
                // </div>';
                $(this).val('');
            }else{
                // $('.rd_conf .custom-file-label').text(filename);
                $(this).closest('div.custom-file').find("label").text(filename);
                // var ele = '<span class="badge badge-success">Accepted! Click here to check your file.</span>';
                // var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
                //     <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
                // </div>';
            }
        }
        
        $(this).closest('div.' + id).find("span.badge").remove();
        $(this).closest('div.' + id).find("div.file-validation").append(ele);
        // $('.rd_conf .file-validation .badge').remove();
        // $('.rd_conf .file-validation').append(ele);  
    });

    // $('#rd_abs').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.rd_abs .file-name .alert').remove();
    //     $('.rd_abs .file-name').append(ele);  
    // });

    // $('#rd_invi').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.rd_invi .file-name .alert').remove();
    //     $('.rd_invi .file-name').append(ele);  
    // });

    // $('#rd_conf_prog').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.rd_conf_prog .file-name .alert').remove();
    //     $('.rd_conf_prog .file-name').append(ele);  
    // });

    // $('#rd_tcr').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.rd_tcr .file-name .alert').remove();
    //     $('.rd_tcr .file-name').append(ele);  
    // });

    // $('#rd_liqr').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.rd_liqr .file-name .alert').remove();
    //     $('.rd_liqr .file-name').append(ele);  
    // });

    // $('#rd_iot').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.rd_iot .file-name .alert').remove();
    //     $('.rd_iot .file-name').append(ele);  
    // });

    // $('#rd_auth').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.rd_auth .file-name .alert').remove();
    //     $('.rd_auth .file-name').append(ele);  
    // });

    // $('#rd_tix').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.rd_tix .file-name .alert').remove();
    //     $('.rd_tix .file-name').append(ele);  
    // });

    // $('#rd_other_or').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.rd_other_or .file-name .alert').remove();
    //     $('.rd_other_or .file-name').append(ele);  
    // });

    // $('#rd_dsa').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.rd_dsa .file-name .alert').remove();
    //     $('.rd_dsa .file-name').append(ele);  
    // });
    
    $.ajax({
        method: 'GET',
        url: base_url + 'rdlip/application/get_ilc_info',
        async: false,
        dataType: "json",
        success: function (response) {

            if(response.length > 0)
            $('#rd_attachments .alert-danger').remove();
            

            $.each(response, function(key, val){

                $.each(val, function(k , v){
                    if(k == 'rd_ft_present'){
                        // $('#rdilc_form input:radio[name=rd_ft_present]').prop('checked',true);
                        $('#rdilc_form input:radio[name=rd_ft_present]').attr('disabled', true);
                        $('#rdilc_form input:radio[name=rd_ft_present]').filter('[value="'+ v +'"]').attr('checked', true);
                    }else{
                        $('#rdilc_form #'+k).val(v);
                        $('#rdilc_form #'+k).attr('readonly', true);
                    }     
                });
            });

        }
    });

    $.ajax({
        method: 'GET',
        url: base_url + 'rdlip/application/get_ilc_attachments',
        async: false,
        dataType: "json",
        success: function (response) {

            var folders = ['conforme', 'abstract', 'invitation', 'conferenceprogram', 'tcr', 'liqr', 'preiot', 'auth', 'tix', 'other_or', 'dsa'];
            var f = 0;

            if(response.length > 0)
            $.each(response, function(key, val){

                $.each(val, function(k , v){
                         
                    if(k != 'row_id' && k != 'rd_user_id'){

                        if(v == '-'){
                            var pdf = v;
                        }else{
                            var pdf = '<a class="btn-link" href="'+ base_url + 'assets/rdlip/uploads/ilc_files/' + folders[f] + '/' + v + '" target="_blank">' + v + '</a>';
                        }

                        $('#rd_attachments .custom-file.'+k).replaceWith('<div class="alert alert-light"> \
                        ' + pdf + '</div>'); 
                        f++;
                    }
                });
            });

        }
    });

     // pub_gr

     $('input[name="pub_ft_publish"]').change(function(){
        var val = $('input[name="pub_ft_publish"]:checked').val();
        if(val == 2){
            $('#pub_ft_yes input').attr('disabled', false);
            $('#pub_ft_yes input').attr('required', true);
        }else{
            $('#pub_ft_yes input').attr('disabled', true);
            $('#pub_ft_yes input').val('');
            $('#pub_ft_yes input').attr('required', false);
        }
    });

    // $('#att_cert_oath_conf').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.att_cert_oath_conf .file-name .alert').remove();
    //     $('.att_cert_oath_conf .file-name').append(ele);  
    // });

    // $('#att_abstract').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.att_abstract .file-name .alert').remove();
    //     $('.att_abstract .file-name').append(ele);  
    // });

    // $('#att_conf').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.att_conf .file-name .alert').remove();
    //     $('.att_conf .file-name').append(ele);  
    // });

    // $('#att_notice').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.att_notice .file-name .alert').remove();
    //     $('.att_notice .file-name').append(ele);  
    // });

    // $('#att_copy_pub').on('change', function(e){
    //     $(this).val();  
    //     var tmppath = URL.createObjectURL(e.target.files[0]);

    //     if($(this)[0].files[0].size > 250000){
    //         var ele = '<div class="alert alert-danger p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <span class="fa fa-exclamation-triangle"></span> File exceeds 250 KB \
    //                    </div>';
    //                    $(this).val('');  
    //     }else{
    //         var ele = '<div class="alert alert-success p-2 mb-2 mt-2 text-center" role="alert"> \
    //                      <a class="text-success" href="' + tmppath + '" target="_blank">' +$(this).val().split('\\').pop() + '</a>\
    //                    </div>';
    //     }

    //     $('.att_copy_pub .file-name .alert').remove();
    //     $('.att_copy_pub .file-name').append(ele);  
    // });
    
    $.ajax({
        method: 'GET',
        url: base_url + 'rdlip/application/get_pub_info',
        async: false,
        dataType: "json",
        success: function (response) {

            if(response.length > 0)
            $('#pub_attachments .alert-danger').remove();
            

            $.each(response, function(key, val){

                $.each(val, function(k , v){
                    if(k == 'pub_ft_publish'){
                        // $('#rdpubgr_form input:radio[name=pub_ft_publish]').prop('checked',true);
                        $('#rdpubgr_form input:radio[name=pub_ft_publish]').attr('disabled', true);
                        $('#rdpubgr_form input:radio[name=pub_ft_publish]').filter('[value="'+ v +'"]').attr('checked', true);
                    }else{
                        $('#rdpubgr_form #'+k).val(v);
                        $('#rdpubgr_form #'+k).attr('readonly', true);
                    }     
                });
            });

        }
    });

    $.ajax({
        method: 'GET',
        url: base_url + 'rdlip/application/get_pub_attachments',
        async: false,
        dataType: "json",
        success: function (response) {

            var folders = ['certification', 'abstract', 'conforme', 'notice', 'pub'];
            var f = 0;


            if(response.length > 0)
            $.each(response, function(key, val){
                $.each(val, function(k , v){
                    if(k != 'row_id' && k != 'att_user_id'){

                        if(v == '-'){
                            var pdf = v;
                        }else{
                            var pdf = '<a class="btn-link" href="'+ base_url + 'assets/rdlip/uploads/pub_files/' + folders[f] + '/' + v + '" target="_blank">' + v + '</a>';
                        }
    
                        $('#pub_attachments .custom-file.'+k).replaceWith('<div class="alert alert-light"> \
                        ' + pdf + '</div>'); 
                        f++;
                  
                    }
                });
            });

        }
    });

 

     $("#add_user_form").validate({
        debug: true,
        errorClass: 'text-danger',
        rules: {
            usr_username: {
                required: true,
                minlength: 5,
            },
            usr_password: {
                required: true,
                minlength: 5,
                equalTo: '#repeat_password',
            },
            repeat_password: {
                required: true,
                minlength: 5,
                equalTo: '#usr_password',
            },
            usr_role: {
                required: true,
            },
        },
        submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url: base_url + "rdlip/admin/add_user",
                data: $('#add_user_form').serializeArray(),
                cache: false,
                crossDomain: true,
                success: function(data) {
                    // console.log(data);
                    location.reload();
                }
            });
        }
    });

    $("#edit_user_form").validate({
        debug: true,
        errorClass: 'text-danger',
        ignore: "#current_password",
        rules: {
            usr_username: {
                required: true,
                minlength: 5,
            },
            usr_password: {
                minlength: 5,
                equalTo: '#edit_user_form #repeat_password',
            },
            repeat_password: {
                minlength: 5,
                equalTo: '#edit_user_form #usr_password',
            },
            usr_role: {
                required: true,
            },
        },
        submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url: base_url + "rdlip/admin/update_user",
                data: $('#edit_user_form').serializeArray(),
                cache: false,
                crossDomain: true,
                success: function(data) {
                    console.log(data);
                    // location.reload();
                }
            });
        }
    });

    $("#select_all_structure").change(function() {
        if (this.checked) {
            $("input[name='table_structure[]']").each(function() {
                this.checked=true;
            });
        } else {
            $("input[name='table_structure[]']").each(function() {
                this.checked=false;
            });
        }
      });
    
      $("#select_all_data").change(function() {
          if (this.checked) {
              $("input[name='table_data[]']").each(function() {
                  this.checked=true;
              });
          } else {
              $("input[name='table_data[]']").each(function() {
                  this.checked=false;
              });
          }
      });
    
      $('#sd_table').hide();
    
      $('#quick_export').change(function(){
    
          $('#sd_table').hide();
      });
    
      $('#custom_export').change(function(){
    
          $('#sd_table').show();
      });
    
      
      $('#import_file').change(function(){
        $('.custom-file-label').text($(this).val().split('\\').pop());
      });
  
      $("#import_db_form").validate({
          debug: true,
          errorClass: 'text-danger',
          rules: {
              import_file: {
                  required: true,
              },
          },
          errorLabelContainer: '.invalid-feedback',
          submitHandler: function() {
            
              var form = $('#import_db_form');
              var formdata = false;
      
              if(window.FormData)
              {
                formdata = new FormData(form[0]);
              }
      
              $.ajax({
                  type: "POST",
                  url: base_url + 'rdlip/backup/import',
                  data : formdata ? formdata :form.serialize(),
                  contentType: false,
                  processData: false,
                  success: function(response) {
                          if(response == 1){
                              $('#success_import').hide().append('<div class="alert alert-success" role="alert"> \
                              SQL file imported successfully! \
                              </div>').fadeIn(1000);
                          }
                  }
              });
          }
        });

});

function get_ilc(id){

    $('#info_table tbody').empty();

    var personal = ['Title', 'Last Name', 'First Name', 'Middle Name', 'Extension', 'Sex', 'Date of Birth', 'Age'];
    var address = [];
    var employment = ['Position', 'Institution', 'Office Address'];
    var membership = ['Type of Membership', 'Division', 'Date Approval of Membership'];
    var ilc = ['NIBRA Alignment', 'Title of Research Project', 'Research Funding Agency', 'Year/s of Research Involvement',
                 'First time to publish this research paper in ISI/Scopus indexed journal', 'Title of Conference', 'Location', 'Period from', 'Perdio to'];
    var attach = ['Conforme signed by all the authors/members of the research team ', 
                  'Abstract', 
                  'Letter of invitation and letter of acceptance from the conference organizer', 
                  'Conference Program (optional)', 
                  'Travel or Conference Report, within 30 days after the conference (optional)', 
                  'Liquidation Report (optional)', 
                  'Pre and Actual Itinerary of Travel (optional)',
                  'Travel Authority issued by the NRCP (optional)',
                  'Original copy of plane tickets (optional)', 
                  'Other official receipts (Hotels, Transportations, Meals) (optional)',
                  'Latest DSA copy (optional)'];
    
    var p = 0;

    $('#info_modal .modal-title').text('Paper Presentation - Application details');

    $.ajax({
        type: "GET",
        url: base_url + "rdlip/admin/get_member_personal/" + id,
        dataType: "json",
        crossDomain: true,
        success: function(data) {
            $.each(data, function(key, value){
                last_name_for_export = value.pp_last_name;
                $.each(value, function(k, v){   

                    v = (v == '' || v == null) ? '-' : v ;

                    if(k == 'pp_usr_id'){
                        var today = moment(new Date()).format("YYYY");
                        var bday_format = moment(value.pp_date_of_birth).format("MM/DD/YYYY");
                        var bday = bday_format.split('/');
                        v = today - bday[2];
                    }

                    v = (k == 'pp_date_of_birth') ? moment(v).format("DD MMM YYYY") : v;

                    $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">' + personal[p] + '</td> \
                                                       <td class="font-weight-bold">' + v +'</td></tr>');
                    p++;
                });
            });

            $.ajax({
                type: "GET",
                url: base_url + "rdlip/admin/get_member_address/" + id,
                dataType: "json",
                crossDomain: true,
                success: function(data) {
                    $.each(data, function(key, val){
                        $.each(val, function(k , v){
                        address.push(v);
                        });

                        var filtered_address = address.filter(Boolean);
                        
                        $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">Home Address</td> \
                                                            <td class="font-weight-bold">' + filtered_address +'</td></tr>');
                        
                    });

                    var e = 0;
                
                    $.ajax({
                        type: "GET",
                        url: base_url + "rdlip/admin/get_member_employment/" + id,
                        dataType: "json",
                        crossDomain: true,
                        success: function(data) {
                            $.each(data, function(key, val){
                                $.each(val, function(k , v){

                                    v = (v == '' || v == null) ? '-' : v ;
                                    $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">' + employment[e] + '</td> \
                                                                       <td class="font-weight-bold">' + v +'</td></tr>');
                
                                    e++;
                                });
                            });

                            

                        var m = 0;

                        $.ajax({
                            type: "GET",
                            url: base_url + "rdlip/admin/get_member_membership/" + id,
                            dataType: "json",
                            crossDomain: true,
                            success: function(data) {
                                $.each(data, function(key, val){
                                    // console.log(moment(val.mem_date_elected).format("DD MMM YYYY"));    
                                    $.each(val, function(k , v){

                                        // console.log(k + ' ' + v);
                                        // v = (k == 'mem_date_elected') ? moment(v, 'DD.MM.YYYY') : v;
                                        
                                        v = (k == 'mem_date_elected') ? moment(v).format("DD MMM YYYY") : v;
                                        
                                        $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">' + membership[m] + '</td> \
                                                                        <td class="font-weight-bold">' + v +'</td></tr>');
                                       
                                        m++;
                                    });
                                });

                            var i = 0;

                            var nibra_alignment = ['Water Security', 'Food and Nutrition Security', 'Health Sufficiency', 'Clean Energy', 'Sustainabale Communities', 'Inclusive Nation Building'];
                            
                            $.ajax({
                                type: "GET",
                                url: base_url + "rdlip/admin/get_ilc_only/" + id,
                                dataType: "json",
                                crossDomain: true,
                                success: function(data) {
                                    $.each(data, function(key, val){
                                        $.each(val, function(k , v){

                                            v = (v == '' || v == null) ? '-' : v ;
                                            v = (k == 'rd_nibra_align') ? nibra_alignment[v-1] : v;
                                            v = (k == 'rd_conf_period_from') ? moment(v).format("DD MMM YYYY") : v;
                                            v = (k == 'rd_conf_period_to') ? moment(v).format("DD MMM YYYY") : v;
                                            
                                            if(k == 'rd_ft_present'){
                                                v = (v == 1) ? 'No' : 'Yes';
                                            }
                                            
                                            if(k != 'row_id' && k != 'date_created' && k != 'last_updated' && k != 'rd_status' && k!= 'rd_user_id'){
                                                $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">' + ilc[i] + '</td> \
                                                                                   <td class="font-weight-bold">' + v +'</td></tr>');
                            
                                                i++;
                                            }
                                        });
                                    });

                                    var ilc_folders = ['conforme', 'abstract', 'invitation', 'conferenceprogram', 'tcr', 'liqr', 'preiot', 'auth', 'tix', 'other_or', 'dsa'];
                                    var ilcf = 0;

                                    $.ajax({
                                        type: "GET",
                                        url: base_url + "rdlip/admin/download_ilc/" + id,
                                        dataType: "json",
                                        crossDomain: true,
                                        success: function(data) {
                                            $.each(data, function(key, val){
                                                $.each(val, function(k , v){

                                                    if(k != 'row_id' && k != 'date_created' && k != 'last_updated' && k!= 'rd_user_id'){

                                                        if(v == '-'){
                                                            var pdf = v;
                                                        }else{
                                                            var pdf = '<a href="'+ base_url + '/assets/rdlip/uploads/ilc_files/' + ilc_folders[ilcf] + '/' + v + '" target="_blank" download>' + v +'</a>';
                                                        }

                                                        $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">' + attach[ilcf] + '</td> \
                                                                                           <td class="font-weight-bold" style="word-break: break-all;">' + pdf + '</td></tr>');
                                    
                                                        ilcf++;
                                                            }
                                                        });
                                                    });
                                                }
                                            });
                                        }
                                    });
                                }
                            });   
                        }
                    });
                }
            });
        }
    });
}

function get_pub(id){

    $('#info_table tbody').empty();

    var personal = ['Title', 'Last Name', 'First Name', 'Middle Name', 'Extension', 'Sex', 'Date of Birth', 'Age'];
    var address = [];
    var employment = ['Position', 'Institution', 'Office Address'];
    var membership = ['Type of Membership', 'Division', 'Date Approval of Membership'];
    var pub = ['NIBRA Alignment', 'Title of Research Project', 'Research Funding Agency', 'Year/s of Research Involvement',
                 'First time to present the research in ISI Journals', 'Name of Publisher', 'Location', 'Publication date', 'Link to the publication (optional)'];
    var attach = ['Certification/Conforme', 'Abstract', 'Conforme signed by all the authors (optional)',
                  'Notice of acceptance of the manuscript from the Publisher', 'Copy of the publication in the journal (optional)'];
    
    var p = 0;

    $('#info_modal .modal-title').text('Publication Grant - Application details');

    $.ajax({
        type: "GET",
        url: base_url + "rdlip/admin/get_member_personal/" + id,
        dataType: "json",
        crossDomain: true,
        success: function(data) {
            $.each(data, function(key, value){
                last_name_for_export = value.pp_last_name;
                $.each(value, function(k, v){   

                    v = (v == '' || v == null) ? '-' : v ;

                    if(k == 'pp_usr_id'){
                        var today = moment(new Date()).format("YYYY");
                        var bday_format = moment(value.pp_date_of_birth).format("MM/DD/YYYY");
                        var bday = bday_format.split('/');
                        v = today - bday[2];
                    }

                    v = (k == 'pp_date_of_birth') ? moment(v).format("DD MMM YYYY") : v;

                    $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">' + personal[p] + '</td> \
                                                       <td class="font-weight-bold">' + v +'</td></tr>');
                    p++;
                });
            });

            $.ajax({
                type: "GET",
                url: base_url + "rdlip/admin/get_member_address/" + id,
                dataType: "json",
                crossDomain: true,
                success: function(data) {
                    $.each(data, function(key, val){
                        $.each(val, function(k , v){
                        address.push(v);
                        });

                        var filtered_address = address.filter(Boolean);
                        
                        $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">Home Address</td> \
                                                            <td class="font-weight-bold">' + filtered_address +'</td></tr>');
                        
                    });

                    var e = 0;
                
                    $.ajax({
                        type: "GET",
                        url: base_url + "rdlip/admin/get_member_employment/" + id,
                        dataType: "json",
                        crossDomain: true,
                        success: function(data) {
                            $.each(data, function(key, val){
                                $.each(val, function(k , v){

                                    v = (v == '' || v == null) ? '-' : v ;
                                    $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">' + employment[e] + '</td> \
                                                                       <td class="font-weight-bold">' + v +'</td></tr>');
                
                                    e++;
                                });
                            });

                            

                        var m = 0;

                        $.ajax({
                            type: "GET",
                            url: base_url + "rdlip/admin/get_member_membership/" + id,
                            dataType: "json",
                            crossDomain: true,
                            success: function(data) {
                                $.each(data, function(key, val){
                                    // console.log(moment(val.mem_date_elected).format("DD MMM YYYY"));    
                                    $.each(val, function(k , v){

                                        // console.log(k + ' ' + v);
                                        // v = (k == 'mem_date_elected') ? moment(v, 'DD.MM.YYYY') : v;
                                        v = (k == 'mem_date_elected') ? moment(v).format("DD MMM YYYY") : v;
                                        
                                        $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">' + membership[m] + '</td> \
                                                                        <td class="font-weight-bold">' + v +'</td></tr>');
                                       
                                        m++;
                                    });
                                });

                            var i = 0;

                            var nibra_alignment = ['Water Security', 'Food and Nutrition Security', 'Health Sufficiency', 'Clean Energy', 'Sustainabale Communities', 'Inclusive Nation Building'];
                        
                            $.ajax({
                                type: "GET",
                                url: base_url + "rdlip/admin/get_pub_only/" + id,
                                dataType: "json",
                                crossDomain: true,
                                success: function(data) {
                                    $.each(data, function(key, val){
                                        $.each(val, function(k , v){

                                            v = (v == '' || v == null) ? '-' : v ;
                                            v = (k == 'pub_nibra_alignment') ? nibra_alignment[v - 1] : v;
                                            // v = (k == 'pub_period_from') ? moment(v).format("DD MMM YYYY") : v;
                                            // v = (k == 'pub_period_to') ? moment(v).format("DD MMM YYYY") : v;
                                            v = (k == 'pub_date') ? moment(v).format("DD MMM YYYY") : v;
                                            
                                            if(k == 'pub_ft_publish'){
                                                v = (v == 1) ? 'No' : 'Yes';
                                            }
                                            
                                            if(k != 'row_id' && k != 'date_created' && k != 'last_updated' && k != 'pub_status' && k!= 'pub_user_id'){
                                                $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">' + pub[i] + '</td> \
                                                                                   <td class="font-weight-bold">' + v +'</td></tr>');
                            
                                                i++;
                                            }
                                        });
                                    });

                                    var pub_folders = ['certification', 'abstract', 'conforme', 'notice', 'pub'];
                                    var pubf = 0;

                                    $.ajax({
                                        type: "GET",
                                        url: base_url + "rdlip/admin/download_pub/" + id,
                                        dataType: "json",
                                        crossDomain: true,
                                        success: function(data) {
                                            $.each(data, function(key, val){
                                                $.each(val, function(k , v){

                                                    if(k != 'row_id' && k != 'date_created' && k != 'last_updated' && k!= 'att_user_id'){

                                                        if(v == '-'){
                                                            var pdf = v;
                                                        }else{
                                                            var pdf = '<a href="'+ base_url + '/assets/rdlip/uploads/pub_files/' + pub_folders[pubf] + '/' + v + '" target="_blank" download>' + v +'</a>';
                                                        }

                                                        $('#info_table tbody').append('<tr><td class="table-active text-right text-wrap w-25">' + attach[pubf] + '</td> \
                                                                                           <td class="font-weight-bold" style="word-break: break-all;">' + pdf + '</td></tr>');
                                    
                                                        pubf++;

                                                      
                                                            }
                                                        });
                                                    });
                                                }
                                            });
                                        }
                                    });
                                }
                            });   
                        }
                    });
                }
            });
        }
    });
}

function get_user_by_id(id){
    $.ajax({
        type: "GET",
        url: base_url + "rdlip/admin/get_user/" + id,
        dataType: "json",
        crossDomain: true,
        success: function(data) {
            $.each(data, function(key, val){
                $('#edit_user_form #usr_username').val(val.usr_username);
                $('#edit_user_form #usr_role').val(val.usr_role);
                $('#edit_user_form #current_password').val(val.usr_password);
                $('#edit_user_form #row_id').val(val.row_id);
            });
        }
    });
}

function remove_user(){
    var id = $('#row_id').val();

    $.ajax({
        type: "POST",
        url: base_url + "rdlip/admin/remove_user/" + id,
        cache: false,
        crossDomain: true,
        success: function(data) {
            // console.log(data);
            location.reload();
        }
    });
}

function export_ilc(){

    $.ajax({
        type: "POST",
        url: base_url + "rdlip/admin/export_ilc_log",
        cache: false,
        crossDomain: true,
        success: function(data) {
        }
    });

 
    if (!window.Blob) {
        alert('Your legacy browser does not support this action.');
        return;
    }
    
    var html, link, blob, url, css;
    
    // EU A4 use: size: 841.95pt 595.35pt;
    // US Letter use: size:11.0in 8.5in;
    
    css = (
        '<style>' +
        '@page WordSection1{size: 841.95pt 595.35pt;mso-page-orientation: landscape;}' +
        'div.WordSection1 {page: WordSection1;}' +
        'table{border-collapse:collapse;}td{border:1px gray solid;width:5em;padding:2px;}'+
        '</style>'
    );
    
    html = window.docx.innerHTML;
    blob = new Blob(['\ufeff', css + html], {
        type: 'application/msword'
    });
    url = URL.createObjectURL(blob);
    link = document.createElement('A');
    link.href = url;
    // Set default file name. 
    // Word will append file extension - do not add an extension here.
    link.download = last_name_for_export + '_International and Local Conference';   
    document.body.appendChild(link);
    if (navigator.msSaveOrOpenBlob ) navigator.msSaveOrOpenBlob( blob, last_name_for_export +'_International and Local Conference.doc'); // IE10-11
            else link.click();  // other browsers
    document.body.removeChild(link);
}

function export_pub(){

    $.ajax({
        type: "POST",
        url: base_url + "rdlip/admin/export_pub_log",
        cache: false,
        crossDomain: true,
        success: function(data) {
        }
    });
 
    if (!window.Blob) {
       alert('Your legacy browser does not support this action.');
       return;
    }
 
    var html, link, blob, url, css;
    
    // EU A4 use: size: 841.95pt 595.35pt;
    // US Letter use: size:11.0in 8.5in;
    
    css = (
      '<style>' +
      '@page WordSection1{size: 841.95pt 595.35pt;mso-page-orientation: landscape;}' +
      'div.WordSection1 {page: WordSection1;}' +
      'table{border-collapse:collapse;}td{border:1px gray solid;width:5em;padding:2px;}'+
      '</style>'
    );
    
    html = window.docx.innerHTML;
    blob = new Blob(['\ufeff', css + html], {
      type: 'application/msword'
    });
    url = URL.createObjectURL(blob);
    link = document.createElement('A');
    link.href = url;
    // Set default file name. 
    // Word will append file extension - do not add an extension here.
    link.download = last_name_for_export + '_Publication Grant';   
    document.body.appendChild(link);
    if (navigator.msSaveOrOpenBlob ) navigator.msSaveOrOpenBlob( blob, last_name_for_export +'_Publication Grant.doc'); // IE10-11
            else link.click();  // other browsers
    document.body.removeChild(link);
}


function view_csf_feedback(id){

    $.ajax({
        type: "GET",
        url: base_url + "rdlip/admin/get_csf_feedback_by_ref/" + id,
        dataType: "json",
        crossDomain: true,
        success: function(data) {
            var html;

            html = '<table class="table table-striped table-bordered"><thead><tr><th>Question</th><th>Answer</th></tr></thead><tbody>';

            $.each(data, function(key, val){
                if(val.svc_fdbk_q_id == 1){
                    var answer = val.aff_type;
                }else if(val.svc_fdbk_q_id == 2){
                    var answer = val.nrcp_svc;
                }else{
                    if(val.svc_fdbk_q_answer > 0){
                        var answer = val.svc_fdbk_rating;
                    }else{
                        var answer = val.svc_fdbk_q_answer;
                    }
                }
                
                html += '<tr><td>' + val.svc_fdbk_q + '</td><td>' + answer + '</td></tr>';
            });

            html += '<tbody></table>';

            $('#csf_modal .modal-body').empty().append(html);
        }
    });
}


function generate_csf_graph(id){

    
    id = $('#csf_questions').val();

    if(id > 0){
        $('#csf_bar_chart').remove();
        $('#csf_pie_chart').remove();

        $('.csf-bar').append('<canvas id="csf_bar_chart" height="100"></canvas>');
        $('.csf-pie').append('<canvas id="csf_pie_chart" height="100"></canvas>');
    }

    var csf_labels = [];
    var csf_values = [];
    var csf_bgcolors = ['#52BE80','#58D68D','#F4D03F','#F5B7B1','#CD6155'];
  
    //csf
    $.ajax({
      method: 'GET',
      url: base_url + "rdlip/admin/get_csf_graph/" + id,
      async: false,
      dataType: "json",
      success: function (response) {
            $.each(response, function(key, val){
            csf_values.push(val.total);
                csf_labels.push(val.label);
            });
    
            
            var bar = document.getElementById('csf_bar_chart').getContext('2d');
            var barChart = new Chart(bar, {
                type: 'horizontalBar',
                data: {
                    labels: csf_labels,
                    datasets: [{
                        data: csf_values,
                        backgroundColor: csf_bgcolors,
                        borderColor: csf_bgcolors,
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false,
                        position: 'top',
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                            },
                        }],
                    }
                }
            });
    
            var pie = document.getElementById('csf_pie_chart').getContext('2d');
            var pieChart = new Chart(pie, {
                type: 'pie',
                data: {
                    labels: csf_labels,
                    datasets: [{
                        data: csf_values,
                        backgroundColor: csf_bgcolors,
                        borderColor: csf_bgcolors,
                        borderWidth: 1
                    }]
                },
                options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'top',
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                        },
                    }],
                }
                }
            });
        }
    });
}
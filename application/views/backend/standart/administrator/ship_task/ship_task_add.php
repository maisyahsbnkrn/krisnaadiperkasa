
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
 
<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
//    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ship Task        <small><?= cclang('new', ['Ship Task']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/ship_task'); ?>">Ship Task</a></li>
        <li class="active"><?= cclang('new'); ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header ">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Ship Task</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Ship Task']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_ship_task', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_ship_task', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="form-group ">
                            <label for="company" class="col-sm-2 control-label">Company 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="company" id="company" data-placeholder="Select Company" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('company') as $row): ?>
                                        <option value="<?= $row->id_company ?>"><?= $row->name; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="ship_name" class="col-sm-2 control-label">Ship Name 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="ship_name" id="ship_name" data-placeholder="Select Ship Name" >
                                    <option value=""></option>
<!--                                    <?php foreach (db_get_all_data('ship') as $row): ?>
                                    <option value="<?= $row->id_ship ?>"><?= $row->ship_name; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="order_number" class="col-sm-2 control-label">Order Number 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="order_number" id="order_number" placeholder="Order Number" value="<?= set_value('order_number'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="schedule" class="col-sm-2 control-label">Schedule 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="schedule"  placeholder="Schedule" id="schedule">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="location" class="col-sm-2 control-label">Location 
                             <i class="required">*</i>    
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="location" id="location" placeholder="Location" value="<?= set_value('location'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                        <div class="form-group  wrapper-options-crud">
                            <label for="scope_type" class="col-sm-2 control-label">Scope Type 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <?php foreach (db_get_all_data('scope_types') as $row): ?>
                                    <div class="col-md-8  padding-left-0">
                                        <label>
                                            <input id="scope_type" type="checkbox" class="flat-red check" name="scope_type[]" value="<?= $row->name_scope_type ?>"> <?= $row->name_scope_type; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>  
                                <div class="row-fluid clear-both">
                                    <small class="info help-block">
                                    </small>
                                </div>

                            </div>
                        </div>
                        
                        
                        <div class="message" id="message_survey" hidden>
                            <div class="callout callout-info btn-flat">
                                <b># Survey</b>
                            </div>
                        </div>
                        
                        <div class="box-body " id="box-body_survey" hidden>
                        <div class="form-group ">

                            <div class="form-group ">
                                <label for="survey_type" class="col-sm-2 control-label">Survey Type 
                                </label>
                                <div class="col-sm-8">
                                    <select  class="form-control chosen chosen-select" name="survey_type[]" id="survey_type" data-placeholder="Select Survey Type" multiple >
                                        <option value=""></option>
                                        <?php foreach (db_get_all_data('survey_type') as $row): ?>
                                            <option value="<?= $row->name_survey_type ?>"><?= $row->name_survey_type; ?></option>
                                        <?php endforeach; ?>  
                                    </select>
                                    <small class="info help-block">
                                    </small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="survey_engineer_fee" class="col-sm-2 control-label">Engineer Fee 
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="survey_engineer_fee" id="survey_engineer_fee" placeholder="" value="<?= set_value('survey_engineer_fee'); ?>">
                                    <small class="info help-block">
                                    </small>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="survey_ticket_fee" class="col-sm-2 control-label">Ticket Fee 
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="survey_ticket_fee" id="survey_ticket_fee" placeholder="" value="<?= set_value('survey_ticket_fee'); ?>">
                                    <small class="info help-block">
                                    </small>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="survey_transport_fee" class="col-sm-2 control-label">Transport Fee 
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="survey_transport_fee" id="survey_transport_fee" placeholder="" value="<?= set_value('survey_transport_fee'); ?>">
                                    <small class="info help-block">
                                    </small>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="survey_speedboat_fee" class="col-sm-2 control-label">Speedboat Fee 
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="survey_speedboat_fee" id="survey_speedboat_fee" placeholder="" value="<?= set_value('survey_speedboat_fee'); ?>">
                                    <small class="info help-block">
                                    </small>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="survey_dailyallowance_fee" class="col-sm-2 control-label">Dailyallowance Fee 
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="survey_dailyallowance_fee" id="survey_dailyallowance_fee" placeholder="" value="<?= set_value('survey_dailyallowance_fee'); ?>">
                                    <small class="info help-block">
                                    </small>
                                </div>
                            </div>
                        </div>
                       </div>
                        
                        <div hidden class="message" id="message_installation" >
                            <div class="callout callout-info btn-flat">
                                <b># Installation</b>
                            </div>
                        </div>
                        
                        <div hidden class="box-body" id="box-body_installation" >
                            <div class="form-group">
                                <div class="form-group ">
                                    <label for="installation" class="col-sm-2 control-label">Installation 
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="5" name="installation" id="installation"><?= set_value('installation'); ?></textarea>
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>
        
 
<!--                                <div class="form-group ">
                                    <label for="logistic_equipment" class="col-sm-2 control-label">Logistic Equipment 
                                    </label>
                                    <div  class="col-sm-8">
                                          <?php is_allowed('ship_task_get_equipment', function(){?>
                                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="Select Logistic Equipment" href="<?=  site_url('administrator/ship_task_equipment/index'); ?>"><i class="fa fa-chevron-circle-down"></i><span>&nbsp;Select Logistic Equipment </span></a>
                                          <?php }) ?>
                                    </div>
                                    
                                </div>-->
                                 <div class="form-group ">
                                    <label for="installation_engineer_fee" class="col-sm-2 control-label">Engineer Fee 
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="installation_engineer_fee" id="installation_engineer_fee" placeholder="" value="<?= set_value('installation_engineer_fee'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="installation_ticket_fee" class="col-sm-2 control-label">Ticket Fee 
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="installation_ticket_fee" id="installation_ticket_fee" placeholder="" value="<?= set_value('installation_ticket_fee'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="installation_transport_fee" class="col-sm-2 control-label">Transport Fee 
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="installation_transport_fee" id="installation_transport_fee" placeholder="" value="<?= set_value('installation_transport_fee'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="installation_speedboat_fee" class="col-sm-2 control-label">Speedboat Fee 
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="installation_speedboat_fee" id="installation_speedboat_fee" placeholder="" value="<?= set_value('installation_speedboat_fee'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="installation_dailyallowance_fee" class="col-sm-2 control-label">Dailyallowance Fee 
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="installation_dailyallowance_fee" id="installation_dailyallowance_fee" placeholder="" value="<?= set_value('installation_dailyallowance_fee'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="message" id="message_repair" hidden>
                            <div class="callout callout-info btn-flat">
                                <b># Repair / General Checking</b>
                            </div>
                        </div>
                        
                        <div class="box-body" id="box-body_repair" hidden>
                            <div class="form-group">
                                <div class="form-group ">
                                    <label for="repair" class="col-sm-2 control-label">Repair 
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea rows="5" class="form-control" name="repair" id="repair"><?= set_value('repair'); ?></textarea>
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>

<!--                                <div class="form-group ">
                                    <label for="logistic_sparepart" class="col-sm-2 control-label">Logistic Sparepart 
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="logistic_sparepart" id="logistic_sparepart" placeholder="" value="<?= set_value('logistic_sparepart'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>-->

                                <div class="form-group ">
                                    <label for="repair_engineer_fee" class="col-sm-2 control-label">Engineer Fee 
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="repair_engineer_fee" id="repair_engineer_fee" placeholder="" value="<?= set_value('repair_engineer_fee'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="repair_ticket_fee" class="col-sm-2 control-label">Ticket Fee 
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="repair_ticket_fee" id="repair_ticket_fee" placeholder="" value="<?= set_value('repair_ticket_fee'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="repair_transport_fee" class="col-sm-2 control-label">Transport Fee 
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="repair_transport_fee" id="repair_transport_fee" placeholder="" value="<?= set_value('repair_transport_fee'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="repair_speedboat_fee" class="col-sm-2 control-label">Speedboat Fee 
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="repair_speedboat_fee" id="repair_speedboat_fee" placeholder="" value="<?= set_value('repair_speedboat_fee'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="repair_dailyallowance_fee" class="col-sm-2 control-label">Dailyallowance Fee 
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="repair_dailyallowance_fee" id="repair_dailyallowance_fee" placeholder="" value="<?= set_value('repair_dailyallowance_fee'); ?>">
                                        <small class="info help-block">
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="notes" class="col-sm-2 control-label">Notes 
                                <!-- <i class="required">*</i> -->
                            </label>
                            <div class="col-sm-8">
                                <textarea id="notes" name="notes" rows="5" class="textarea"><?= set_value('notes'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                                <label for="engineer" class="col-sm-2 control-label">Engineer 
                                <i class="required">*</i>    
                                </label>
                                <div class="col-sm-8">
                                    <select  class="form-control chosen chosen-select" name="engineer[]" id="engineer" data-placeholder="Select Engineer">
                                        <option value=""></option>
                                        <?php foreach (db_get_data_engineer() as $row): ?>
                                            <option value="<?= $row->full_name ?>"><?= $row->full_name; ?></option>
                                        <?php endforeach; ?>  
                                    </select>
                                    <small class="info help-block">
                                    </small>
                                </div>
                            </div>
                        
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                          <!--  <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button> -->
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->
<!-- Page script -->
<script>
    $(document).ready(function(){
       $('#company').change(function(){
            getShipName();
        });
        
         $('#survey_type').change(function(){
            var a = 0; 
            var arr = new Array();
            arr = $('#survey_type').val(); 

            try{
                console.log('arr ::' + arr.length);
                for(var i=0 ; i< arr.length ; i++){
                    console.log('arr values ::' + arr[i]);
                    $.ajax({
                        type: "GET",
                        url: BASE_URL + 'administrator/Ship_task/get_dataTarif',
                        dataType: "json",
                        data: {"jenis_survey" : arr[i],"company":$('#company').val()},

                        beforeSend: function(e){
                            if(e && e.overrideMimeType){}
                        },
                        success: function(response){
                            console.log("Result : " +response.list_tarif_survey);
                            a+=parseInt(response.list_tarif_survey);
                            console.log('a values ::' + a);
                            $('#survey_engineer_fee').val(a);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log("Result xhr : " +xhr.status);
                            console.log("Exceptions : " +thrownError);

                        }
                     });
                    }
            }catch(err){
                console.log('error ::' + err);
                a = '';
                console.log('a values ::' + a);
                $('#survey_engineer_fee').val(a);
            }

        });
      
       var checkboxes = new Array(); 
       checkboxes = $('input.check');
       for(var i=0 ; i< checkboxes.length ; i++){
//           console.log('check ::' + checkboxes.);
       }
       checkboxes.on('ifChecked ifUnchecked', function(event) {   
        if (event.type ==='ifChecked') {
              var chkArray = [];   
              chkArray.push($(this).val());  
              for(var i=0 ; i< chkArray.length ; i++){
                console.log('check array[] ::' + chkArray[i]);
                 if(chkArray[i]==='Survey'){
                    $('#box-body_survey').show();
                    getSurveyType(); 
                    $('#message_survey').show();
                }
                if(chkArray[i]==='Installation'){
                    $('#box-body_installation').show();
                    $('#message_installation').show();
                    getInstallationTarif();
                }   
                 if(chkArray[i]==='Repair / General Checking'){
                    $('#box-body_repair').show();
                    $('#message_repair').show();
                    getRepairTarif();
                } 
             } 
                     
        } else {
            var UnchkArray = [];  
             UnchkArray.push($(this).val());  
              for(var i=0 ; i< UnchkArray.length ; i++){
                console.log('Uncheck array[] ::' + UnchkArray[i]);
                 if(UnchkArray[i]==='Survey'){
                    $('#box-body_survey').hide();
                    $('#message_survey').hide();
                }
                if(UnchkArray[i]==='Installation'){
                    $('#box-body_installation').hide();
                    $('#message_installation').hide();
                }   
                 if(UnchkArray[i]==='Repair / General Checking'){
                    $('#box-body_repair').hide();
                    $('#message_repair').hide();
                } 
             }
        }
     });

         
       function getSurveyType(){
             $("#survey_type").empty();
             $("#survey_type").chosen('destroy');
             $("#survey_type_chosen").hide();
             $("#survey_type").chosen({});   
              $.ajax({
                 type: "GET",
                 url: BASE_URL + 'administrator/Ship_task/get_survey_type',
                 dataType: "json",
                 beforeSend: function(e){
                     if(e && e.overrideMimeType){}
                 },
                 success: function(response){
                     console.log("Result : " +response.list_survey_type);
                     $("#survey_type").chosen('destroy');
                     $("#survey_type").html(response.list_survey_type).show();
                     $("#survey_type_chosen").hide();
                     $("#survey_type").chosen({});

                 },
                 error: function (xhr, ajaxOptions, thrownError) {
                     alert(xhr.status);
                     alert(thrownError);


                 }
              });
       }     
        
       function getShipName(){
             $("#ship_name").empty();
             $("#ship_name").chosen('destroy');
             $("#ship_name_chosen").hide();
             $("#ship_name").chosen({});       

             $.ajax({
                 type: "GET",
                 url: BASE_URL + 'administrator/Ship_equipment/get_ship_name/'+$('#company').val(),
                 dataType: "json",
                 beforeSend: function(e){
                     if(e && e.overrideMimeType){}
                 },
                 success: function(response){
                     console.log("Result : " +response.list_ship_name);
                     $("#ship_name").chosen('destroy');
                     $("#ship_name").html(response.list_ship_name).show();
                     $("#ship_name_chosen").hide();
                     $("#ship_name").chosen({});

                 },
                 error: function (xhr, ajaxOptions, thrownError) {
                     alert(xhr.status);
                     alert(thrownError);


                 }
              });
        }    
      $('#btn_cancel').click(function(){
        swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/ship_task';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_ship_task = $('#form_ship_task');
        var data_post = form_ship_task.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/ship_task/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/
    
    }); /*end doc ready*/
    
    function getInstallationTarif(){
        $.ajax({
                        type: "GET",
                        url: BASE_URL + 'administrator/Ship_task/getInstallationTarif',
                        dataType: "json",
                        data: {"company":$('#company').val()},
                        beforeSend: function(e){
                            if(e && e.overrideMimeType){}
                        },
                        success: function(response){
                            console.log("Result : " +response.list_tarif_installation);
                            
                            $('#installation_engineer_fee').val(response.list_tarif_installation);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log("Result xhr : " +xhr.status);
                            console.log("Exceptions : " +thrownError);

                        }
                     });
    }
    
    function getRepairTarif(){
        $.ajax({
                        type: "GET",
                        url: BASE_URL + 'administrator/Ship_task/getRepairTarif',
                        dataType: "json",
                        data: {"company":$('#company').val()},
                        beforeSend: function(e){
                            if(e && e.overrideMimeType){}
                        },
                        success: function(response){
                            console.log("Result : " +response.list_tarif_repair);
                            
                            $('#repair_engineer_fee').val(response.list_tarif_repair);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log("Result xhr : " +xhr.status);
                            console.log("Exceptions : " +thrownError);

                        }
                     });
    }
    
</script>
 
 
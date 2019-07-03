
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
        Ship Task        <small>Edit Ship Task</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/ship_task'); ?>">Ship Task</a></li>
        <li class="active">Edit</li>
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
                            <h5 class="widget-user-desc">Edit Ship Task</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/ship_task/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_ship_task', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_ship_task', 
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
                                    <option <?=  $row->id_company ==  $ship_task->company ? 'selected' : ''; ?> value="<?= $row->id_company ?>"><?= $row->name; ?></option>
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
                                    <?php foreach (db_get_all_data('ship') as $row): ?>
                                    <option <?=  $row->id_ship ==  $ship_task->ship_name ? 'selected' : ''; ?> value="<?= $row->id_ship ?>"><?= $row->ship_name; ?></option>
                                    <?php endforeach; ?>  
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
                                <input type="text" class="form-control" name="order_number" id="order_number" placeholder="Order Number" value="<?= set_value('order_number', $ship_task->order_number); ?>">
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
                              <input type="text" class="form-control pull-right datepicker" name="schedule"  placeholder="Schedule" id="schedule" value="<?= set_value('ship_task_schedule_name', $ship_task->schedule); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="location" class="col-sm-2 control-label">Location 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="location" id="location" placeholder="Location" value="<?= set_value('location', $ship_task->location); ?>">
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
                                    <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input <?=  in_array($row->id_scope_type, explode(',', $ship_task->scope_type)) ? 'checked' : ''; ?> type="checkbox" class="flat-red" name="scope_type[]" value="<?= $row->id_scope_type ?>"> <?= $row->name_scope_type; ?>
                                    </label>
                                    </div>
                                    <?php endforeach; ?>  
                                    <div class="row-fluid clear-both">
                                    <small class="info help-block">
                                    </small>
                                    </div>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="survey_type" class="col-sm-2 control-label">Survey Type 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="survey_type[]" id="survey_type" data-placeholder="Select Survey Type" multiple >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('survey_type') as $row): ?>
                                    <option <?=  in_array($row->id_survey_type, explode(',', $ship_task->survey_type)) ? 'selected' : ''; ?> value="<?= $row->id_survey_type ?>"><?= $row->name_survey_type; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="survey_engineer_fee" class="col-sm-2 control-label">Survey Engineer Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="survey_engineer_fee" id="survey_engineer_fee" placeholder="Survey Engineer Fee" value="<?= set_value('survey_engineer_fee', $ship_task->survey_engineer_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="survey_ticket_fee" class="col-sm-2 control-label">Survey Ticket Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="survey_ticket_fee" id="survey_ticket_fee" placeholder="Survey Ticket Fee" value="<?= set_value('survey_ticket_fee', $ship_task->survey_ticket_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="survey_transport_fee" class="col-sm-2 control-label">Survey Transport Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="survey_transport_fee" id="survey_transport_fee" placeholder="Survey Transport Fee" value="<?= set_value('survey_transport_fee', $ship_task->survey_transport_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="survey_speedboat_fee" class="col-sm-2 control-label">Survey Speedboat Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="survey_speedboat_fee" id="survey_speedboat_fee" placeholder="Survey Speedboat Fee" value="<?= set_value('survey_speedboat_fee', $ship_task->survey_speedboat_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="survey_dailyallowance_fee" class="col-sm-2 control-label">Survey Dailyallowance Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="survey_dailyallowance_fee" id="survey_dailyallowance_fee" placeholder="Survey Dailyallowance Fee" value="<?= set_value('survey_dailyallowance_fee', $ship_task->survey_dailyallowance_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="installation" class="col-sm-2 control-label">Installation 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="installation" id="installation" placeholder="Installation" value="<?= set_value('installation', $ship_task->installation); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="logistic_equipment" class="col-sm-2 control-label">Logistic Equipment 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="logistic_equipment" id="logistic_equipment" placeholder="Logistic Equipment" value="<?= set_value('logistic_equipment', $ship_task->logistic_equipment); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="installation_engineer_fee" class="col-sm-2 control-label">Installation Engineer Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="installation_engineer_fee" id="installation_engineer_fee" placeholder="Installation Engineer Fee" value="<?= set_value('installation_engineer_fee', $ship_task->installation_engineer_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="installation_ticket_fee" class="col-sm-2 control-label">Installation Ticket Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="installation_ticket_fee" id="installation_ticket_fee" placeholder="Installation Ticket Fee" value="<?= set_value('installation_ticket_fee', $ship_task->installation_ticket_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="installation_transport_fee" class="col-sm-2 control-label">Installation Transport Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="installation_transport_fee" id="installation_transport_fee" placeholder="Installation Transport Fee" value="<?= set_value('installation_transport_fee', $ship_task->installation_transport_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="installation_speedboat_fee" class="col-sm-2 control-label">Installation Speedboat Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="installation_speedboat_fee" id="installation_speedboat_fee" placeholder="Installation Speedboat Fee" value="<?= set_value('installation_speedboat_fee', $ship_task->installation_speedboat_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="installation_dailyallowance_fee" class="col-sm-2 control-label">Installation Dailyallowance Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="installation_dailyallowance_fee" id="installation_dailyallowance_fee" placeholder="Installation Dailyallowance Fee" value="<?= set_value('installation_dailyallowance_fee', $ship_task->installation_dailyallowance_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="repair" class="col-sm-2 control-label">Repair 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="repair" id="repair" placeholder="Repair" value="<?= set_value('repair', $ship_task->repair); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="logistic_sparepart" class="col-sm-2 control-label">Logistic Sparepart 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="logistic_sparepart" id="logistic_sparepart" placeholder="Logistic Sparepart" value="<?= set_value('logistic_sparepart', $ship_task->logistic_sparepart); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="repair_engineer_fee" class="col-sm-2 control-label">Repair Engineer Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="repair_engineer_fee" id="repair_engineer_fee" placeholder="Repair Engineer Fee" value="<?= set_value('repair_engineer_fee', $ship_task->repair_engineer_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="repair_ticket_fee" class="col-sm-2 control-label">Repair Ticket Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="repair_ticket_fee" id="repair_ticket_fee" placeholder="Repair Ticket Fee" value="<?= set_value('repair_ticket_fee', $ship_task->repair_ticket_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="repair_transport_fee" class="col-sm-2 control-label">Repair Transport Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="repair_transport_fee" id="repair_transport_fee" placeholder="Repair Transport Fee" value="<?= set_value('repair_transport_fee', $ship_task->repair_transport_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="repair_speedboat_fee" class="col-sm-2 control-label">Repair Speedboat Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="repair_speedboat_fee" id="repair_speedboat_fee" placeholder="Repair Speedboat Fee" value="<?= set_value('repair_speedboat_fee', $ship_task->repair_speedboat_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="repair_dailyallowance_fee" class="col-sm-2 control-label">Repair Dailyallowance Fee 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="repair_dailyallowance_fee" id="repair_dailyallowance_fee" placeholder="Repair Dailyallowance Fee" value="<?= set_value('repair_dailyallowance_fee', $ship_task->repair_dailyallowance_fee); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="notes" class="col-sm-2 control-label">Notes 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="notes" name="notes" rows="5" class="textarea"><?= set_value('notes', $ship_task->notes); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group wrapper-options-crud">
                            <label for="engineer" class="col-sm-2 control-label">Engineer 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                    <?php foreach (db_get_all_data('aauth_users') as $row): ?>
                                    <div class="col-md-3 padding-left-0">
                                    <label>
                                    <input <?=  $row->id ==  $ship_task->engineer ? 'checked' : ''; ?>  type="radio" class="flat-red" name="engineer" value="<?= $row->id ?>"> <?= $row->username; ?>
                                    </label>
                                    </div>
                                    <?php endforeach; ?>  
                                </select>
                                <div class="row-fluid clear-both">
                                <small class="info help-block">
                                </small>
                                </div>
                            </div>
                        </div>
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                            <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button>
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
      
             
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
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
          url: form_ship_task.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#ship_task_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
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
</script>

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
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ship Equipment        <small><?= cclang('new', ['Ship Equipment']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/ship_equipment'); ?>">Ship Equipment</a></li>
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
                            <h3 class="widget-user-username">Ship Equipment</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Ship Equipment']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_ship_equipment', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_ship_equipment', 
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
                                    <?php foreach (db_get_all_data('ship') as $row): ?>
                                        <option value="<?= $row->id_ship ?>"><?= $row->ship_name; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="name" class="col-sm-2 control-label">Name 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="name" id="name" data-placeholder="Select Name" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('logistic_equipment') as $row): ?>
                                    <option value="<?= $row->logistic_equipment_name ?>"><?= $row->logistic_equipment_name; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="maker" class="col-sm-2 control-label">Maker 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="maker" id="maker" data-placeholder="Select Maker" >
                                    <option value=""></option>
<!--                                    <?php foreach (db_get_all_data('logistic_equipment') as $row): ?>
                                    <option value="<?= $row->logistic_maker ?>"><?= $row->logistic_maker; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="type" class="col-sm-2 control-label">Type 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="type" id="type" data-placeholder="Select Type" >
                                    <option value=""></option>
<!--                                    <?php foreach (db_get_all_data('logistic_equipment') as $row): ?>
                                    <option value="<?= $row->logistic_equipment_type ?>"><?= $row->logistic_equipment_type; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="serial_number" class="col-sm-2 control-label">Serial Number 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="serial_number" id="serial_number" placeholder="Serial Number" value="<?= set_value('serial_number'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="manufacture_date" class="col-sm-2 control-label">Manufacture Date 
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date col-sm-8">
                                    <input type="text" class="form-control pull-right datepicker" name="manufacture_date"  placeholder="Manufacture Date" id="manufacture_date">
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="beacon" class="col-sm-2 control-label">Beacon 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="beacon"  placeholder="Beacon" id="beacon">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="battery" class="col-sm-2 control-label">Battery 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="battery"  placeholder="Battery" id="battery">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="hru" class="col-sm-2 control-label">Hru 
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="hru"  placeholder="Hru" id="hru">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="magnetron" class="col-sm-2 control-label">Magnetron 
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date col-sm-8">
                                    <input type="text" class="form-control pull-right datepicker" name="magnetron"  placeholder="Magnetron" id="magnetron">
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="ups_battery" class="col-sm-2 control-label">UPS Battery 
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date col-sm-8">
                                    <input type="text" class="form-control pull-right datepicker" name="ups_battery"  placeholder="UPS Battery" id="ups_battery">
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                         <div class="form-group ">
                            <label for="emergency_battery" class="col-sm-2 control-label">Emergency Battery 
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date col-sm-8">
                                    <input type="text" class="form-control pull-right datepicker" name="emergency_battery"  placeholder="Emergency Battery" id="emergency_battery">
                                </div>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="annual_test" class="col-sm-2 control-label">Annual Test 
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date col-sm-8">
                                    <input type="text" class="form-control pull-right datepicker" name="annual_test"  placeholder="Annual Test" id="annual_test">
                                </div>
                                <small class="info help-block">
                                </small>
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
      $('#company').change(function(){
            getShipName();
        });
        
      $("#name").change(function(){
         getLogisticEquipmentMaker(); 
        });  

         $("#maker").change(function(){
           getLogisticEquipmentType(); 
        });  
        
         function getLogisticEquipmentMaker(){
          $("#maker").empty();
          $("#maker").chosen('destroy');
          $("#maker_chosen").hide();
          $("#maker").chosen({});
          
          $.ajax({
             type: "GET",
             url: BASE_URL + 'administrator/Logistic_equipment/get_logistic_maker',
             dataType: "json",  
             data:  { "logistic_equipment_name": $('#name').val() },
             beforeSend: function(e){
                 if(e && e.overrideMimeType){}
             },
             success: function(response){
                 console.log("Result : " +response.list_logistic_maker);
                 $("#maker").chosen('destroy');
                 $("#maker").html(response.list_logistic_maker).show();
                 $("#maker_chosen").hide();
                 $("#maker").chosen({});
                  
             },
             error: function (xhr, ajaxOptions, thrownError) {
                 alert(xhr.status);
                 alert(thrownError);
                  

             }
          });
      }
      
      function getLogisticEquipmentType(){
          $("#type").empty();
          $("#type").chosen('destroy');
          $("#type_chosen").hide();
          $("#type").chosen({});
          
          $.ajax({
             type: "GET",
             url: BASE_URL + 'administrator/Task_equipment/get_logistic_equipment_type',
             dataType: "json",
             data: {"logistic_equipment_name" : $('#name').val(),"logistic_equipment_maker" : $('#maker').val() },
                     
             beforeSend: function(e){
                 if(e && e.overrideMimeType){}
             },
             success: function(response){
                 console.log("Result : " +response.list_logistic_equipment_type);
                 $("#type").chosen('destroy');
                 $("#type").html(response.list_logistic_equipment_type).show();
                 $("#type_chosen").hide();
                 $("#type").chosen({});
                  
             },
             error: function (xhr, ajaxOptions, thrownError) {
                 console.log("Result xhr : " +xhr.status);
                 console.log("Exceptions : " +thrownError);

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
              window.location.href = BASE_URL + 'administrator/ship_equipment';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_ship_equipment = $('#form_ship_equipment');
        var data_post = form_ship_equipment.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/ship_equipment/add_save',
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
</script>
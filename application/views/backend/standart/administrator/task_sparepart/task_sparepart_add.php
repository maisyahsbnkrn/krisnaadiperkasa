
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
//       $('*').bind('keydown', 'Ctrl+s', function assets() {
//          $('#btn_save').trigger('click');
//           return false;
//       });
//    
//       $('*').bind('keydown', 'Ctrl+x', function assets() {
//          $('#btn_cancel').trigger('click');
//           return false;
//       });
//    
//      $('*').bind('keydown', 'Ctrl+d', function assets() {
//          $('.btn_save_back').trigger('click');
//           return false;
//       });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<!--<section class="content-header">
    <h1>
        Task Sparepart        <small><?= cclang('new', ['Task Sparepart']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/task_sparepart'); ?>">Task Sparepart</a></li>
        <li class="active"><?= cclang('new'); ?></li>
    </ol>
</section>-->
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
                            <h3 class="widget-user-username">Task Sparepart</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Task Sparepart']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_task_sparepart', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_task_sparepart', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="form-group ">
                            <label for="order_number_task" class="col-sm-2 control-label">Order Number 
                                
                            </label>
                            <div class="col-sm-8">
                                <input readonly type="text" class="form-control" name="order_number_task" id="order_number_task" placeholder="Order Number" value="<?php echo $order_number ?>">
                                <small class="info help-block">
                                
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="task_equipment_sparepart_name" class="col-sm-2 control-label">Equipment Name 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="task_equipment_sparepart_name" id="task_equipment_sparepart_name" data-placeholder="Select Equipment Name" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_logistic_equipment_sparepart_name('logistic_sparepart') as $row): ?>
                                        <option value="<?= $row->logistic_sparepart_equipment_name ?>"><?= $row->logistic_sparepart_equipment_name; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block"></small>     
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="task_equipment_sparepart_maker" class="col-sm-2 control-label">Equipment Maker 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                 <select  class="form-control chosen chosen-select-deselect" name="task_equipment_sparepart_maker" id="task_equipment_sparepart_maker" data-placeholder="Select Equipment Maker" >
                                    <option value=""></option>
                                   
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="task_equipment_sparepart_type" class="col-sm-2 control-label">Equipment Type 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <!--<input type="text" class="form-control" name="task_equipment_sparepart_type" id="task_equipment_sparepart_type" placeholder="Equipment Type" value="<?= set_value('task_equipment_sparepart_type'); ?>">-->
                                 <select  class="form-control chosen chosen-select-deselect" name="task_equipment_sparepart_type" id="task_equipment_sparepart_type" data-placeholder="Select Equipment Type" >
                                    <option value=""></option>
                                   
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="task_sparepart_name" class="col-sm-2 control-label">Sparepart Name 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <!--<input type="text" class="form-control" name="task_sparepart_name" id="task_sparepart_name" placeholder="Sparepart Name" value="<?= set_value('task_sparepart_name'); ?>">-->
                                 <select  class="form-control chosen chosen-select-deselect" name="task_sparepart_name" id="task_sparepart_name" data-placeholder="Select Sparepart Name" >
                                    <option value=""></option>
                                   
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="task_sparepart_type" class="col-sm-2 control-label">Sparepart Type 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <!--<input type="text" class="form-control" name="task_sparepart_type" id="task_sparepart_type" placeholder="Sparepart Type" value="<?= set_value('task_sparepart_type'); ?>">-->
                                 <select  class="form-control chosen chosen-select-deselect" name="task_sparepart_type" id="task_sparepart_type" data-placeholder="Select Sparepart Type" >
                                    <option value=""></option>
                                   
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                         <div class="form-group ">
                            <label class="col-sm-2 control-label">Stock </label>
                              
                            <div class="col-sm-8">
                                <input value="0" readonly type="number" class="form-control" name="task_sparepart_stock" id="task_sparepart_stock">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="task_sparepart_quantity" class="col-sm-2 control-label">Quantity 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="task_sparepart_quantity" id="task_sparepart_quantity" placeholder="Quantity" value="<?= set_value('task_sparepart_quantity'); ?>">
                                <small class="info help-block">
                                     <b>Input Quantity</b> is not greater than Quantity In Stock</small>
                                </small>
                            </div>
                        </div>
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                           <button class="btn btn-success btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button>
<!--                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>-->
                            <a class="btn btn-warning btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> &nbsp;&nbsp;Go Back
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
       $("#task_equipment_sparepart_name").change(function(){
         getLogisticEquipmentMaker(); 
        });  
      
        $("#task_equipment_sparepart_maker").change(function(){
         getLogisticEquipmentType(); 
        });  
      
        $("#task_equipment_sparepart_type").change(function(){
            getLogisticSparepartName(); 
        });
        
         $("#task_sparepart_name").change(function(){
            getLogisticSparepartType(); 
        });
        
         $("#task_sparepart_type").change(function(){
            getLogisticSparepartStock(); 
        });
        
      function getLogisticSparepartStock(){
         
          $.ajax({
             type: "GET",
             url: BASE_URL + 'administrator/Task_sparepart/get_logistic_sparepart_stock',
             dataType: "json",
             data: {"logistic_equipment_name" : $('#task_equipment_sparepart_name').val(),"logistic_equipment_maker" : $('#task_equipment_sparepart_maker').val(),"logistic_equipment_type" : $('#task_equipment_sparepart_type').val(),"task_sparepart_name" : $('#task_sparepart_name').val(),"task_sparepart_type" : $('#task_sparepart_type').val() },
                     
             beforeSend: function(e){
                 if(e && e.overrideMimeType){}
             },
             success: function(response){
                 console.log("Result : " +response.list_logistic_sparepart_stock);
                 $("#task_sparepart_stock").val(response.list_logistic_sparepart_stock);
             },
             error: function (xhr, ajaxOptions, thrownError) {
                 console.log("Result xhr : " +xhr.status);
                 console.log("Exceptions : " +thrownError);

             }
          });
      }
      
      
      function getLogisticEquipmentMaker(){
          $("#task_equipment_sparepart_maker").empty();
          $("#task_equipment_sparepart_maker").chosen('destroy');
          $("#task_equipment_sparepart_maker_chosen").hide();
          $("#task_equipment_sparepart_maker").chosen({});
          
          $.ajax({
             type: "GET",
             url: BASE_URL + 'administrator/Logistic_equipment/get_logistic_maker',
             dataType: "json",  
             data:  { "logistic_equipment_name": $('#task_equipment_sparepart_name').val() },
             beforeSend: function(e){
                 if(e && e.overrideMimeType){}
             },
             success: function(response){
                 console.log("Result : " +response.list_logistic_maker);
                 $("#task_equipment_sparepart_maker").chosen('destroy');
                 $("#task_equipment_sparepart_maker").html(response.list_logistic_maker).show();
                 $("#task_equipment_sparepart_maker_chosen").hide();
                 $("#task_equipment_sparepart_maker").chosen({});
                  
             },
             error: function (xhr, ajaxOptions, thrownError) {
                 alert(xhr.status);
                 alert(thrownError);
                  

             }
          });
      }
      
      function getLogisticEquipmentType(){
          $("#task_equipment_sparepart_type").empty();
          $("#task_equipment_sparepart_type").chosen('destroy');
          $("#task_equipment_sparepart_type_chosen").hide();
          $("#task_equipment_sparepart_type").chosen({});
          
          $.ajax({
             type: "GET",
             url: BASE_URL + 'administrator/Task_sparepart/get_logistic_equipment_type',
             dataType: "json",
             data: {"logistic_equipment_name" : $('#task_equipment_sparepart_name').val(),"logistic_equipment_maker" : $('#task_equipment_sparepart_maker').val() },
                     
             beforeSend: function(e){
                 if(e && e.overrideMimeType){}
             },
             success: function(response){
                 console.log("Result : " +response.list_logistic_equipment_type);
                 $("#task_equipment_sparepart_type").chosen('destroy');
                 $("#task_equipment_sparepart_type").html(response.list_logistic_equipment_type).show();
                 $("#task_equipment_sparepart_type_chosen").hide();
                 $("#task_equipment_sparepart_type").chosen({});
                  
             },
             error: function (xhr, ajaxOptions, thrownError) {
                 console.log("Result xhr : " +xhr.status);
                 console.log("Exceptions : " +thrownError);

             }
          });
      }
      
      function getLogisticSparepartName(){
          $("#task_sparepart_name").empty();
          $("#task_sparepart_name").chosen('destroy');
          $("#task_sparepart_name_chosen").hide();
          $("#task_sparepart_name").chosen({});
          
          $.ajax({
             type: "GET",
             url: BASE_URL + 'administrator/Task_sparepart/get_logistic_sparepart_name',
             dataType: "json",
             data: {"logistic_equipment_name" : $('#task_equipment_sparepart_name').val(),"logistic_equipment_maker" : $('#task_equipment_sparepart_maker').val(),"logistic_equipment_type" : $('#task_equipment_sparepart_type').val() },
                     
             beforeSend: function(e){
                 if(e && e.overrideMimeType){}
             },
             success: function(response){
                 console.log("Result : " +response.list_logistic_sparepart_name);
                 $("#task_sparepart_name").chosen('destroy');
                 $("#task_sparepart_name").html(response.list_logistic_sparepart_name).show();
                 $("#task_sparepart_name_chosen").hide();
                 $("#task_sparepart_name").chosen({});
                  
             },
             error: function (xhr, ajaxOptions, thrownError) {
                 console.log("Result xhr : " +xhr.status);
                 console.log("Exceptions : " +thrownError);

             }
          });
      }
      
      function getLogisticSparepartType(){
          $("#task_sparepart_type").empty();
          $("#task_sparepart_type").chosen('destroy');
          $("#task_sparepart_type_chosen").hide();
          $("#task_sparepart_type").chosen({});
          
          $.ajax({
             type: "GET",
             url: BASE_URL + 'administrator/Task_sparepart/get_logistic_sparepart_type',
             dataType: "json",
             data: {"logistic_equipment_name" : $('#task_equipment_sparepart_name').val(),"logistic_equipment_maker" : $('#task_equipment_sparepart_maker').val(),"logistic_equipment_type" : $('#task_equipment_sparepart_type').val(),"task_sparepart_name" : $('#task_sparepart_name').val() },
                     
             beforeSend: function(e){
                 if(e && e.overrideMimeType){}
             },
             success: function(response){
                 console.log("Result : " +response.list_logistic_sparepart_type);
                 $("#task_sparepart_type").chosen('destroy');
                 $("#task_sparepart_type").html(response.list_logistic_sparepart_type).show();
                 $("#task_sparepart_type_chosen").hide();
                 $("#task_sparepart_type").chosen({});
                  
             },
             error: function (xhr, ajaxOptions, thrownError) {
                 console.log("Result xhr : " +xhr.status);
                 console.log("Exceptions : " +thrownError);

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
    
     function do_clear(){
        $('#task_sparepart_stock').val('');
        $('#task_sparepart_quantity').val('');
      }    
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_task_sparepart = $('#form_task_sparepart');
        var data_post = form_task_sparepart.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/task_sparepart/add_save',
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
//            resetForm();
            do_clear();
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
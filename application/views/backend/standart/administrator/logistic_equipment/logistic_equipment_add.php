
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
        Logistic Equipment        <small><?= cclang('new', ['Logistic Equipment']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/logistic_equipment'); ?>">Logistic Equipment</a></li>
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
                            <h3 class="widget-user-username">Logistic Equipment</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Logistic Equipment']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_logistic_equipment', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_logistic_equipment', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="form-group ">
                            <label for="logistic_equipment_name" class="col-sm-2 control-label">Name 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="logistic_equipment_name" id="logistic_equipment_name" data-placeholder="Select Logistic Equipment Name" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_logistic_equipment_type_name('logistic_equipment_type') as $row): ?>
                                        <option value="<?= $row->logistic_equipment_type_name ?>"><?= $row->logistic_equipment_type_name; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                        <div class="form-group ">
                            <label for="logistic_maker" class="col-sm-2 control-label">Maker 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="logistic_maker" id="logistic_maker" data-placeholder="Select Logistic Maker" >
                                    <option value=""></option>
<!--                                    <?php foreach (db_get_all_data('logistic_equipment_type') as $row): ?>
                                    <option value="<?= $row->id_logistic_equipment_type ?>"><?= $row->logistic_equipment_type_maker; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                        <div class="form-group ">
                            <label for="logistic_equipment_type" class="col-sm-2 control-label">Type 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="logistic_equipment_type" id="logistic_equipment_type" data-placeholder="Select Logistic Equipment Type" >
                                    <option value=""></option>
<!--                                    <?php foreach (db_get_all_data('logistic_equipment_type') as $row): ?>
                                    <option value="<?= $row->id_logistic_equipment_type ?>"><?= $row->logistic_equipment_type_types; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                        <div class="form-group ">
                            <label for="logistic_serial_number" class="col-sm-2 control-label">Price
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="<?= set_value('price'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="price" class="col-sm-2 control-label">Unit 
                            </label>
                            <div class="col-sm-8">
                                 <select  class="form-control chosen chosen-select-deselect" name="unit" id="unit" data-placeholder="Select Unit" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('unit') as $row): ?>
                                    <option value="<?= $row->name_unit ?>"><?= $row->name_unit; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="quantity" class="col-sm-2 control-label">Quantity 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity" value="<?= set_value('quantity'); ?>">
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
        
      $("#logistic_equipment_name").change(function(){
         getLogisticEquipmentMaker(); 
      });  
      
       $("#logistic_maker").change(function(){
         getLogisticEquipmentType(); 
      });  
      
      function getLogisticEquipmentMaker(){
          $("#logistic_maker").empty();
          $("#logistic_maker").chosen('destroy');
          $("#logistic_maker_chosen").hide();
          $("#logistic_maker").chosen({});

          // var p_data = $('#logistic_equipment_name').val();
          var data_post = $('#logistic_equipment_name').val();
          
          $.ajax({
             type: "GET",
             url: BASE_URL + 'administrator/Logistic_equipment/get_logistic_maker',
             dataType: "json",  
             data:  { "logistic_equipment_name": $('#logistic_equipment_name').val() },
             beforeSend: function(e){
                 if(e && e.overrideMimeType){}
             },
             success: function(response){
                 console.log("Result : " +response.list_logistic_maker);
                 $("#logistic_maker").chosen('destroy');
                 $("#logistic_maker").html(response.list_logistic_maker).show();
                 $("#logistic_maker_chosen").hide();
                 $("#logistic_maker").chosen({});
                  
             },
             error: function (xhr, ajaxOptions, thrownError) {
                 alert(xhr.status);
                 alert(thrownError);
                  

             }
          });
      }
      
      function getLogisticEquipmentType(){
          $("#logistic_equipment_type").empty();
          $("#logistic_equipment_type").chosen('destroy');
          $("#logistic_equipment_type_chosen").hide();
          $("#logistic_equipment_type").chosen({});
          
          $.ajax({
             type: "GET",
             url: BASE_URL + 'administrator/Logistic_equipment/get_logistic_equipment_type',
             dataType: "json",
             data: {"logistic_equipment_name" : $('#logistic_equipment_name').val(),"logistic_equipment_maker" : $('#logistic_maker').val() },
                     
             beforeSend: function(e){
                 if(e && e.overrideMimeType){}
             },
             success: function(response){
                 console.log("Result : " +response.list_logistic_equipment_type);
                 $("#logistic_equipment_type").chosen('destroy');
                 $("#logistic_equipment_type").html(response.list_logistic_equipment_type).show();
                 $("#logistic_equipment_type_chosen").hide();
                 $("#logistic_equipment_type").chosen({});
                  
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
              window.location.href = BASE_URL + 'administrator/logistic_equipment';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_logistic_equipment = $('#form_logistic_equipment');
        var data_post = form_logistic_equipment.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/logistic_equipment/add_save',
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

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
        Task Sparepart        <small>Edit Task Sparepart</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/task_sparepart'); ?>">Task Sparepart</a></li>
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
                            <h3 class="widget-user-username">Task Sparepart</h3>
                            <h5 class="widget-user-desc">Edit Task Sparepart</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/task_sparepart/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_task_sparepart', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_task_sparepart', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="order_number_task" class="col-sm-2 control-label">Order Number 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="order_number_task" id="order_number_task" placeholder="Order Number" value="<?= set_value('order_number_task', $task_sparepart->order_number_task); ?>">
                                <small class="info help-block">
                                <b>Input Order Number Task</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="task_equipment_sparepart_name" class="col-sm-2 control-label">Equipment Name 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="task_equipment_sparepart_name" id="task_equipment_sparepart_name" placeholder="Equipment Name" value="<?= set_value('task_equipment_sparepart_name', $task_sparepart->task_equipment_sparepart_name); ?>">
                                <small class="info help-block">
                                <b>Input Task Equipment Sparepart Name</b> Max Length : 250.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="task_equipment_sparepart_maker" class="col-sm-2 control-label">Equipment Maker 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="task_equipment_sparepart_maker" id="task_equipment_sparepart_maker" placeholder="Equipment Maker" value="<?= set_value('task_equipment_sparepart_maker', $task_sparepart->task_equipment_sparepart_maker); ?>">
                                <small class="info help-block">
                                <b>Input Task Equipment Sparepart Maker</b> Max Length : 250.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="task_equipment_sparepart_type" class="col-sm-2 control-label">Equipment Type 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="task_equipment_sparepart_type" id="task_equipment_sparepart_type" placeholder="Equipment Type" value="<?= set_value('task_equipment_sparepart_type', $task_sparepart->task_equipment_sparepart_type); ?>">
                                <small class="info help-block">
                                <b>Input Task Equipment Sparepart Type</b> Max Length : 250.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="task_sparepart_name" class="col-sm-2 control-label">Sparepart Name 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="task_sparepart_name" id="task_sparepart_name" placeholder="Sparepart Name" value="<?= set_value('task_sparepart_name', $task_sparepart->task_sparepart_name); ?>">
                                <small class="info help-block">
                                <b>Input Task Sparepart Name</b> Max Length : 250.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="task_sparepart_type" class="col-sm-2 control-label">Sparepart Type 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="task_sparepart_type" id="task_sparepart_type" placeholder="Sparepart Type" value="<?= set_value('task_sparepart_type', $task_sparepart->task_sparepart_type); ?>">
                                <small class="info help-block">
                                <b>Input Task Sparepart Type</b> Max Length : 250.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="task_sparepart_quantity" class="col-sm-2 control-label">Quantity 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="task_sparepart_quantity" id="task_sparepart_quantity" placeholder="Quantity" value="<?= set_value('task_sparepart_quantity', $task_sparepart->task_sparepart_quantity); ?>">
                                <small class="info help-block">
                                <b>Input Task Sparepart Quantity</b> Max Length : 11.</small>
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
              window.location.href = BASE_URL + 'administrator/task_sparepart';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_task_sparepart = $('#form_task_sparepart');
        var data_post = form_task_sparepart.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_task_sparepart.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#task_sparepart_image_galery').find('li').attr('qq-file-id');
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
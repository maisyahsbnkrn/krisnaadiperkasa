
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
        Logistic Equipment        <small>Edit Logistic Equipment</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/logistic_equipment'); ?>">Logistic Equipment</a></li>
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
                            <h3 class="widget-user-username">Logistic Equipment</h3>
                            <h5 class="widget-user-desc">Edit Logistic Equipment</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/logistic_equipment/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_logistic_equipment', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_logistic_equipment', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="logistic_equipment_name" class="col-sm-2 control-label">Name 
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="logistic_equipment_name" id="logistic_equipment_name" data-placeholder="Select Logistic Equipment Name" >
                                    <option value="<?= $logistic_equipment->logistic_equipment_name ?>"><?= $logistic_equipment->logistic_equipment_name; ?></option>
<!--                                    <?php foreach (db_get_all_data('logistic_equipment_type') as $row): ?>
                                    <option <?=  $row->logistic_equipment_type_name ==  $logistic_equipment->logistic_equipment_name ? 'selected' : ''; ?> value="<?= $row->logistic_equipment_type_name ?>"><?= $row->logistic_equipment_type_name; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="logistic_maker" class="col-sm-2 control-label">Maker 
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="logistic_maker" id="logistic_maker" data-placeholder="Select Logistic Maker" >
                                    <option value="<?= $logistic_equipment->logistic_maker ?>"><?= $logistic_equipment->logistic_maker; ?></option>
<!--                                    <?php foreach (db_get_all_data('logistic_equipment_type') as $row): ?>
                                    <option <?=  $row->logistic_equipment_type_maker ==  $logistic_equipment->logistic_maker ? 'selected' : ''; ?> value="<?= $row->logistic_equipment_type_maker ?>"><?= $row->logistic_equipment_type_maker; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="logistic_equipment_type" class="col-sm-2 control-label">Type 
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control chosen chosen-select-deselect" name="logistic_equipment_type" id="logistic_equipment_type" data-placeholder="Select Logistic Equipment Type" >
                                    <option value="<?= $logistic_equipment->logistic_equipment_type ?>"><?= $logistic_equipment->logistic_equipment_type; ?></option>
<!--                                    <?php foreach (db_get_all_data('logistic_equipment_type') as $row): ?>
                                    <option <?=  $row->logistic_equipment_type_types ==  $logistic_equipment->logistic_equipment_type ? 'selected' : ''; ?> value="<?= $row->logistic_equipment_type_types ?>"><?= $row->logistic_equipment_type_types; ?></option>
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
                                <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="<?= set_value('price', $logistic_equipment->price); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                        <div class="form-group ">
                            <label for="price" class="col-sm-2 control-label">Unit 
                            </label>
                            <div class="col-sm-8">
                                 <select class="form-control chosen chosen-select-deselect" name="unit" id="unit" data-placeholder="Select Unit" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('unit') as $row): ?>
                                    <option <?=  $row->name_unit ==  $unit->name_unit ? 'selected' : ''; ?> value="<?= $row->name_unit ?>"><?= $row->name_unit; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="quantity" class="col-sm-2 control-label">Quantity 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity" value="<?= set_value('quantity', $logistic_equipment->quantity); ?>">
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
          url: form_logistic_equipment.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#logistic_equipment_image_galery').find('li').attr('qq-file-id');
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
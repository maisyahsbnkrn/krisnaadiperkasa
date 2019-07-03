
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
        Logistic Sparepart        <small>Edit Logistic Sparepart</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/logistic_sparepart'); ?>">Logistic Sparepart</a></li>
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
                            <h3 class="widget-user-username">Logistic Sparepart</h3>
                            <h5 class="widget-user-desc">Edit Logistic Sparepart</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/logistic_sparepart/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_logistic_sparepart', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_logistic_sparepart', 
                            'method'  => 'POST'
                            ]); ?>
                         
                        <div class="form-group ">
                            <label for="logistic_sparepart_equipment_name" class="col-sm-2 control-label">Equipment Name 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="logistic_sparepart_equipment_name" id="logistic_sparepart_equipment_name" data-placeholder="Select Equipment Name" >
                                    <option value="<?= $logistic_sparepart->logistic_sparepart_equipment_name ?>"><?= $logistic_sparepart->logistic_sparepart_equipment_name; ?></option>
                                    <!--                                    <?php foreach (db_get_all_data('logistic_equipment') as $row): ?>
                                                                            <option <?= $row->id_logistic_equipment == $logistic_sparepart->logistic_sparepart_equipment_name ? 'selected' : ''; ?> value="<?= $row->id_logistic_equipment ?>"><?= $row->logistic_equipment_name; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                        <div class="form-group ">
                            <label for="logistic_sparepart_equipment_maker" class="col-sm-2 control-label">Equipment Maker 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="logistic_sparepart_equipment_maker" id="logistic_sparepart_equipment_maker" data-placeholder="Select Equipment Maker" >
                                    <option value="<?= $logistic_sparepart->logistic_sparepart_equipment_maker ?>"><?= $logistic_sparepart->logistic_sparepart_equipment_maker; ?></option>
<!--                                    <?php foreach (db_get_all_data('logistic_equipment') as $row): ?>
                                        <option <?= $row->id_logistic_equipment == $logistic_sparepart->logistic_sparepart_equipment_maker ? 'selected' : ''; ?> value="<?= $row->id_logistic_equipment ?>"><?= $row->logistic_maker; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                        <div class="form-group ">
                            <label for="logistic_sparepart_equipment_type" class="col-sm-2 control-label">Equipment Type 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="logistic_sparepart_equipment_type" id="logistic_sparepart_equipment_type" data-placeholder="Select Equipment Type" >
                                    <option value="<?= $logistic_sparepart->logistic_sparepart_equipment_type ?>"><?= $logistic_sparepart->logistic_sparepart_equipment_type; ?></option>
<!--                                    <?php foreach (db_get_all_data('logistic_equipment') as $row): ?>
                                        <option <?= $row->id_logistic_equipment == $logistic_sparepart->logistic_sparepart_equipment_type ? 'selected' : ''; ?> value="<?= $row->id_logistic_equipment ?>"><?= $row->logistic_equipment_type; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                        <div class="form-group ">
                            <label for="logistic_sparepart_name" class="col-sm-2 control-label">Name 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="logistic_sparepart_name" id="logistic_sparepart_name" data-placeholder="Select Sparepart Name" >
                                        <option value="<?= $logistic_sparepart->logistic_sparepart_name ?>"><?= $logistic_sparepart->logistic_sparepart_name; ?></option>
<!--                                    <?php foreach (db_get_all_data('logistic_sparepart_type') as $row): ?>
                                        <option <?= $row->id_logistic_sparepart_type == $logistic_sparepart->logistic_sparepart_name ? 'selected' : ''; ?> value="<?= $row->id_logistic_sparepart_type ?>"><?= $row->logistic_sparepart_type_name; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                        <div class="form-group ">
                            <label for="logistic_sparepart_type" class="col-sm-2 control-label">Type 
                                <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="logistic_sparepart_type" id="logistic_sparepart_type" data-placeholder="Select Logistic Sparepart Type" >
                                    <option value="<?= $logistic_sparepart->logistic_sparepart_type ?>"><?= $logistic_sparepart->logistic_sparepart_type; ?></option>

<!--                                    <?php foreach (db_get_all_data('logistic_sparepart_type') as $row): ?>
                                        <option <?= $row->id_logistic_sparepart_type == $logistic_sparepart->logistic_sparepart_type ? 'selected' : ''; ?> value="<?= $row->id_logistic_sparepart_type ?>"><?= $row->logistic_sparepart_type_types; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                               <!--   
                                                <div class="form-group ">
                            <label for="logistic_sparepart_part_number" class="col-sm-2 control-label">Part Number 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="logistic_sparepart_part_number" id="logistic_sparepart_part_number" placeholder="Part Number" value="<?= set_value('logistic_sparepart_part_number', $logistic_sparepart->logistic_sparepart_part_number); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div> -->
                                                 
                                                <div class="form-group ">
                            <label for="logistic_sparepart_serial_number" class="col-sm-2 control-label">Price
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="<?= set_value('price', $logistic_sparepart->price); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="unit" class="col-sm-2 control-label">Unit 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="unit" id="unit" data-placeholder="Select Unit" >
                                     <option value="<?= $logistic_sparepart->unit ?>"><?= $logistic_sparepart->unit; ?></option>
<!--                                    <?php foreach (db_get_all_data('unit') as $row): ?>
                                    <option <?=  $row->id_unit ==  $logistic_sparepart->unit ? 'selected' : ''; ?> value="<?= $row->id_unit ?>"><?= $row->name_unit; ?></option>
                                    <?php endforeach; ?>  -->
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="quantity" class="col-sm-2 control-label">Quantity 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity" value="<?= set_value('quantity', $logistic_sparepart->quantity); ?>">
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
              window.location.href = BASE_URL + 'administrator/logistic_sparepart';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_logistic_sparepart = $('#form_logistic_sparepart');
        var data_post = form_logistic_sparepart.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_logistic_sparepart.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#logistic_sparepart_image_galery').find('li').attr('qq-file-id');
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
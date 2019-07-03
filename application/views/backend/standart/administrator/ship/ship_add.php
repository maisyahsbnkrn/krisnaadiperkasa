
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
        Ship        <small><?= cclang('new', ['Ship']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/ship'); ?>">Ship</a></li>
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
                            <h3 class="widget-user-username">Ship</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Ship']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_ship', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_ship', 
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
                            <label for="pic" class="col-sm-2 control-label">Pic 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pic" id="pic" placeholder="Pic" value="<?= set_value('pic'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
						
						<div class="form-group ">
                            <label for="pic_email" class="col-sm-2 control-label">Pic Email
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pic_email" id="pic_email" placeholder="Pic Email" value="<?= set_value('pic_email'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="contact_number" class="col-sm-2 control-label">Contact Number 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" value="<?= set_value('contact_number'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="ship_name" class="col-sm-2 control-label">Ship Name 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ship_name" id="ship_name" placeholder="Ship Name" value="<?= set_value('ship_name'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="ship_type" class="col-sm-2 control-label">Ship Type 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="ship_type" id="ship_type" data-placeholder="Select Ship Type" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('ship_type') as $row): ?>
                                    <option value="<?= $row->id_ship_type ?>"><?= $row->ship_type_name; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Ship Type</b> Max Length : 255.</small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="management_company" class="col-sm-2 control-label">Management Company 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="management_company" id="management_company" placeholder="Management Company" value="<?= set_value('management_company'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="groos_ton" class="col-sm-2 control-label">Groos Ton 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="groos_ton" id="groos_ton" placeholder="Groos Ton" value="<?= set_value('groos_ton'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="class" class="col-sm-2 control-label">Class 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="class" id="class" placeholder="Class" value="<?= set_value('class'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="flag" class="col-sm-2 control-label">Flag 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="flag" id="flag" placeholder="Flag" value="<?= set_value('flag'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="imo" class="col-sm-2 control-label">Imo 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="imo" id="imo" placeholder="Imo" value="<?= set_value('imo'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="mmsi" class="col-sm-2 control-label">Mmsi 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="mmsi" id="mmsi" placeholder="Mmsi" value="<?= set_value('mmsi'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="annual_survey" class="col-sm-2 control-label">Annual Survey
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date col-sm-8">
                                    <input type="text" class="form-control pull-right datepicker" name="annual_survey"  placeholder="Annual Survey Date" id="annual_survey">
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
              window.location.href = BASE_URL + 'administrator/ship';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_ship = $('#form_ship');
        var data_post = form_ship.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/ship/add_save',
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
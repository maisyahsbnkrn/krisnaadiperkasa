
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Ship_equipment/add';
       return false;
   });

   $('*').bind('keydown', 'Ctrl+f', function assets() {
       $('#sbtn').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
       $('#reset').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+b', function assets() {

       $('#reset').trigger('click');
       return false;
   });
}

//jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Ship Equipment<small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Ship Equipment</li>
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
<!--                     <div class="row pull-right">
                        <?php is_allowed('ship_equipment_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['Ship Equipment']); ?>  (Ctrl+a)" href="<?=  site_url('administrator/ship_equipment/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', ['Ship Equipment']); ?></a>
                        <?php }) ?>
                   
                     </div>-->
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Ship Equipment</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', ['Ship Equipment']); ?>  <i class="label bg-yellow"><?= $ship_equipment_counts; ?>  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_ship_equipment" id="form_ship_equipment" action="<?= base_url('administrator/ship_equipment/index'); ?>">
                      
                      <hr>
                      <div class="row"> 
                          <div class="col-md-12">
                                  <!--<label for="company" class="col-sm-1 control-label">Company </label>-->
                                  <div class="col-sm-3 ">
                                      <select  class="form-control chosen chosen-select-deselect" name="company" id="company" data-placeholder="Select Company" >
                                          <option value=""></option>
                                          <?php foreach (db_get_all_data('company') as $row): ?>
                                              <option value="<?= $row->id_company ?>"><?= $row->name; ?></option>
                                          <?php endforeach; ?>  
                                      </select>
                                      <small class="info help-block"></small>
                                      
                                  </div>
                              
                                  <!--<label for="ship_name" class="">Ship Name </label>-->
                                  <div class="col-sm-3">
                                      <select  class="form-control chosen chosen-select-deselect" name="ship_name" id="ship_name" data-placeholder="Select Ship Name" >
                                          <option value=""></option>
                                          <?php foreach (db_get_all_data('ship') as $row): ?>
                                              <option value="<?= $row->id_ship ?>"><?= $row->ship_name; ?></option>
                                          <?php endforeach; ?>  
                                      </select>
                                      <small class="info help-block"> </small>
                                     
                                  </div>
                                   <!--<div class="message"></div>-->
                                   <div class="row-fluid col-sm-3">
                                       <button class="btn btn-warning" id="btn_filter" title="<?= cclang('filter_search'); ?>">
                                          Filter
                                      </button>
                                      <a class="btn btn-danger " name="reset" id="reset" value="Apply" href="<?= base_url('administrator/ship_equipment'); ?>" title="<?= cclang('reset_filter'); ?>">
                                         Reset</i>
                                      </a> 
                                   </div>
                                    <div class=" col-sm-3 pull-right">
                                    <?php is_allowed('ship_equipment_add', function(){?>
                                    <a class="btn btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['Ship Equipment']); ?>  (Ctrl+a)" href="<?=  site_url('administrator/ship_equipment/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', ['Ship Equipment']); ?></a>
                                    <?php }) ?>

                                 </div>
<!--                                  <div class="col-sm-1">
                                      <button class="btn btn-warning" id="btn_filter" title="<?= cclang('filter_search'); ?>">
                                          Filter
                                      </button>
                                  </div>
                                  
                                  <div class="col-sm-1">
                                      <a class="btn btn-danger " name="reset" id="reset" value="Apply" href="<?= base_url('administrator/ship_equipment'); ?>" title="<?= cclang('reset_filter'); ?>">
                                         Reset</i>
                                      </a>
                                  </div>-->
 
                          </div>
                      </div>        
                  <!--<hr>-->    
                  <span></span>
                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="warning">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
<!--                           <th>ID</th>
                           <th>Company</th>
                           <th>Ship Name</th>-->
                           <th>Name</th>
                           <th>Maker</th>
                           <th>Type</th>
                           <th>Serial Number</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_ship_equipment">
                     <?php foreach($ship_equipments as $ship_equipment): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $ship_equipment->name; ?>">
                           </td>
<!--                           <td><?= _ent($ship_equipment->id_equipment); ?></td>
                           <td><?= _ent($ship_equipment->company); ?></td>
                             
                           <td><?= _ent($ship_equipment->ship_name); ?></td>-->
                           
                           <td><?= _ent($ship_equipment->name); ?></td>
                             
                           <td><?= _ent($ship_equipment->maker); ?></td>
                             
                           <td><?= _ent($ship_equipment->type); ?></td>
                           
                           <td><?= _ent($ship_equipment->serial_number); ?></td>
                             
                           <td width="200">
                              <?php is_allowed('ship_equipment_view', function() use ($ship_equipment){?>
                              <a href="<?= site_url('administrator/ship_equipment/view/' . $ship_equipment->id_equipment); ?>" class="label-default"><i class="fa fa-newspaper-o"></i> <?= cclang('view_button'); ?>
                              <?php }) ?>
                              <?php is_allowed('ship_equipment_update', function() use ($ship_equipment){?>
                              <a href="<?= site_url('administrator/ship_equipment/edit/' . $ship_equipment->id_equipment); ?>" class="label-default"><i class="fa fa-edit "></i> <?= cclang('update_button'); ?></a>
                              <?php }) ?>
                              <?php is_allowed('ship_equipment_delete', function() use ($ship_equipment){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/ship_equipment/delete/' . $ship_equipment->id_equipment); ?>" class="label-default remove-data"><i class="fa fa-close"></i> <?= cclang('remove_button'); ?></a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($ship_equipment_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Ship Equipment data is not available
                           </td>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
                
               <!-- /.widget-user -->
<!--                <div class="row">
                  <div class="col-md-8">
                    <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete">Delete</option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="<?= cclang('apply_bulk_action'); ?>"><?= cclang('apply_button'); ?></button>
                     </div>
                     <div class="col-sm-3 padd-left-0  " >
                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
                     </div>
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value=""><?= cclang('all'); ?></option>
                           <option <?= $this->input->get('f') == 'company' ? 'selected' :''; ?> value="company">Company</option>
                           <option <?= $this->input->get('f') == 'ship_name' ? 'selected' :''; ?> value="ship_name">Ship Name</option>
                           <option <?= $this->input->get('f') == 'name' ? 'selected' :''; ?> value="name">Name</option>
                           <option <?= $this->input->get('f') == 'maker' ? 'selected' :''; ?> value="maker">Maker</option>
                           <option <?= $this->input->get('f') == 'type' ? 'selected' :''; ?> value="type">Type</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/ship_equipment');?>" title="<?= cclang('reset_filter'); ?>">
                        <i class="fa fa-undo"></i>
                        </a>
                     </div>
                  </div>-->
                  </form>                  
                  <div class="col-sm-12 padding-right-0">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                        <?= $pagination; ?>
                     </div>
                  </div>
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
    
//    $('#btn_filter').click(function(){
//       $.ajax({
//                 type: "GET",
//                 url: BASE_URL + 'administrator/Ship_equipment/get_filter',
//                 dataType: "json",
//                 data: {"company" : $('#company').val(),"ship" : $('#ship_name').val() },
//             
//                 beforeSend: function(e){
//                     if(e && e.overrideMimeType){}
//                 },
//                 success: function(response){
//                     console.log("Result : " +response.list_ship_name);
//                    
//                 },
//                 error: function (xhr, ajaxOptions, thrownError) {
//
//                 }
//              });
//    });
   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_ship_equipment').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
            cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/administrator/ship_equipment/delete?' + serialize_bulk;      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "<?= cclang('please_choose_bulk_action_first'); ?>",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Okay!",
            closeOnConfirm: true,
            closeOnCancel: true
          });

        return false;
      }

      return false;

    });/*end appliy click*/


    //check all
    var checkAll = $('#check_all');
    var checkboxes = $('input.check');

    checkAll.on('ifChecked ifUnchecked', function(event) {   
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

  }); /*end doc ready*/
</script>
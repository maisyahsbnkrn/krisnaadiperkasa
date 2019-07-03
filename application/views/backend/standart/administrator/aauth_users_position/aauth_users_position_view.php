
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+e', function assets() {
      $('#btn_edit').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
      $('#btn_back').trigger('click');
       return false;
   });
    
}


jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Users Position      <small><?= cclang('detail', ['Users Position']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/aauth_users_position'); ?>">Users Position</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
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
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/view.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Users Position</h3>
                     <h5 class="widget-user-desc">Detail Users Position</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_aauth_users_position" id="form_aauth_users_position" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Id Position </label>

                        <div class="col-sm-8">
                           <?= _ent($aauth_users_position->id_position); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Position </label>

                        <div class="col-sm-8">
                           <?= _ent($aauth_users_position->position_name); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('aauth_users_position_update', function() use ($aauth_users_position){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit aauth_users_position (Ctrl+e)" href="<?= site_url('administrator/aauth_users_position/edit/'.$aauth_users_position->id_position); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Aauth Users Position']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/aauth_users_position/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Aauth Users Position']); ?></a>
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
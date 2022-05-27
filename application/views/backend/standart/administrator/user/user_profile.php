
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
      window.location.href = BASE_URL + '/administrator/user';
       return false;
   });
    
}


jQuery(document).ready(domo);
</script>
<style type="text/css">
  .widget-user-header {
    padding-left: 20px !important; 
  }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      User
      <small>Profile User</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/user'); ?>">User</a></li>
      <li class="active">Profile</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
     
      <div class="col-md-7">
         <div class="box box-warning">
            <div class="box-body ">

                   <!-- /.col -->
                  <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user" >
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header " style="background: url('<?= BASE_ASSET; ?>admin-lte/dist/img/photo1.png') center center;">
                        <h3 class="widget-user-username text-white"><?= _ent(ucwords($user->full_name)); ?></h3>
                        <h5 class="widget-user-desc text-white"><?= _ent($user->username); ?></h5>
                      </div>
                      <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_URL.'uploads/user/'.(!empty($user->avatar) ? $user->avatar :'default.png'); ?>" alt="User Avatar" style="height: 80px; width: 80px" >
                      </div>
                      <div class="box-footer">
                       
                        <!-- /.row -->
                      </div>
                    </div>     
                    </div>
                    <div class="col-md-6">
                      <!-- Widget: user widget style 1 -->
                      <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="">
                          
                          <h3 class="">Group User</h3>
                        </div>
                        <div class="box-footer no-padding">
                          <ul class="nav nav-stacked">
                          <?php foreach($this->aauth->get_user_groups() as $row): ?>
                            <li><a href="#"><i class="fa fa-chevron-right"></i> <?= _ent($row->name); ?></a></li>
                           <?php endforeach; ?>
                          </ul>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </div>

                     <div class="col-md-6">
                      <!-- Widget: user widget style 1 -->
                      <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="">
                          <h3 class="">Detail User</h3>
                        </div>
                        <div class="box-footer no-padding">
                          <ul class="nav nav-stacked">
                            <li><a href="#"><i class='fa fa-shield color-orange'></i> Status 
                              <?php if ($user->banned) :?>
                                <span class="pull-right badge bg-red">Banned</span></a>
                              <?php else: ?>
                                <span class="pull-right badge bg-blue">Active</span></a>
                              <?php endif; ?>
                            </li>
                            <li><a href="#"><i class='fa  fa-safari  color-orange'></i> Last Login <span class="pull-right "><?= _ent($user->last_login); ?></span></a></li>
                            <li><a href="#"><i class='fa fa-history color-orange'></i> Last Activity <span class="pull-right "><?= _ent($user->last_activity); ?></span></a></li>
                            <li><a href="#"><i class='fa fa-calendar-check-o  color-orange'></i> Date Created <span class="pull-right "><?= _ent($user->date_created); ?></span></a></li>
                            <li><a href="#"><i class='fa fa-chrome color-orange'></i> IP Address <span class="pull-right "><?= _ent($user->ip_address); ?></span></a></li>
                          </ul>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </div>
                   <div class="row-fluid col-md-12" >
                        <?php is_allowed('user_update_profile',function() use ($user){?>
                        <a class="btn btn-flat btn-info btn-warning btn_edit btn_action" id="btn_edit" data-stype='back' title="edit profile (Ctrl+e)" href="<?= site_url('administrator/user/edit_profile/'.$user->id); ?>"><i class="fa fa-edit" ></i> Edit Profile</a>
                        <?php }) ?>
                  </div>

                 
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>
</section>
<!-- /.content -->
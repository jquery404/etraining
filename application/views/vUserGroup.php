
    

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 901px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>User Group</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>        
      <li class="active">User Group</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
      <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">User Group</h3>
            <div class="box-tools">
                <div class="no-margin pull-right"></div>
              
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>Option</th>
                <th>Sl.No.</th>
                <th>Name</th>
              </tr>

              <?php foreach ($user_group as $key=>$student): ?>
                <tr alt="<?php echo $student['userid']; ?>">
                  <td><?php echo ($key+1); ?></td>
                  <td><?php echo $student['user_email']; ?></td>
                  <td><select class="user_group">
                    <?php
                      foreach($roles_name as $k => $role):
                        if ($student['role'] == $role->name) $sel = "selected"; 
                        else $sel = "";
                        echo '<option value="'.$role->id.'" '.$sel.'>'.$role->name.'</option>';
                      endforeach;
                    ?>
                    </select>
                  </td>                                
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
        </div> <!--.box-->
      </div>
      </div>
  </section>


</div>


      
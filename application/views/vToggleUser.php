
    

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 901px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Staff List</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>        
      <li class="active">Staff List</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
      <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Staff List</h3>
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
                <th>Status</th>
              </tr>

              <?php foreach ($user_list as $key=>$student): ?>
                <tr alt="<?php echo $student->id; ?>">
                  <td align=""><input type="checkbox" <?php if($student->status) echo "checked"; ?>></td>
                  <td><?php echo ($key+1); ?></td>
                  <td><?php echo $student->email; ?></td>
                  <td><?php if($student->status) echo "active"; else echo "inactive"; ?></td>
                </tr>
              <?php endforeach; ?>



            </table>
          </div>
        </div> <!--.box-->
      </div>
      </div>
  </section>


</div>


      

    

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 901px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Staff List</h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>        
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
                <div class="no-margin pull-right">
                  <a href="<?php echo base_url('home/printing'); ?>" class="btn btn-sm btn-success btn-print-staff"><i class="fa fa-print"></i>  Print</a>
                  <button type="button" data-toggle="modal" data-target="#addstudentmodal" class="btn btn-sm btn-primary btn-add-student"><i class="fa fa-plus-circle"></i> Add New</button>
                </div>
              
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>Options</th>
                <th>Name</th>
                <th>Position</th>
                <th>Gender</th>
                <th>Dept.</th>
                <th>Course</th>
                <th>Grad</th>
                <th>Date Start</th>
                <th>Date End</th>
              </tr>
              
              <?php foreach ($staff_list as $key=>$staff): ?>
              <tr alt="<?php echo $staff->id; ?>">
                <td>             
                <a class="std_edit btn btn-primary" data-toggle="modal" data-target="#editstudentmodal"><em class="fa fa-pencil"></em></a>
                <a class="btn btn-danger delstudent"><em class="fa fa-trash"></em></a>
                </td>
                <td><?php echo $staff->name; ?></td>
                <td><?php echo $staff->position; ?></td>
                <td><?php echo $staff->gender; ?></td>
                <td><?php echo $staff->dept; ?></td>
                <td><?php echo $staff->course_name; ?></td>
                <td><?php echo $staff->grad; ?></td>
                <td><?php echo $staff->date_start; ?></td>
                <td><?php echo $staff->date_end; ?></td>
              </tr>
              <?php endforeach; ?>

            </table>
          </div>
        </div> <!--.box-->
      </div>
      </div>
  </section>


</div>


      <!-- add student modal -->
      <div class="modal fade" id="addstudentmodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
              <h3 class="modal-title" id="lineModalLabel">Add new Student</h3>
            </div>
            <div class="modal-body">
              <!-- content goes here -->
            <?php echo form_open('home/addStaff'); ?>
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="staff_name" placeholder="Full name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Position</label>
                  <input type="text" class="form-control" name="staff_pos" placeholder="Position">
                </div>
                
                <div class="form-group">
                  <label>Gender</label>
                  <select class="form-control" name="staff_gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Dept.</label>
                  <input type="text" class="form-control" name="staff_dept" placeholder="Dept.">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Course</label>
                  <input type="text" class="form-control" name="staff_course" placeholder="Course">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Grad</label>
                  <input type="text" class="form-control" name="staff_grad" placeholder="Grad">
                </div>

               
                <div class="form-group">
                  <label>Start Date:</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="datepicker form-control pull-right" name="start_date">
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <label>End Date:</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="datepicker form-control pull-right" name="end_date">
                  </div>
                  <!-- /.input group -->
                </div>

                <button type="submit" class="btn btn-default btn-sub-studentlist">Submit</button>
              <?php echo form_close(); ?>

            </div>

          </div>
        </div>
      </div>

      <!-- edit student modal -->
      <div class="modal fade" id="editstudentmodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
              <h3 class="modal-title" id="lineModalLabel">Edit Staff</h3>
            </div>
            <div class="modal-body">
              <!-- content goes here -->
            <?php echo form_open('home/edit', 'id="editStaffForm"'); ?>

                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control hide" name="edit_stdid" placeholder=" ">
                  <input type="text" class="form-control" name="estaff_name" placeholder="Full name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Position</label>
                  <input type="text" class="form-control" name="estaff_pos" placeholder="Position">
                </div>
                
                <div class="form-group">
                  <label>Gender</label>
                  <select class="form-control" name="estaff_gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Dept.</label>
                  <input type="text" class="form-control" name="estaff_dept" placeholder="Dept.">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Course</label>
                  <input type="text" class="form-control" name="estaff_course" placeholder="Course">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Grad</label>
                  <input type="text" class="form-control" name="estaff_grad" placeholder="Grad">
                </div>

               
                <div class="form-group">
                  <label>Start Date:</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="datepicker form-control pull-right" name="estart_date">
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <label>End Date:</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="datepicker form-control pull-right" name="eend_date">
                  </div>
                  <!-- /.input group -->
                </div>

                <button type="submit" class="btn btn-default btn-sub-edit-std">Submit</button>
              <?php echo form_close(); ?>

            </div>

          </div>
        </div>
      </div>



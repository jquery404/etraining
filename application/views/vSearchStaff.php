
    

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
                
              
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">             

          <?php echo form_open('search/do_search'); ?>
              <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <span id="search_concept">Search by</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#grade">Grade</a></li>
                      <li><a href="#gender">Gender</a></li>
                      <li><a href="#division">Division</a></li>
                      <li><a href="#date">Date</a></li>
                      <li class="divider"></li>
                      <li><a href="#daterange">Range</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control all_searchbox" name="x" placeholder="Search term...">
                <input type="text" class="form-control hidden search_daterange" disabled name="x" placeholder="Search term...">
                <span class="input-group-btn">
                    <button class="btn btn-default btn-search" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
              </div>
          <?php echo form_close(); ?>

          </div>

          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
          <?php if($search_results != ""): ?>


            <table class="table table-hover">
              <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Gender</th>
                <th>Dept.</th>
                <th>Course</th>
                <th>Grad</th>
                <th>Date Start</th>
                <th>Date End</th>
              </tr>
              
              <?php foreach ($search_results as $key=>$staff): ?>
              <tr>
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

          <?php endif; ?>
          </div>


        </div> <!--.box-->
      </div>
      </div>
  </section>


</div>
      
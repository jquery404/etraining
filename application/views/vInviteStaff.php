
    

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 901px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Invite Staff</h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>        
      <li class="active">Invite Staff</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">
      <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open('home/send_invite'); ?>
              <div class="box-body">
                <div class="form-group">
                  <?php if(isset($error)) echo $error; ?>
                  <?php if(isset($status)) echo $status. "<br/>"; ?>
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="staff_email" class="form-control" placeholder="Enter email">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div><!--.box-->
      </div>
      </div>
  </section>


</div>


      
<?php if(!isset($no_footer)): ?>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.3.5
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.jquery404.github.io/">jQuery404</a>.</strong> All rights
    reserved.
  </footer>
<?php endif;?>


<!-- jQuery 2.2.0 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jquery countdown -->
<script src="<?php echo base_url(); ?>assets/dist/js/jquery.countdown.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery datepicker -->
<script src="<?php echo base_url(); ?>assets/dist/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/moment.min.js"></script>
<!-- jquery daterangepicker -->
<script src="<?php echo base_url(); ?>assets/dist/js/daterangepicker.js"></script>
<!-- SweetAlert -->
<script src="<?php echo base_url(); ?>assets/dist/js/sweetalert.js"></script>
<!-- Tinymce -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3d',
        autoclose: true
    });


    $('.search-panel .dropdown-menu').find('a').click(function(e) {
      e.preventDefault();
      var param = $(this).attr("href").replace("#","");
      var concept = $(this).text();
      $('.search-panel span#search_concept').text(concept);
      $('.input-group #search_param').val(param);
      $('.search_daterange').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
          format: 'YYYY-MM-DD'
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function (start, end) {
        $('.search_daterange').html(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });

      if(param == "date")
      { 
        $('.all_searchbox').removeClass('hidden').prop('disabled', false);
        $('.search_daterange').addClass('hidden').prop('disabled', true);
        $('.all_searchbox').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d',
            autoclose: true
        });
      }
      else if(param == "daterange")
      {
        $('.all_searchbox').datepicker('remove');
        $('.all_searchbox').addClass('hidden').prop('disabled', true);
        $('.search_daterange').removeClass('hidden').prop('disabled', false);
      }
      else
      {
        $('.all_searchbox').datepicker('remove');
        $('.all_searchbox').removeClass('hidden').prop('disabled', false);
        $('.search_daterange').addClass('hidden').prop('disabled', true);
      }

    });

    $('.table > tbody > tr').on('click', '.std_edit', function() {
        var tr = $(this).parents('tr');
        var id = tr.attr('alt');
        var name = $('td:eq(1)', tr).html();
        var pos = $('td:eq(2)', tr).html();
        var gender = $('td:eq(3)', tr).html();
        var dept = $('td:eq(4)', tr).html();
        var course = $('td:eq(5)', tr).html();
        var grad = $('td:eq(6)', tr).html();
        var sdate = $('td:eq(7)', tr).html();
        var edate = $('td:eq(8)', tr).html();

        $('input[name="edit_stdid"]').val(id);
        $('input[name="estaff_name"]').val(name);
        $('input[name="estaff_pos"]').val(pos);
        $('select[name="estaff_gender"]').val(gender);
        $('input[name="estaff_dept"]').val(dept);
        $('input[name="estaff_course"]').val(course);
        $('input[name="estaff_grad"]').val(grad);
        $('input[name="estart_date"]').val(sdate);
        $('input[name="eend_date"]').val(edate);

    });


    $(document).on('click', '.btn-sub-edit-std', function(e){
        
        $this = $(this);
        $this.attr('disabled', 'disabled');

        $.post("<?php echo site_url(); ?>/home/edit", 
          $("#editStaffForm").serialize(), function(data) {
            var res = JSON.parse(data); 
            if(res.status)
              location.reload(true);
            else
            {
              sweetAlert("Oops...", res.err_msg, "error");             
              $this.removeAttr('disabled');
            }    
            
            
        }); 
        
        return false;
    });


    $('.table > tbody > tr').on('click', '.qus_edit', function() {
        var tr = $(this).parents('tr');
        var id = tr.attr('alt');
        var select = $('td:eq(1)', tr).html();
        var name = $.trim($('td:eq(2) span', tr).html());
        var ch1 = $('td:eq(3) ul li:eq(0) span', tr).html();
        var ch2 = $('td:eq(3) ul li:eq(1) span', tr).html();
        var ch3 = $('td:eq(3) ul li:eq(2) span', tr).html();        
        var cor = $('td:eq(4) span', tr).html();

        $('input[name="edit_qusid"]').val(id);
        $('select[name="edit_quscat"]').val(select);
        $('textarea[name="edit_qustitle"]').val(name);
        $('input[name="edit_qusopt1"]').val(ch1);
        $('input[name="edit_qusopt2"]').val(ch2);
        $('input[name="edit_qusopt3"]').val(ch3);
        $('input[name="edit_quscor"]').val(cor);

    });

    

    $(document).on('click', '.btn-sub-edit-qus', function(e){
        
        $this = $(this);
        $this.attr('disabled', 'disabled');

        $.post("<?php echo site_url(); ?>/admin/editQuestion", 
          $("#editQuestionForm").serialize(), function(data) {           
          
            var res = JSON.parse(data); 
            if(res.status)
              location.reload(true);
            else
            {
              sweetAlert("Oops...", res.err_msg, "error");
              $this.removeAttr('disabled');
            }            
        }); 
        
        return false;
    });

    $(document).on('click', '.utoggle', function(e){   
        
      var id = $(this).parents('tr').attr('alt');
      var checked = $(this).is(':checked');
     
      $.post("<?php echo site_url(); ?>/home/toggleUser", 
        { id: id, status: checked }, function(data) {           
        
          var res = JSON.parse(data); 
            if(res.status)
              location.reload(true);
            else
            {
              sweetAlert("Oops...", res.err_msg, "error");
              location.reload(true);
            }    
      }); 
      
      
    });

    $('.user_group').on('change', function() {
      var optionSelected = $("option:selected", this).html();
      var valueSelected = this.value;
      var id = $(this).parents('tr').attr('alt');

      $.post("<?php echo site_url(); ?>/home/cngUserGroup", 
        { userid: id, roleid: valueSelected }, function(data) {           
          
          var res = JSON.parse(data); 

          if(res.status)
            location.reload(true);
          else
          {
            sweetAlert("Oops...", res.err_msg, "error");
            location.reload(true);  
          }   
      });
    });


    $('.delstudent').each(function( i ) {
      $(this).on('click', function(){
        var id = $(this).parents('tr').attr('alt');
        swal({   
          title: "Are you sure?",
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "#DD6B55",   
          confirmButtonText: "Ok",   
          closeOnConfirm: false 
        }, function(){
          $.post("<?php echo site_url(); ?>/home/del", {id:id}, function(data) {          
            var res = JSON.parse(data); 
            if(res.status)
              location.reload(true);
            else
              sweetAlert("Oops...", res.err_msg, "error");
          });    
          
        });
      });
    });



    $('.delquestion').each(function( i ) {
      $(this).on('click', function(){
        var id = $(this).parents('tr').attr('alt');
        swal({   
          title: "Are you sure?",
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "#DD6B55",   
          confirmButtonText: "Ok",   
          closeOnConfirm: false 
        }, function(){
          $.post("<?php echo site_url(); ?>/admin/delQuestion", {id:id}, function(data) {          
            var res = JSON.parse(data); 
            if(res.status)
              location.reload(true);
            else
              sweetAlert("Oops...", res.err_msg, "error");
          });    
          
        });
      });
    });


    $(document).on('click', '.btn-add', function(e)
    {
      e.preventDefault();
      var controlForm = $('.multibox .multibox-wrap'),
         currentEntry = $(this).parents('.entry:first'),
         newEntry = $(currentEntry.clone()).appendTo(controlForm);
      newEntry.find('input').val('');
      var src = newEntry.find('.browseModelbtn').attr('data-src');
      src += new Date().valueOf();

      newEntry.find('.browseModelbtn').attr('data-src', src);
      newEntry.find('input[type="text"]').attr('id', src);
      controlForm.find('.entry:not(:last) .btn-add')
         .removeClass('btn-add').addClass('btn-remove')
         .removeClass('btn-success').addClass('btn-danger')
         .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e){
      $(this).parents('.entry:first').remove();
      e.preventDefault();
      return false;
    });


  });


</script>
</body>
</html>

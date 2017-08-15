    <hr/>
    
    <div class="footer no-print">
            
            <div>
                <strong>Copyright</strong> Sun Hope Industry &copy; <?php echo date("Y"); ?>                                
            </div>
     </div>
    
    
    
    	</div> <!-- div class="wrapper wrapper-content" -->
    </div> <!-- end of header div id="page-wrapper" class="gray-bg" -->
</div> <!-- end of div id="wrapper" -->

<!-- Mainly scripts -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.1.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js');?>"></script>

<!-- Peity -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/peity/jquery.peity.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/demo/peity-demo.js');?>"></script>

<!-- Custom and plugin javascript -->
<script type="text/javascript" src="<?php echo base_url('assets/js/inspinia.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/pace/pace.min.js');?>"></script>


<!--script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jquery-ui/jquery-ui.min.js');?>"></script-->

<!-- Jvectormap -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js');?>"></script>
    
<!-- EayPIE -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/easypiechart/jquery.easypiechart.js');?>"></script>

<!-- Sparkline -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/sparkline/jquery.sparkline.min.js');?>"></script>

<!-- Sparkline demo data  -->
<script type="text/javascript" src="<?php echo base_url('assets/js/demo/sparkline-demo.js');?>"></script>

<!-- Data picker -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datapicker/bootstrap-datepicker.js');?>"></script>
<!-- SUMMERNOTE -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/summernote/summernote.min.js');?>"></script>

<script type="text/javascript">

//$('.summernote').summernote();
$(document).ready(function(){
select_voucher();
$('#summernote').summernote({
        height: 500
});
});

$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});

$('#enable_date .input-group.date').datepicker({
	format: 'mm-dd-yyyy',
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});

$('#disable_date .input-group.date').datepicker({
	format: 'mm-dd-yyyy',
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});

$('#start_top').datepicker({
	format: 'dd-mm-yyyy',
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});

$('#end_top').datepicker({
	format: 'dd-mm-yyyy',
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});

$('#topup_date').datepicker({
	format: 'dd-mm-yyyy',
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});

$('#consume_date').datepicker({
	format: 'dd-mm-yyyy',
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});

$('#datepicker1').datepicker({
	format: 'dd-mm-yyyy',
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});

$('#datepicker2').datepicker({
	format: 'dd-mm-yyyy',
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});


function do_search(val)
{
	$('#search_term').val($('#'+val).val());
	$('#start_date').val($('#start_'+val+'_alt').val());
	$('#end_date').val($('#end_'+val+'_alt').val());
	$('#search_form').submit();
}

function do_export(val)
{
	$('#export_search_term').val($('#'+val).val());
	$('#export_start_date').val($('#start_'+val+'_alt').val());
	$('#export_end_date').val($('#end_'+val+'_alt').val());
	$('#export_form').submit();
}

function submit_form()
{
	if($(".gc_check:checked").length > 0)
	{
		return confirm('<?php echo lang('confirm_delete_order') ?>');
	}
	else
	{
		alert('<?php echo lang('error_no_credits_selected') ?>');
		return false;
	}
}

function save_status(id)
{
	show_animation();
	$.post("<?php echo site_url($this->config->item('admin_folder').'/credit/edit_status'); ?>", { id: id, status: $('#status_form_'+id).val()}, function(data){
		setTimeout('hide_animation()', 500);
	});
}

function show_animation()
{
	$('#saving_container').css('display', 'block');
	$('#saving').css('opacity', '.8');
}

function hide_animation()
{
	$('#saving_container').fadeOut();
}

//function to add in voucher to users
function select_voucher()
{
	$('.loading').fadeIn('slow');
	//console.log('voucherID: ' + voucherID + 'customerID: ' + customerID);
	voucherID = $('#voucher_id').val();
	payment = $('#payment').val();	
				
	$.post("<?php echo site_url($this->config->item('admin_folder').'/credit/retrieve_voucher_value'); ?>", {
		voucher_id : voucherID,
		payment : payment,		
		},
		function(data) {			
		    $('.loading').fadeOut('slow');		   		   
		    $('#consume_amount').val(data);	    	 		    
		});		
}

</script>

		
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/upload/vendor/jquery.ui.widget.js');?>"></script>
<!-- The Load Image plugins is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugins is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/upload/jquery.iframe-transport.js');?>"></script>
<!-- The basic File Upload plugins -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/upload/jquery.fileupload.js');?>"></script>
<!-- The File Upload processing plugins -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/upload/jquery.fileupload-process.js');?>"></script>
<!-- The File Upload image preview & resize plugins -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/upload/jquery.fileupload-image.js');?>"></script>
<!-- The File Upload audio preview plugins -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/upload/jquery.fileupload-audio.js');?>"></script>
<!-- The File Upload video preview plugins -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/upload/jquery.fileupload-video.js');?>"></script>
<!-- The File Upload validation plugins -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/upload/jquery.fileupload-validate.js');?>"></script>
<script>
/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
     var url = "<?php echo base_url(); ?>"+"admin/card/upload_card/",            
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
     
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        console.log(data.loaded);
        console.log(data.total);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
                                
                $(".step-by-inner-img2 img").attr("src", file.url).css(
					'width','280px', 'height','180px'    									
                 ); 
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    // Change this to the location of your server-side upload handler:
    var voucher_url = "<?php echo base_url(); ?>"+"admin/card/upload_card/",            
       uploadButton = $('<button/>')
           .addClass('btn btn-primary')
           .prop('disabled', true)
           .text('Processing...')
           .on('click', function () {
               var $this = $(this),
                   data = $this.data();
               $this
                   .off('click')
                   .text('Abort')
                   .on('click', function () {
                       $this.remove();
                       data.abort();
                   });
               data.submit().always(function () {
                   $this.remove();
               });
      });
    
});


</script>

</body>
</html>
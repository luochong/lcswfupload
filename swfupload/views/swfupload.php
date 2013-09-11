<script type="text/javascript">
		var swfu<?php echo $threadId?>;		
		$(function () {
			swfu<?php echo $threadId?> = new SWFUpload({
				// Backend Settings
				upload_url: '<?php echo $uploadUrl?>',
				post_params: <?php echo $postParams?>,				
			
				file_size_limit : '<?php echo $fileSizeLimit;?>MB',	
				file_types : "<?php echo  $fileTypes;?>",
				file_types_description : "<?php echo $fileTypes;?>文件",
				file_upload_limit : 0,
				file_queue_limit : <?php echo $fileQuenueLimit;?>, 
			
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,

				// Button Settings
				button_image_url : "<?php echo $baseUrl; ?>/uploadbutton.gif",
				button_placeholder_id : "button_placeholder_<?php echo $threadId?>",
				button_width: 186,
				button_height: 25,
				button_text : '<span class="button"><?php echo $buttonText;?><span class="buttonSmall">(<?php echo $fileSizeLimit?>MB)</span></span>',
				button_text_style : '.button {font-family: Arial,Helvetica,sans-serif; font-size: 13pt; } .buttonSmall { font-size: 10pt; }',
				button_text_top_padding: 2,
				button_text_left_padding: 28,
				button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
				button_cursor: SWFUpload.CURSOR.HAND,
				
				// Flash Settings
				flash_url : "<?php echo $baseUrl?>/swfupload.swf",

				custom_settings : {
					upload_target : "fileProgressContainer_<?php echo $threadId?>",
					thumbnails	: "thumbnails_<?php echo $threadId?>",
					thread_id   :"<?php echo $threadId?>"
				},
				
				// Debug Settings
				debug: <?php echo $debug?>
			});
		}
		);
		</script>	
	<div class="swfupload_button">
			<div id="button_placeholder_<?php echo $threadId?>">&nbsp;</div>
	</div>
	<div class="cl"></div>
	<div id="fileProgressContainer_<?php echo $threadId?>"></div>
	<div id="thumbnails_<?php echo $threadId?>">   
	<?php foreach ($imgUrlList as $img):?>
		      		<img style="margin: 5px; opacity: 1;" width="100" height="100" src="<?php echo $img?>">
	<?php endforeach;?>
	</div>

<?php if (property_exists($this, 'image')): ?>
	<!-- This fieldset gets rendered if we have an image attached to the post: Replace -->
<style type="text/css">
.row {margin-bottom: 5px;}
</style>
	<div id="yapbdiv" class="postbox">

		<!-- <h3><?php _e('YAPB Image', 'yapb') ?></h3> -->
		<?php $imageData = $GLOBALS['imageData']; ?>
		<div class="inside">
			<div class="row">
				<label for="area">地区：</label><input value="<?php echo $imageData['area'] ?>" type="text" id="area" name="area">
			</div>
			<div class="row">
				<label for="scenic">地点：</label><input value="<?php echo $imageData['scenic'] ?>" type="text" id="scenic" name="scenic">
			</div>
			<div class="row">
				<label for="width">图片宽度：</label><input value="<?php echo $imageData['width'] ?>" type="text" id="width" name="width">
			</div>
			<div class="row">
				<label for="height">图片高度：</label><input value="<?php echo $imageData['height'] ?>" type="text" id="height" name="height">
			</div>
			<div class="row time">
				<label for="time">时间：</label><input value="<?php echo $imageData['time'] ? $imageData['time'] : date('Y-m-d\TH:i') ?>" type="datetime-local" id="time" name="time">
			</div>

			<!-- Why can't browsers calculate the height of a div? -->
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<img src="<?php echo $this->image->getThumbnailHref(array('h=80','fltr[]=usm|30|3|3')) ?>" height="80" alt="" style="float:left;margin-right:10px;height:80px;">
						<?php _e('Replace image:', 'yapb') ?><input type="file" name="yapb_imageupload" size="30" tabindex="1" value="" id="imageupload" style="background-color:white;" /><br>
						<input type="checkbox" name="yapb_exifdate" id="checkbox_yapb_exifdate" value="1" <?php if(get_option('yapb_check_post_date_from_exif')): ?>checked<?php endif ?> /> <label for="checkbox_yapb_exifdate"><?php _e('Post date from image exif data if available', 'yapb') ?></label><br>
						<input type="checkbox" name="yapb_remove_image" value="1"> <span style="color:red;"><?php _e('Remove image from post', 'yapb') ?></span><br>
					</td>
				</tr>
			</table>
		</div>
	</div>

<?php else: ?>
<style type="text/css">
.row {margin-bottom: 5px;}
</style>
	<!-- This fieldset gets rendered if we have no image attached to the post: Upload -->

	<div id="yapbdiv" class="postbox">
		<h3><?php _e('YAPB Image', 'yapb') ?></h3>
		<div class="inside">
			<div class="row">
				<label for="area">地区：</label><input value="<?php echo $imageData['area'] ?>"  type="text" id="area" name="area">
			</div>
			<div class="row">
				<label for="scenic">地点：</label><input value="<?php echo $imageData['scenic'] ?>" type="text" id="scenic" name="scenic">
			</div>
			<div class="row">
				<label for="width">图片宽度：</label><input value="<?php echo $imageData['width'] ?>" type="text" id="width" name="width">
			</div>
			<div class="row">
				<label for="height">图片高度：</label><input value="<?php echo $imageData['height'] ?>" type="text" id="height" name="height">
			</div>
			<div class="row time">
				<label for="time">时间：</label><input value="<?php echo $imageData['time'] ? $imageData['time'] : date('Y-m-d\TH:i') ?>" type="datetime-local" id="time" name="time">
			</div>
			<input type="file" id="yapb_imageupload" name="yapb_imageupload" size="30" tabindex="1" value="" id="imageupload" style="background-color:white;" onChange="toggleCategory(true);" /><input type="button" value="<?php _e('clear field', 'yapb') ?>" onClick="$('yapb_imageupload').value='';toggleCategory(false);" /><br/>
			<input type="checkbox" name="exifdate" id="checkbox_yapb_exifdate" value="1" <?php if(get_option('yapb_check_post_date_from_exif')): ?>checked<?php endif ?> /> <label for="checkbox_yapb_exifdate"><?php _e('Post date from image exif data if available', 'yapb') ?></label><br>
		</div>
	</div>

<?php endif ?>
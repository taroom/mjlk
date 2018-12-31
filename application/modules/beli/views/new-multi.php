<?php 
if(isset($data_upload)){
	if(count($data_upload) > 1){
		foreach($data_upload as $k => $v){
			if($data_upload[$k]['state']){
				echo 'Upload file '.($k+1).' Berhasil<br>';
			} else {
				echo 'Upload file '.($k+1).' Gagal : '.$v['error'].'<br>';
			}
		}
	} else {
		echo('just one');
		if($data_upload[0]['state']){
			echo 'Berhasil';
		} else {
			echo 'Gagal'. $data_upload[0]['error'];
		}
	}
}?>

<?php echo form_open_multipart();?>
	Upload :<br>
	<input type="file" multiple name="userfile[]" size="20" /><br>

	<input type="submit" name="pso" value="Upload" class="btn btn-default">
</form>
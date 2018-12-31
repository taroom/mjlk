<?php 
if(isset($data_upload)){
	//echo $error;
	if($data_upload['state']){
		echo 'berhasil mengupload';
	} else {
		echo 'gagal Upload';
	}
}?>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart();?>
	Upload :<br>

	ID :
	<input type="text" class="form-control" name="id_member" size="20" /><br>
	Nama :
	<input type="text" class="form-control" name="nama" size="20" /><br>
	Alamat :
	<textarea class="form-control" name="alamat"></textarea><br>
	Deskripsi :
	<textarea class="form-control" name="deskripsi"></textarea><br>
	Foto :
	<input type="file" class="form-control" name="userfile" size="20" /><br>

	<input type="submit" name="pso" value="Upload" class="btn btn-default">
</form>
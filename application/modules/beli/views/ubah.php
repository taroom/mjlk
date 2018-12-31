<?php echo validation_errors(); ?>
<?php echo form_open_multipart();?>
	Upload :<br>
	<?php $model = $data_member->result()[0]; ?>
	<input type="hidden" class="form-control" name="id_member" size="20" value="<?= $model->id_member ?>" /><br>
	<input type="hidden" class="form-control" name="foto_lama" size="20" value="<?= $model->foto ?>" /><br>
	Nama :
	<input type="text" class="form-control" name="nama" size="20" value="<?= $model->nama ?>" /><br>
	Alamat :
	<textarea class="form-control" name="alamat"><?= $model->alamat ?></textarea><br>
	Deskripsi :
	<textarea class="form-control" name="deskripsi"><?= $model->deskripsi ?></textarea><br>
	Foto :
	<input type="file" class="form-control" name="userfile" size="20" /><br>
	<img src="media/member/<?= $model->foto ?>" alt="member foto" height="50">
	<input type="submit" name="pso" value="Upload" class="btn btn-default">
</form>
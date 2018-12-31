<table class="table">
<?php foreach($list_member as $v): ?>
	<tr>
	<td><?= $v->id_member ?></td>
	<td><?= $v->nama ?></td>
	<td><?= $v->foto ?></td>
	<td><?= $v->alamat ?></td>
	<td><?= $v->deskripsi ?></td>
	<td><a href="<?= base_url('member/ubah/'.$v->id_member) ?>" class="btn btn-success">Edit</td>
	</tr>
<?php endforeach; ?>
</table>
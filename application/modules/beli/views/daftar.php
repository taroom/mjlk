<div class="container">
	<div class="row">
		<div class="col-md-9">
			<?php foreach($data as $v): ?>
				<?= $v->inc ?> | 
				<?= $v->beli_id ?> | 
				<?= $v->no_fak ?> | 
				<?= $v->beli_id ?> | 
				<?= $v->beli_id ?><hr>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<h1>TaskGenerator</h1>
<h4>Just refresh this page</h4>
<div class="alert alert-dark mt-4">
	count: <?php echo count($tasks); ?>
</div>
<div class="row">
	<?php foreach ($tasks as $key => $task): ?>
		<div class="col-sm-12">
			<div class="card mb-3">
				<div class="card-body">
					<p class="m-1"><span class="text-muted">id: </span><?php echo $task['id'] ?></p>
					<p class="m-1"><span class="text-muted">name: </span><?php echo $task['name'] ?></p>
					<p class="m-1"><span class="text-muted">email: </span><?php echo $task['email'] ?></p>
					<p class="m-1"><span class="text-muted">text: </span><?php echo $task['text'] ?></p>
					<p class="m-1"><span class="text-muted">status: </span><?php echo $task['status'] ?></p>
					<p class="m-1"><span class="text-muted">edited: </span><?php echo $task['edited'] ?></p>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
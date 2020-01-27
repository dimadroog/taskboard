<h1><?php echo $title; ?></h1>

<div class="row">
	<?php foreach ($tasks as $key => $task): ?>
		<div class="col-sm-12">
			<div class="card mb-3">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<h5 class="card-title text-capitalize"><?php echo $task['name'] ?></h5>
						</div>
						<div class="col-md-6">
							<div class="float-lg-right">					
								<?php if ($task['status'] == 0): ?>
									<span class="badge badge-secondary">task pending</span>
								<?php elseif ($task['status'] == 1): ?>
									<span class="badge badge-success">task completed</span>
								<?php endif ?>
								<?php if ($task['edited'] == 1): ?>
									<span class="badge badge-primary">edited by admin</span>
								<?php endif ?>
							</div>
						</div>
					</div>
					<h6 class="card-subtitle mb-2 text-muted"><?php echo $task['email'] ?></h6>
					<p class="card-text"><?php echo $task['text'] ?></p>
				</div>
				<div class="card-footer text-muted">

					<div class="row">
						<div class="col-md-6">
							<a class="btn btn-primary" href="/task/edit/?id=<?php echo $task['id'] ?>">Edit Task</a>
						</div>
						<div class="col-md-6">
							<div class="float-lg-right">					
								<div class="text-secondary mt-2 mb-1">id#<?php echo $task['id'] ?></div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
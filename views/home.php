<h1><?php echo $title; ?></h1>

<ul class="nav nav-tabs mb-3">
	<li class="nav-item">
		<a class="nav-link <?php echo Task::isActive($_GET, 'order_by', 'name') ?>" href="<?php echo Task::urlForOrder($_GET, 'order_by', 'name') ?>">order by name</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?php echo Task::isActive($_GET, 'order_by', 'email') ?>" href="<?php echo Task::urlForOrder($_GET, 'order_by', 'email') ?>">order by email</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?php echo Task::isActive($_GET, 'order_by', 'status') ?>" href="<?php echo Task::urlForOrder($_GET, 'order_by', 'status') ?>">order by status</a>
	</li>
</ul>


<div class="mb-3 clearfix">
	<div class="btn-group btn-group-toggle float-lg-right" role="group" aria-label="...">
		<a href="<?php echo Task::urlForOrder($_GET, 'order', 'ASC') ?>" class="btn btn-secondary <?php echo Task::isActive($_GET, 'order', 'ASC') ?>">ASC</a>
		<a href="<?php echo Task::urlForOrder($_GET, 'order', 'DESC') ?>" class="btn btn-secondary <?php echo Task::isActive($_GET, 'order', 'DESC') ?>">DESC</a>
	</div>
</div>


<?php if (!empty($tasks)): ?>
	

	<div class="row">
		<?php foreach ($tasks as $key => $task): ?>
			<div class="col-sm-4 d-flex align-items-stretch">
				<div class="card mb-4 w-100">
					<div class="card-body">
						<h5 class="card-title text-capitalize"><?php echo $task['name'] ?></h5>
						<h6 class="card-subtitle mb-2 text-muted"><?php echo $task['email'] ?></h6>
						<p class="card-text"><?php echo $task['text'] ?></p>
					</div>
					<div class="card-footer text-muted">
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
		<?php endforeach ?>
	</div>

	<div class="mb-4">
		<?php $pagination->render(); ?>
	</div>

<?php else: ?>
	<div class="alert alert-dark mt-4">
		No isset tasks yet. Let's do create a first Task now!
	</div>
<?php endif ?>


<div class="card mb-4 bg-light">
	<div class="card-body">
		<h5 class="card-title">Create a new task here</h5>

		<form action="/task/create" method="post">
			<div class="form-group">
				<label for="input-name">Name <span class="text-danger">*</span></label>
				<input type="text" name="name" class="form-control p-2" id="input-name" placeholder="input your Name">
			</div>
			<div class="form-group">
				<label for="input-email">Email <span class="text-danger">*</span></label>
				<input type="text" name="email" class="form-control p-2" id="input-email" placeholder="input your Email">

			</div>
			<div class="form-group">
				<label for="input-text">Text <span class="text-danger">*</span></label>
				<textarea class="form-control p-2" name="text" id="input-text" rows="5" placeholder="Do write something here"></textarea>

			</div>
			<button type="submit" class="btn btn-primary">Submit Form</button>
		</form>

	</div>
</div>
<h1><?php echo $title; ?></h1>

<?php if ($success): ?>
	<div class="alert alert-success mt-4">
		<h3>Thanks for submit!</h3>
		<p class="mb-0">Now you may <a class="alert-link" href="/">return to homepage</a> or create one more Task on this page.</p>
	</div>
<?php endif ?>

<?php if (!empty($errors)): ?>
	<div class="alert alert-danger mt-4">
		<h3>Something went wrong!</h3>
		<p class="mb-1">please check the list below:</p>
		<ul>
			<?php foreach ($errors as $error): ?>	
				<li><?php echo $error; ?></li>
			<?php endforeach ?>
		</ul>
	</div>
<?php endif ?>

<div class="card mb-4 mt-4 bg-light">
	<div class="card-body">
		<h5 class="card-title">Create a new task here</h5>

		<form action="/task/create" method="post">
			<div class="form-group">
				<label for="input-name">Name <span class="text-danger">*</span></label>
				<input type="text" name="name" class="form-control p-2 <?php echo Task::isHasError($errors, 'name') ?>" id="input-name" value="<?php echo $data['name'] ?>" placeholder="Your Name">
			</div>
			<div class="form-group">
				<label for="input-email">Email <span class="text-danger">*</span></label>
				<input type="text" name="email" class="form-control p-2 <?php echo Task::isHasError($errors, 'email') ?>" id="input-email" value="<?php echo $data['email'] ?>" placeholder="Your Email">

			</div>
			<div class="form-group">
				<label for="input-text">Text <span class="text-danger">*</span></label>
				<textarea class="form-control p-2 <?php echo Task::isHasError($errors, 'text') ?>" name="text" id="input-text" rows="5" placeholder="Do write something here"><?php echo $data['text'] ?></textarea>

			</div>
			<button type="submit" class="btn btn-primary">Submit Form</button>
		</form>

	</div>
</div>


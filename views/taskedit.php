<h1><?php echo $title; ?> #<?php echo $data['id'] ?></h1>

<?php if ($success): ?>
	<div class="alert alert-success mt-4">
		<h3>A Tak are edited</h3>
		<p class="mb-0">Now you may <a class="alert-link" href="/admin">return to admin page</a> or edit this Task one more time.</p>
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
		<h5 class="card-title">Edit task form</h5>
			<div class="float-lg-right">					
				<?php if ($data['status'] == 0): ?>
					<span class="badge badge-secondary">task pending</span>
				<?php elseif ($data['status'] == 1): ?>
					<span class="badge badge-success">task completed</span>
				<?php endif ?>
				<?php if ($data['edited'] == 1): ?>
					<span class="badge badge-primary">edited by admin</span>
				<?php endif ?>
			</div>

		<form action="/task/edit" method="post">			
			<!-- hidden inputs -->
			<input type="hidden" name="id" class="form-control p-2 " id="input-id" value="<?php echo $data['id'] ?>">
			<input type="hidden" name="edited" class="form-control p-2 " id="input-id" value="<?php echo $data['edited'] ?>">

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
			<div class="form-group">
				<label for="select-status">Status</label>
				<select name="status" class="form-control">
					<option value="1" <?php echo ($data['status'] == 1)?'selected':''?>>task completed</option>
					<option value="0" <?php echo ($data['status'] == 0)?'selected':''?>>task pending</option>
				</select>
			</div>	

			<button type="submit" class="btn btn-primary">Submit Form</button>
		</form>

	</div>
</div>
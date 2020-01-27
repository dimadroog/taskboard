<div class="row">
	<div class="col-lg-6 offset-lg-3 col-md-12">
		<h1><?php echo $title; ?></h1>

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

		<?php  ?>
		<div class="card mb-4 mt-4 bg-light">
			<div class="card-body">
				<h5 class="card-title">Login to Admin Panel</h5>

				<form action="/admin/login" method="post">
					<div class="form-group">
						<label for="input-login">Name <span class="text-danger">*</span></label>
						<input type="text" name="login" class="form-control p-2 <?php echo Admin::isHasError($errors, 'login') ?>" id="input-login" value="<?php echo $data['login'] ?>" placeholder="Your Name">
					</div>
					<div class="form-group">
						<label for="input-pass">Password <span class="text-danger">*</span></label>
						<input type="password" name="pass" class="form-control p-2 <?php echo Admin::isHasError($errors, 'pass') ?>" id="input-pass" value="<?php echo $data['pass'] ?>" placeholder="Your Email">
					</div>
					<button type="submit" class="btn btn-primary">Login</button>
				</form>

			</div>
		</div>

	</div>
</div>
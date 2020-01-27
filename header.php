<!DOCTYPE HTML>
<html lang="ru">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Taskbord</title>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	</head>
	<body>

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
			<div class="container">
				<a class="navbar-brand" href="/">TaskBoard</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="/task/create">Add Task</a>
						</li>
						<li class="nav-item">
							<?php if ($this->isAdmin()): ?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
										Admin
									</a>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="/admin">Admin Panel</a>
										<a class="dropdown-item" href="/admin/logout">Logout</a>
									</div>
								</li>

							<?php else: ?>
							<a class="nav-link" href="/admin/login">Login</a>
							<?php endif ?>
						</li>
					</ul>
				</div>
			</div>
		</nav>


		<div class="container">
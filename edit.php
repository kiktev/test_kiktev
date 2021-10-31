<?php

	namespace app;

	require_once('app/Controller.php');
	
	$obj = new Controller();
	$user = $obj->user;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/8c5f8983b2.js" crossorigin="anonymous"></script>
</head>
<body>

	<div class="wrapper">

		<div class="form edit_form">
			<div class="upload_img">					
				
				<label for="file-input">

					<form enctype="multipart/form-data" method="post">
						<input onchange="this.form.submit();" id="file-input" type="file" name="file" hidden />
						<input type="hidden" name="action" value="update_img" />
						<input type="hidden" name="id" value="<?= $user['id'] ?>" />
					</form>
					
					<span style='background-image: url(<?= "data/" . $user['img'] ?>)'>
						
					</span>
				</label>
			</div>
		</div>

		<form class="form edit_form" method="post">

			<span class="form_head">Редактирование</span>
			<input type="hidden" name="action" value="edit" />
			<input type="hidden" name="id" value="<?= $user['id'] ?>" />

			<div>
				<span>Имя*</span>
				<input class="name-input" type="text" name="name" value="<?= $user['name'] ?>"/>
				<span class="message" id="name-input-message"></span>
			</div>

			<div>
				<span>Фамилия*</span>
				<input class="lastName-input" type="text" name="lastName" value="<?= $user['lastName'] ?>">
				<span class="message" id="lastName-input-message"></span>
			</div>

			<div>
				<span>Телефон*</span>
				<input class="phone-input" type="text" name="phone" value="<?= $user['phone'] ?>"/>
				<span class="message" id="phone-input-message"></span>
			</div>

			<div>
				<span>Возраст*</span>
				<input class="age-input" type="text" name="age" value="<?= $user['age'] ?>"/>
				<span class="message" id="age-input-message"></span>
			</div>
			
			<button id="save" type="button">Редактировать</button>

			<a href="index.php">На главную</a>

		</form>



	</div>

	<script src="script.js"></script>

</body>
</html>
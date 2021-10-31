<?php

	namespace app;

	require_once('app/Controller.php');
	
	$obj = new Controller();
	$table = $obj->table;

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

		<form class="form" enctype="multipart/form-data" method="post">

			<span class="form_head">Заполните форму</span>
			<input type="hidden" name="action" value="add" />

			<div class="upload_img">					
				<input id="file-input" type="file" name="file" hidden />
				<label for="file-input"><span><i class="far fa-user"></i>Фото</span></label>
			</div>

			<div>
				<span>Имя*</span>
				<input class="name-input" type="text" name="name"/>
				<span class="message" id="name-input-message"></span>
			</div>

			<div>
				<span>Фамилия*</span>
				<input class="lastName-input" type="text" name="lastName">
				<span class="message" id="lastName-input-message"></span>
			</div>

			<div>
				<span>Телефон*</span>
				<input class="phone-input" type="text" name="phone"/>
				<span class="message" id="phone-input-message"></span>
			</div>

			<div>
				<span>Возраст*</span>
				<input class="age-input" type="text" name="age"/>
				<span class="message" id="age-input-message"></span>
			</div>
			
			<button id="save" type="button">Сохранить</button>

		</form>

		<div class="table">
			<div class="row">
				<span>Фотография</span>
				<span>Имя</span>
				<span>Фамилия</span>
				<span>Телефон</span>
				<span>Возраст</span>
				<span>Действия</span>
			</div>
			<?php foreach($table as $key=>$val) {?>
			<div class="row">
				<span><img src="<?= "data/" . $table[$key]['img'] ?>"></span>
				<span><?= $table[$key]['name'] ?></span>
				<span><?= $table[$key]['lastName'] ?></span>
				<span><?= $table[$key]['phone'] ?></span>
				<span><?= $table[$key]['age'] ?></span>
				<span>
					<form action="edit.php" method="get">
						<input type="hidden" name="action" value="edit" />
						<input type="hidden" name="id" value="<?= $table[$key]['id'] ?>" />
						<i onclick="$(this).parent().submit()" class="far fa-edit"></i>
					</form>

					<form method="post">
						<input type="hidden" name="action" value="delete"/>
						<input type="hidden" name="id" value="<?= $table[$key]['id'] ?>" />
						<input type="hidden" name="img" value="<?= $table[$key]['img'] ?>" />
						<i onclick="$(this).parent().submit()" class="far fa-trash-alt"></i>
					</form>	

					<form method="post">
						<input type="hidden" name="action" value="up"/>
						<input type="hidden" name="id" value="<?= $table[$key]['id'] ?>" />
						<input type="hidden" name="order" value="<?= $table[$key]['order_num'] ?>" />
						<i onclick="$(this).parent().submit()" class="fas fa-arrow-up"></i>
					</form>	

					<form method="post">
						<input type="hidden" name="action" value="down"/>
						<input type="hidden" name="id" value="<?= $table[$key]['id'] ?>" />
						<input type="hidden" name="order" value="<?= $table[$key]['order_num'] ?>" />
						<i onclick="$(this).parent().submit()" class="fas fa-arrow-down"></i>
					</form>	
								
				</span>
			</div>
			<?php } ?>
		</div>

	</div>

	<script src="script.js"></script>

</body>
</html>
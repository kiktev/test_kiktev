
var name_message = document.getElementById("name-input-message");
var lastName_message = document.getElementById("lastName-input-message");
var phone_message = document.getElementById("phone-input-message");
var age_message = document.getElementById("age-input-message");

var name_check = false;
var lastName_check = false;
var phone_check = false;
var age_check = false;

$(".name-input").keyup(function(){
			
	var this_val = $(this).val();
	
	if(this_val.length > 0) {
		name_check = true;
		name_message.style.display = 'none';
	}else{
		name_message.style.display = 'block';
		name_message.style.color = 'red';
		name_message.textContent= "Обязательное поле";
		name_check = false;
	}
	
});

$(".lastName-input").keyup(function(){
			
	var this_val = $(this).val();
	
	if(this_val.length > 0) {
		lastName_check = true;
		lastName_message.style.display = 'none';
	}else{
		lastName_message.style.display = 'block';
		lastName_message.style.color = 'red';
		lastName_message.textContent= "Обязательное поле";
		lastName_check = false;
	}
	
});

$(".phone-input").keyup(function(){
	
	var tel_reg = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
			
	var this_val = $(this).val();
	
	var phone_result = tel_reg.test(this_val);
	
	if (phone_result == true){
		
		phone_message.textContent="Номер телефона указано верно";
		phone_message.style.color = "green";
		phone_check = true;	

	}else{
		phone_message.textContent="Номер телефона указано не верно";
		phone_message.style.color = "red";
		phone_check = false;			
	}
	
});

$(".age-input").keyup(function(){
	
	this_val = $(this).val();

	age_result = Number.isInteger(Number(this_val));

	if (age_result == true && this_val != '') {
		age_message.textContent="Возраст указан верно";
		age_message.style.color = "green";
		age_check = true;	
	}else{
		age_message.textContent="Возраст указан не верно";
		age_message.style.color = "red";
		age_check = false;
	}
	
});

$('#save').click(function() {

	$(".name-input").keyup();
	$(".lastName-input").keyup();
	$(".phone-input").keyup();
	$(".age-input").keyup();

	if (name_check == true && lastName_check == true && phone_check == true && age_check == true) {
		$('.form').submit();
	}
});

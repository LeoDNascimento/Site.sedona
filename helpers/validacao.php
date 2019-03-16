<?php

function validar_nome($nome){
	return strlen($nome) >= 3 && strlen($nome) <= 255;
}

function validar_mensagem($mensagem){
	return strlen($mensagem) >= 5 && strlen($mensagem) <= 1000; 
}

function validar_budget($budget){
	return $budget == "0-15" || $budget == "15-50" || $budget == "50-100" || $budget == "100-250" || $budget == "250-500" || $budget == "500+";
}	

function validar_email($email){
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validar_cel($cel){
	//expressao regular para celular americano
	return is_numeric($cel);
}

function validar_endereço($endereco){
	return strlen($endereco) <= 5 && strlen($endereco) > 255;
}

function validar_services($services_types){
	//return isset($_POST['services_types'];
}
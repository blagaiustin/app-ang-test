<?php 

	include 'db/data.php';
	include 'db/connect.php';

	function validateUser(){
		if(
			isset($_POST['login']) && 
			isset($_POST['user-input']) && 
			isset($_POST['pass-input'])
		){
			// previne SQL injection, adica converteste
			// caracterele "cu probleme" (daca exista) la caractere speciale HTML
			$user = htmlentities($_POST['user-input']);
			$pass = htmlentities($_POST['pass-input']);
			// folosim acest director pentru a redirectiona utilizatorul
			// catre pagina lui din cont, pagina creata cand se conecteaza, de fiecare data
			$path_to_dir_accounts = "../../../accounts";

			// testeaza daca exista acest utilizator
			//am instantiat aici din cauza ca imi dadea eroare programul cand instantiam mai sus
			//Asta a fost singura solutie pe care am gasit-o.
			$obj = new Connect();
			if($obj->test_if_user_exists($user, $pass)){
				// salveaza continutul fiserului
				$cod_html = file_get_contents("../../frontend/crud/crud.html");
				// inlocuim --user cu numele utilizatorului in variabila $html
				$_html = str_replace('--user', $user, $cod_html);
				// inlocuim __user cu numele utilizatorului | folosit la deconectare
				$html = str_replace('__user', $user, $_html);
				// paranoia - testeaza daca directorul exista
				if(!file_exists($path_to_dir_accounts)){
					mkdir($path_to_dir_accounts);
				}
				// creaza pagina pentru utilizator, contul
				// 1. salvam codul php din fisierul crud.php
				$php = file_get_contents('crud.php');
				// 2. creaza numele fisierului, cu tot cu extensie 
				//    acest fisier va contine cod php, asadar extensia va fi php iar numele
				//    va fi acelasi cu numele utilizatorului
				$filename = $user.".php";
				$path_to_file_account = $path_to_dir_accounts . "/" . $filename;
				// 3. pune totul impreuna
				// 3.1 creaza fisierul
				// 3.2 adauga codul PHP si HTML in fisier
				// 3.3 redirectioneaza utilizatorul catre pagina lui din cont
				$data = $php . $html;
				file_put_contents($path_to_file_account, $data);
				header("Location: " . $path_to_file_account);
				exit();
			}
			else{
				// utilizatorul nu exista
				// il redirectionam inapoi la formularul de conectare
				header("Location: ../../../index.php");
			}
		}
	}
	validateUser();

	// doamne fereste sa "ajungem" aici,
	// pentru ca, implicit il vom redirectiona 
	// inapoi la formularul de conectare
	header("Location: ../../../index.php");

?>
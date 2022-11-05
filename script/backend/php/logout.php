<?php 

function disconnect(){
	if(
		isset($_POST['user-logout']) && 
		isset($_POST['user-name'])
	){
		// salveaza numele fisierului 
		// utilizatorului ce vrea sa se deconecteze
		$filename = $_POST['user-name'];
		// construieste calea pana la fisierul utilizatorului
		$path = "../../../accounts/" . $filename . ".php";
		// paranoia - testam daca fisierul exista, altfel vom avea o eroare
		if(file_exists($path)){
			// paranoia - stergem mai intai continutul fisierului
			file_put_contents($path, "");
			// testam daca fisierul a fost sters
			if(unlink($path)){
				// acum este timpul sa il redirectionam
				// pe utilizator in pagina de conectare
				header("Location: ../../../index.php");
				exit();
			}
			// paranoia - testam pana ce acest fisier va fi sters
			// unlink returneaza false daca nu la sters si cu operatorul de negatie
			// convertim false la true ( !false => true )... evident si invers
			// while se va opri din executie daca functia unlink va 
			// returna true si cu operatorul de negatie convertim true la false
			// !true => false
			while(!unlink($path));
			header("Location: ../../../index.php");
			exit();
		}
	}
}
disconnect();

// paranoia
// header("Location: ../../../index.php");
exit();

?>
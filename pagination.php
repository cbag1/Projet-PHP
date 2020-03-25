<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>exo1</title>
	</head>
	<body BGCOLOR="green" >
	<fieldset>
	<center>
	<h1> <u>EXERCICE 1 </u></h1>
	<form method="post" >
		Entrez une valeur 
		<input placeholder="saisir n" type="texte" name="n" size="12" required ><br><br>
	    <input type="submit" value="Validez" style="margin-left:50px;">
	</center>
	<fieldset>
	</body>
	</form>
	<?php
	session_start();
		if (isset($_POST['n']) and is_numeric($_POST['n'])){
			if(preg_match('/^[0-9]*$/', $_POST['n'])){

			$T=array();
			if (!empty($_POST)){
				$n = $_POST['n'];
				$k=0;
				$s=0;
			if(($_POST['n']>10)){
					for ($i=2; $i <=$n ; $i++) {
							$j=2;
						while (($i%$j)!=0){
								$j=$j+1;
						}
						if($i==$j) {
							$T[]=$i;						
						}		
					}
		function moyenne($tab){
			$moyenne=0;
			for ($i=0; $i < count($tab); $i++) { 
				$moyenne+=$tab[$i];
			}
			return $moyenne/count($tab);
		}
		$moy=moyenne($T);
		echo '<br>';
		echo "la moyenne=$moy";

	
		   $tab=array("inferieur"=>array(), "superieur"=>array());

		   // Affecter des valeurs au clé inferieure 
				echo '<br>';
				for ($i=0; $i < count($T); $i++) {
					if ($T[$i]<$moy){
					 $tab["inferieur"][]=$T[$i];

					}
				}
				// Affecter des valeurs au clé superieure 
		
				for ($i=0; $i < count($T); $i++) {
					if ($T[$i]>$moy){
					$tab["superieur"][]=$T[$i];

					}
				}
				
				$_SESSION['TabSup']=$tab['superieur'];
				$_SESSION['TabInf']=$tab['inferieur'];
		
			}
		
			else{
					echo "saisie incorrecte";
		}
		}
		}

	echo"</br>'Les nombres prémiers supérieur à la moyenne sont:</br> ";
		if(isset($_SESSION['TabSup'])){
			$taille_tableau=count($_SESSION['TabSup']);
			$nombre_max_page=100;
			$page_left_right=5;
			$nombre_page= $taille_tableau/$nombre_max_page;
			$dernier_page=ceil($taille_tableau/$nombre_max_page);
		
			
			if (isset($_GET['page'])) {
				# code...
				$_GET['page']=$page;
			}
			else{
				$page=1;
			}
			if($page<1){
				$page=1;
			}
			elseif($page>$dernier_page){
				$page=$dernier_page;
			}
			echo"<table border=1 id='left'><tr>";
			for ($i=($page-1)*$nombre_max_page; $i<($page*$nombre_max_page) ; $i++){ 
				# code...
				if($i>$taille_tableau){
				break;
				}
				else{
					if (($i!=(($page-1)*$nombre_max_page)) && ($i%10==0)) {
						# code...
						echo"</tr> <br/> <tr>";
					}
					echo"<td>".$_SESSION['TabSup'][$i]."</td>";
				}
			}
			echo"</tr> </table> <div class=pagination>";
			$pagination="";
			if($dernier_page>1){
			   if ($page>1) {
				   # code...
				   $precedent=$page-1;          
				   $pagination.="<a href='pagination.php?page=".$precedent." id=pg'>Precedent</a>";
					for($i=$page-$page_left_right; $i<$page;$i++){
						if($i>0){
							$pagination.="<a href='pagination.php?page=".$i."'>".$i."</a>";
						}
					}
			   }
			   $pagination.="<span>".$page."</span>";
			   for($i=$page+1; $i<$dernier_page; $i++){
				$pagination.="<a href='pagination.php?page=".$i."'>".$i."</a>";
				if($i>=$page+$page_left_right){
				break;
				}
			   }
			   if($page!=$dernier_page){
				   $suivant=$page+1;
				   $pagination.="<a href='pagination.php?page=".$suivant." id=pg'>Suivant</a>";
			   }
			}
			echo $pagination;
			echo "</div>";
	
		}
	   

		echo"</br>'Les nombres prémiers inferieurs à la moyenne sont:</br> ";
		if(isset($_SESSION['TabSup'])){
			$taille_tableau=count($_SESSION['TabSup']);
			$nombre_max_page=100;
			$page_left_right=5;
			$nombre_page= $taille_tableau/$nombre_max_page;
			$dernier_page=ceil($taille_tableau/$nombre_max_page);
	
			if (isset($_GET['page'])) {
				$_GET['page']=$page;
			}
			else{
				$page=1;
			}
			if($page<1){
				$page=1;
			}
			elseif($page>$dernier_page){
				$page=$dernier_page;
			}
			echo"<table border=1 id='left'><tr>";
			for ($i=($page-1)*$nombre_max_page; $i<($page*$nombre_max_page) ; $i++){ 
			
				if($i>$taille_tableau){
				break;
				}
				else{
					if (($i!=(($page-1)*$nombre_max_page)) && ($i%10==0)) {
		
						echo"</tr> <br/> <tr>";
					}
					echo"<td>".$_SESSION['TabInf'][$i]."</td>";
				}
			}
			echo"</tr> </table> <div class=pagination>";
			$pagination="";
			if($dernier_page>1){
			   if ($page>1) {
				   # code...
				   $precedent=$page-1;          
				   $pagination.="<a href='pagination.php?page=".$precedent." id=pg'>Precedent</a>";
					for($i=$page-$page_left_right; $i<$page;$i++){
						if($i>0){
							$pagination.="<a href='pagination.php?page=".$i."'>".$i."</a>";
						}
					}
			   }
			   $pagination.="<span>".$page."</span>";
			   for($i=$page+1; $i<$dernier_page; $i++){
				$pagination.="<a href='pagination.php?page=".$i."'>".$i."</a>";
				if($i>=$page+$page_left_right){
				break;
				}
			   }
			   if($page!=$dernier_page){
				   $suivant=$page+1;
				   $pagination.="<a href='Untitled-1.php?page=".$suivant." id=pg'>Suivant</a>";
			   }
			}
			echo $pagination;
			echo "</div>";
	
		}
	   
	}



		?>
		 </body>
		</html>

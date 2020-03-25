<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1><exoss-1></h1>
<form method="POST">
<p>afficher un varriabe a:<input type="text" name="a"> </p>
<p><input type="submit" name="valider" value="valider"> </p>
</form>
<?php
$T1=array();
if(isset($_POST["valider"])){
    if(!empty($_POST["a"])){
        $a=$_POST["a"];
        if($a>10000){
            // echo $a;
            for($i=2;$i<=$a;$i++){
                $c=0;
                for($j=2;$j<$i;$j++){
                    if($i%$j==0){
                        $c++;
                    }
                }
                if($c==0){
                    $T1[]=$i;
                }
            }
        }
    }
}
$T=array();
function Moyenne($T){
    $somme=1;
    $moyenne;
    for($i=0; $i <count($T); $i++){
        $somme=$somme+$T[$i];
    }
    $moyenne=$somme/count($T);
    return $moyenne;
}
$moy=Moyenne($T1);
echo $moy;
for ($i=0; $i <count($T1) ; $i++){
    if (($T1[$i]) < $moy){
        $T['inferieur'][]=$T1[$i];
    }else{
        $T['superieur'][]=$T1[$i];
    }
} echo "inferieur";
foreach($T["inferieur"] as $key=>$value){
    echo $value;
}echo "superieur";
foreach($T["superieur"] as $key=>$value){
    echo $value;
}
  echo "<h1>les nombres premiers inferieurs a la Moyenne</h1>";
  $test=0;
  echo"<table border=1>";
  for($i=0; $i<count($T['inferieur']); $i++){
      if($test==0){
          echo "<tr>";
          echo "<td>".$T['inferieur'][$i]."</td>";
          $test++;
      }else{
          if($test==10){
              echo "<td>".$T['inferieur'][$i]."</td>";
              echo "</tr>";
              $test=0;
          }else{
            echo "<td>".$T['inferieur'][$i]."</td>";
            $test++;
          }
      }
  }
  echo "</table>";
  echo "<h1>les nombres premiers superieurs a la Moyenne<h1>";
  $test=0;
  echo"<table border=1>";
  for($i=0; $i<count($T['superieur']); $i++){
      if($test==0){
          echo "<tr>";
          echo "<td>".$T['superieur'][$i]."</td>";
         $test++;
      }else{
          if($test==10){
              echo "<td>".$T['superieur'][$i]."</td>";
              echo "</tr>";
              $test=0;
          }else{
            echo "<td>".$T['superieur'][$i]."</td>";
            $test++;
          }
      }
  }
  echo "</table>";
?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXO 1</title>
</head>
<body>
    <?
        include('fonctions.php');
    ?>
    <form action="" method="post">
        <select name="langue" id="">
            <option value="francais">Francais</option>
            <option value="anglais">Anglais</option>
        </select>
        <input type="submit" name="submit" value="Calculer">
    </form>
    <?
       if (isset($_POST['submit'])) {
            
        $T1=[
            'francais'=>['Janvier','Fevrier', 'Mars', 'Avril','Mai','Juin','Juillet','Aout',
            'Septembre','Octobre','Novembre','Decembre'],
            
            'anglais'=>['January','February', 'March', 'April','May',
            'June','July','August','September','October','November','December']
        ];
        if(isset($_POST['submit'])){
            if ($_POST['langue']=='francais'){
                affichecalendar($T1['francais']);   
              }
              else{
                affichecalendar($T1['anglais']);
              }
        }

       }
      

    ?>
   
</body>
</html>
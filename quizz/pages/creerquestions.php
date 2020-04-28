<?php
require_once("./traitement/fonctions.php");
if (isset($_POST['submit'])) {

    $question = array( // Ajouter seulement du question de ses points
        'question' => $_POST['question'],
        'nbpoints' => $_POST['nbrpoint'],
        'typeReponse' => $_POST['tresp']
    );
    if ($_POST['tresp'] == "rmult" || $_POST['tresp'] == "rsimple") {
        $question['nbreponses'] = (int) ($_POST['nbrep']) + 1;
        for ($i = 0; $i <= (int) $_POST['nbrep']; $i++) {
            if (isset($_POST["rep_$i"])) {
                $tabreponses[] = $_POST["rep_$i"];
            }
        }
        $question['reponses'] = $tabreponses;
        if ($_POST['tresp'] == "rmult") {
            $question['IndexRepValides'] = $_POST['checked'];
        } else {
            $question['IndexRepValides'] = $_POST['repsimple'];
        }
    } elseif ($_POST['tresp'] == "rtexte") {
        $question['ReponseTexte'] = $_POST['rep_texte'];
    }

    AjoutData('questions', $question);



    // var_dump($question);

    // Test Reponse correctss
    // foreach ($_POST['checked'] as $key => $value) {
    //     // echo $value;
    //     // echo "<br/>";
    //     echo $question['reponses'][$value];
    // }
}
?>

<div class="creer-quest">
    <form action="" method="post" id="form-question">
        <div class="ligne">
            <label for="question">Questions</label>
            <textarea name="question" cols="30" rows="10" error="error-0"></textarea>
            <span id="error-0"></span>
        </div>

        <div class="ligne">
            <label for="nbpoints">Nbre de Points</label>
            <input type="number" name="nbrpoint" id="nbrpoint" min="0" error="error-1">
            <span id="error-1"></span>
        </div>

        <div class="ligne">
            <label for="tresp">Type de Réponse</label>
            <select name="tresp" id="tresp" onchange="choix()">
                <option value="rmult">Réponses Multiples</option>
                <option value="rsimple">Réponse Simple</option>
                <option value="rtexte">Réponse Texte</option>
            </select>
            <input type="button" onclick="addchamp()" value="+">
            <input type="hidden" name="nbrep" id="nbrep" />
        </div>
        <div id="inputs">

        </div>
        <div>
            <button type="submit" name="submit" id="submit">Enregistrer</button>
        </div>
    </form>
</div>

<script>
    var nbRep = 0;

    function choix() {
        nbRep = 0;
        document.getElementById('inputs').innerHTML = "";
    }


    function suppdiv(n) {
        alert(n);
    }

    function addchamp() {

        document.getElementById('nbrep').value = nbRep;
        var choix = document.getElementById('tresp').value;
        var divInputs = document.getElementById('inputs');
        var newInput = document.createElement('div');
        if (choix === "rmult") {
            newInput.innerHTML = `
            <input type="text" name="rep_${nbRep}"/>
            <input type="checkbox" name="checked[]" value="${nbRep}"/>
            <input type="button" value="X" id="nbRep" onclick="suppdiv(${nbRep})" /> 
            `;

        } else if (choix === "rsimple") {

            newInput.innerHTML = `
            <input type="text" name="rep_${nbRep}"/>
            <input type="radio" name="repsimple" value="${nbRep}"/>
            <input type="button" value="X" id="nbRep" onclick="suppdiv(${nbRep})" /> 
            `;
        } else {
            newInput.innerHTML = `
            <input type="text" name="rep_texte"/>
            `;
        }
        divInputs.appendChild(newInput);
        nbRep++;
    }



    function suppInput(n) {
        var target = document.getElementById(n);
        target.remove();
    }
    // ===============================================================
    //                Validation des champs Inputs aprés submit
    // ===============================================================


    document.getElementById("form-question").addEventListener("submit", function(e) {


        var error = false;
        for (input of inputs) {

            if (input.hasAttribute("error")) {
                var idDivError = input.getAttribute("error");
                if (!input.value) {
                    document.getElementById(idDivError).innerText = "Ce champ est obligatoire";
                    error = true;
                }

            }
        }
        // var idpwd = document.getElementById('pwd').value;
        // var idpwd1 = document.getElementById('pwd1').value;

        // if (idpwd != idpwd1) {
        //     document.getElementById('error-4').innerText = "Les Mots de passe sont differents";
        //     alert("Errror Mot de Passe");
        //     error = true;
        // }


        if (error) {
            e.preventDefault();
            return false;
        }

    });

    // var formValid = document.getElementById('submit');
    // var question = document.getElementById('question');
    // var missquestion = document.getElementById('missquestion');

    // formValid.addEventListener('click', validation);

    // function validation(event) {

    //     if (question.value=="") {
    //         event.preventDefault();
    //         alert(' Tu te foutait de ma gueule donc');
    //     }else{
    //         alert("Cool");
    //     }
    //     event.preventDefault();
    // }
</script>
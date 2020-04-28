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
            <textarea name="question" cols="30" rows="10" id="question"></textarea>
            <span id="error-question"></span>
        </div>

        <div class="ligne">
            <label for="nbpoints">Nbre de Points</label>
            <input type="number" name="nbrpoint" id="nbrpoint" min="0" error="error-0">
            <span id="error-0"></span>
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
            <span id="error-checked"></span>
            <button type="submit" name="submit" id="submit">Enregistrer</button>
        </div>
    </form>
</div>

<script>
    // ===============================================================
    //            Gestion des choix et de la génération des inputs
    // ===============================================================

    var nbRep = 0;

    function choix() {
        nbRep = 0;
        document.getElementById('inputs').innerHTML = "";
        document.getElementById('error-checked').innerText = "";
    }


   

    function addchamp() {
        var IndiceError = nbRep + 1;
        document.getElementById('nbrep').value = nbRep;
        var choix = document.getElementById('tresp').value;
        var divInputs = document.getElementById('inputs');
        var newInput = document.createElement('div');
        newInput.setAttribute("id", "row_", +nbRep);
        if (choix === "rmult") {
            newInput.innerHTML = `
            <input type="text" name="rep_${nbRep}" error="error-${IndiceError}" class="input_gen"/>
            <input type="checkbox"  name="checked[]" value="${nbRep}" class="check_gen" />
            <input type="button" value="X" id="nbRep" onclick="suppdiv(${nbRep})" /> 
            <span id="error-${IndiceError}"></span>
            `;

        } else if (choix === "rsimple") {

            newInput.innerHTML = `
            <input type="text" name="rep_${nbRep}" error="error-${IndiceError}" class="input_gen"/>
            <input type="radio" name="repsimple" value="${nbRep}" class="radio_gen" />
            <input type="button" value="X" id="nbRep" onclick="suppdiv(${nbRep})" /> 
            <span id="error-${IndiceError}"></span>
            `;
        } else {
            newInput.innerHTML = `
            <input type="text" name="rep_texte"/>
            `;
        }
        divInputs.appendChild(newInput);
        nbRep++;
    }

    function suppdiv(n) {
        var target = document.getElementById("row_", n);
        target.remove();
    }

    function suppInput(n) {
        var target = document.getElementById(n);
        target.remove();
    }
    // ===============================================================
    //                Validation des champs Inputs aprés submit
    // ===============================================================

    const inputs = document.getElementsByTagName("input");
    for (input of inputs) {
        input,
        addEventListener("keyup", function(e) {
            if (e.target.hasAttribute("error")) {
                var idDivError = e.target.getAttribute("error");
                document.getElementById(idDivError).innerText = "";
            }
        })
    }

    document.getElementById("form-question").addEventListener("submit", function(e) {

        var choix = document.getElementById('tresp').value;
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

        if (document.getElementById('question').value == "") {
            document.getElementById('error-question').innerHTML = "Ce champ est obligatoire";
            error = true;
        }
        const radios = document.querySelectorAll('input[type="radio"]:checked');
        if (choix == "rsimple" && radios.length == 0 && nbRep > 0) {
            error = true;
            document.getElementById('error-checked').innerText = "*Veuillez cocher la bonne réponse";
        }

        const checkbox = document.querySelectorAll('input[type="checkbox"]:checked');
        if (choix == "rmult" && checkbox.length < 2 && nbRep > 0) {
            error = true;
            document.getElementById('error-checked').innerText = "*Veuillez cocher 2 réponses au moins";
        }


        if (error) {
            e.preventDefault();
            return false;
        }

    });
</script>
<div class="creer-quest">
    <form action="" method="post">
        <div class="ligne">
            <label for="question">Questions</label>
            <textarea name="question" id="question" cols="30" rows="10"></textarea>
        </div>

        <div class="ligne">
            <label for="nbpoints">Nbre de Points</label>
            <input type="number" name="nbrpoint" id="nbrpoint" min="0">
        </div>

        <div class="ligne">
            <label for="tresp">Type de Réponse</label>
            <select name="tresp" id="tresp" onchange="choix()">
                <option value="rmult" >Réponses Multiples</option>
                <option value="rsimple" >Réponse Simple</option>
                <option value="rtexte">Réponse Texte</option>
            </select>
            <input type="button" onclick="addchamp()" value="+">
        </div>
        <div id="inputs">

        </div>
    </form>
</div>

<script>
    function choix(){
        document.getElementById('inputs').innerHTML="";
    }
    function addchamp() {
        var choix = document.getElementById('tresp').value;
        var divInputs = document.getElementById('inputs');
        var newInput = document.createElement('div');
        if (choix === "rmult") {
            newInput.innerHTML = '<input type="text"/><input type="checkbox"/><button>X</button> ';
        } else if (choix === "rsimple") {

            newInput.innerHTML = '<input type="text"/><input type="radio" name="radiotext"/><button>X</button> ';
        } else {

            newInput.innerHTML = '<input type="text"/><button>X</button> ';
        }
        divInputs.appendChild(newInput);
    }
</script>
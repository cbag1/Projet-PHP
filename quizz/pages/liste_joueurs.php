<div>
    <div class="show-players-title"> LISTE DES JOUEURS PAR SCORE</div>
    <div class="show-players">
        <table class="tabjoueurs">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $users = dump_profile('joueur');
                // echo count($users);
                if (isset($_GET['pindex'])) {
                    $i = (int) $_GET['pindex'];
                } else {
                    $i = 0;
                }
                $j = -1;
                if (($i - 5) >= 0 && $i != 0) {
                    $j = $i - 5;
                }
                foreach ($users as $key => $value) {
                    // echo $key,"    ";
                    if ($key >= $i) {
                        echo '<tr>';
                        echo '<td>' . $value['nom'] . '</td>';
                        echo '<td>' . $value['prenom'] . '</td>';
                        echo '<td>' . $value['score'] . ' pts</td>';
                        echo '</tr>';

                        if ($key == ($i + 5) || count($users) == ($key + 1)) {
                            $i = $key;
                            break;
                        }
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    <div class="paginer">
        <div class="pagination" style="float: right">
            <?php
            if (count($users) - ($i + 1) != 0) {
                echo '<a href="index.php?lien=accueil&menu=liste-joueur&pindex=' . $i . '"  name="btn_submit">Suivant</a>';
            }
            ?>
        </div>
        <div class="pagination">
            <?php
            if ($j >= 0) {
                echo '<a href="index.php?lien=accueil&menu=liste-joueur&pindex=' . $j . '"  name="btn_submit">Precedent</a>';
            }
            ?>
        </div>
    </div>
</div>
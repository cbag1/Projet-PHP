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
                <!-- <tr>
                    <td>GOUDIABY</td>
                    <td>Cheikh Babacar</td>
                    <td>1 022 pts</td>
                </tr> -->
                <?php
                    $users=file_get_contents('./data/utilisateur.json');
                    $users=json_decode($users,true);
                    foreach ($users as $value) {
                        echo '<tr>';
                            echo '<td>'.$value['nom'].'</td>';
                            echo '<td>'.$value['prenom'].'</td>';
                            echo '<td>'.$value['score'].' pts</td>';
                        echo '</tr>';
                    }
                ?>
               
            </tbody>
        </table>
    </div>
    <div>
       <button type="submit" class="player-form" name="btn_submit" >Suivant</button>
    </div>
</div>
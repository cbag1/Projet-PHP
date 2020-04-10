foreach ($_SESSION['donnees_recup']['prenom'] as $prenom)
                    {
                        ?>
                            <td>
                                <?= $prenom ?>
                            </td>
                        <?php
                    }

                    foreach ($_SESSION['donnees_recup']['adresse'] as $adresse)
                    {
                        ?>
                            <td>
                                <?= $adresse ?>
                            </td>
                        <?php
                    }

                    foreach ($_SESSION['donnees_recup']['numero'] as $numero) {
                        ?>
                            <td class="numero">
                                <?= $numero ?>
                            </td>
                        <?php
                    }

                    foreach ($_SESSION['donnees_recup']['genre'] as $genre)
                    {
                        ?>
                            <td>
                                <?= $genre ?>
                            </td>
                        <?php
                    }

                    foreach ($_SESSION['donnees_recup']['satisfaction'] as $satisfaction)
                    {
                        ?>
                            <td>
                                <?= $satisfaction ?>
                            </td>
                        <?php
                    }
                    
                    foreach ($_SESSION['donnees_recup']['langue'] as $langue)
                    {
                        ?>
                            <td>
                                <?php
                                    foreach ($langue as $val) {
                                        $val = substr($val,0,1);
                                        echo $val." ,";
                                    }
                                ?>
                            </td>
                        <?php
                    }
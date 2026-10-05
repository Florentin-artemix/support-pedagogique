<?php
				
                require('connexion.php');
                
                // $email=$_POST['email'];
                $search=$_POST['search'];
                
                 //si le $niveau =Q ou T ou TS
                        $requete=" SELECT * 
                                        FROM support		  
                                        WHERE idPromo like '%$search%'
                                         ";
                        

                              
                $les_filieres=$pdo->query($requete);
                // $les_filieres contients le résultat de la requete :SELECT * FROM FILIERE	
                
                $toute_les_filieres=$les_filieres->fetchAll();
                // la methode fetchAll retourne toutes les lignes de la table filière
                
                
                                  

                    
            ?>	
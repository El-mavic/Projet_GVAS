<?php
/*Connaitre l'inverse des mots
$mot = strtolower (readline('veuillez entrer un mot : '));
$reverse = strrev($mot);
if($reverse === $mot) {
    echo 'Ce mot est un palindrome';
}else
echo'Ce mot n\'est pas un palindrome';
*/

/*$somme = 0;
$notes = [13, 10, 20, 2];
$sdt = array_sum($notes);
$taille = count($notes);

echo 'Vous avez '. round($sdt/$taille, 2) . ' de moyenne';

while(true){
    $user = strtolower(readline('Veuillez saisir un mot : '));
    if($user == ''){
        exit('Le programme est terminer');
    }
    
    $reset =strrev($user);
    if($reset === $user){
        echo"Ce mot est palindrome \n";
    }else
    echo "Ce mot n'est pas un palindrome \n";
}*/
/*for ($i = 1; $i <= 3; $i++) {
    $user = strtolower (readline("Veuillez saisir un mot : "));
    if($user == ""){
        echo "Vous avez rien saisie";
        break;
    }
$recupere = strrev($user);
if($recupere === $user){
    print("Oui ce mot est palindrome\n");
}else{
    print("Non c'est faux\n");
}

}*/

function multiplication()
{
    while (true) {
        $moi = trim(readline('Voulez-vous jouer à se jeux oui ou non : '));
        if ($moi === 'oui') {
            $user = trim(readline('tu veux la table de multiplication de combien?  : '));
            for ($i = 0; $i <= 12; $i++) {
                $affiche .= ($user . "x" . $i . "=" . $user * $i . "\n");
            }
            echo $affiche;
        } elseif ($user === 'non') {
            return false;
        } else
            echo "soit c'est oui ou non" . "\n";
    }
}

$resultat = multiplication();
var_dump($resultat);

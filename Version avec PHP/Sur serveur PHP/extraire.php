<script>
    function suppr(jour){
        if(confirm("Voulez-vous vraiment supprimer les réponses du "+ jour +" ?")) {
            document.location.href="./suppr.php?date="+jour; 
        }
    }
</script>
<?php
include_once 'openbase.php';
$listsoin = array(".","ALIMENTATION - Aide au repas partiel","ALIMENTATION - Aide au repas complet","HYGIENE - Habillage/déshabillage","HYGIENE - Surveillance lavage","HYGIENE - Change du malade partiel","HYGIENE - Change du malade complet","ELIMINATION - Pose bassin urinal","ELIMINATION - Changement de poche","LOCOMOTION - Installation (lit, fauteuil, WC)","LOCOMOTION - Aide au lever/coucher","LOCOMOTION - Aide dans déplacements","SECURITE - Installation barrières protection","SOIN TECH. - Surveillance abord vasculaire","SOIN TECH. - Grand pansement","SOIN TECH. - Moyen pansement","SOIN TECH. - Petit pansement","SOIN EDUC. - Information malade","SOIN EDUC. - Information famille","SOIN EDUC. - Education malade/famille","SOIN EDUC. - Relation d'aide","SOIN EDUC. - Evaluation éducation patient");

$date = $_GET['date'];
if (empty($date)){
    $sql = 'SELECT DISTINCT `date` FROM `plateforme_as`';
    $res = $conn->query($sql);
    echo "<h1>Date de l'exercice</h1>";
    foreach( $res as $row ) {
        echo "<a href='extraire.php?date=\"". $row['date'] ."\"'>". $row['date'] . "</a> ⇨ ";
        // echo "<a href='suppr.php?date=\"". $row['date'] ."\"'>". Supprime . "</a><br />";
        echo "<button onclick=\"suppr('{$row['date']}')\">Supprime</button><br>";
    }
}else{
    $sql = 'SELECT * FROM `plateforme_as` WHERE `date` = ' . $date;
    $res = $conn->query($sql);
    echo "<a href='./extraire.php'>Retour</a><br>";
    foreach( $res as $row ) {
        echo "<h1>Candidat : </h1>";
        echo "<em> ${row['nom']}.</em><br />";
        echo "<h2>patients : </h2>";
        $reponse = json_decode($row['reponse']);
        $patients = $reponse->patients;
        // print_r($patients[0]->dg[0]);
        // print_r("<br>");
        foreach( $patients as $pat ) {
            echo "<h3> $pat->civilite $pat->prenom $pat->nom.</h3>";
            echo "<b>Adresse</b><br>$pat->adresse $pat->codepost $pat->ville.<br>";
            echo "<b>téléphone</b><br>$pat->tel.<br>";
            echo "<b>Contact</b><br>$pat->contact.<br>";
            echo "$pat->contact_email / $pat->contact_tel .<br>";
            echo "<b>Médecin</b><br>$pat->medecin.<br>";
            echo "$pat->medecin_email / $pat->medecin_tel.<br>";
            echo "<h4>Macrocible</h4>";
            echo "<b>Macrocible maladie</b><br>$pat->mac_maladie.<br>";
            echo "<b>Macrocible traitement</b><br>$pat->mac_trait.<br>";
            echo "<b>Macrocible vécu</b><br>$pat->mac_vecu.<br>";
            echo "<b>Macrocible environement</b><br>$pat->mac_env.<br>";
            echo "<b>Macrocible devenir</b><br>$pat->mac_dev.<br>";
            echo "<h4>Pancarte</h4>";
            $heures = $pat->dg;
            if (!empty($heures)){
                foreach( $heures as $heure ) {
                    echo "<b>A {$heure->heure} heure : </b>FR = {$heure->fr} Urine = {$heure->urine} ";
                    echo "FC = {$heure->fc} TA = {$heure->ta} Température = {$heure->t}.<br>";
                }
            }
            $lignes = $pat->soin;
            echo "<h4>Diagramme de soin</h4>";
            if (!empty($lignes)){
                foreach( $lignes as $ligne ) {
                    echo "<b>Le {$ligne->date} à {$ligne->heure} <br>";
                    if($ligne->realise == "oui") {
                        $r = "Réalisé";
                    } else {
                        $r = "Non réalisé";

                    }
                    echo "{$r} :</b> {$listsoin[$ligne->soin]} <br><b>Observation :</b> {$ligne->obs}.<br>";
                }
            }
            $lignes = $pat->trans;
            echo "<h4>Transmissions</h4>";
            if (!empty($lignes)){
                foreach( $lignes as $ligne ) {
                    echo "<b>Le {$ligne->date} <br>";
                    echo "Cible </b>: {$ligne->cible}.<br><b>Donnée :</b> {$ligne->données}.<br><b>Action :</b> {$ligne->action}.<br><b>Résultat :</b> {$ligne->résultat}.<br>";
                }
            }
        }
    
    }
}


?>
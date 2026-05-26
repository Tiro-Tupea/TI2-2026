<?php
# model/guestbookModel.php
/********************************
 * Model de la page livre d'or
 *******************************/

// INSERTION d'un message dans le livre d'or

/**
 * @param PDO $db
 * @param string $firstname
 * @param string $lastname
 * @param string $usermail
 * @param string $phone
 * @param string $postcode
 * @param string $message
 * @return bool
 * Fonction qui insère un message dans la base de données 'ti2web2026' et sa table 'guestbook'
 * Renvoie true si l'insertion a réussi, false sinon
 * Une requête préparée est utilisée pour éviter les injections SQL
 * Les données sont échappées pour éviter les injections XSS (protection backend)
 */
function addGuestbook(PDO $db,
                    string $firstname,
                    string $lastname,
                    string $usermail,
                    string $phone,
                    string $postcode,
                    string $message
): bool
{
    // traitement des données backend (SECURITE)
    $useremail=filter_var($useremail,FILTER_VALIDATE_EMAIL); 
    $firstname = htmlspecialchars(trim(strip_tags($firstname)));
    $lastname = htmlspecialchars(trim(strip_tags($lastname)));
    $phone = htmlspecialchars(trim(strip_tags($phone)));
    $postcode = htmlspecialchars(trim(strip_tags($postcode)));
    $message=htmlspecialchars(trim(strip_tags($message)));
    
    // on envoie false si il y a une seule erreur
      if($useremail===false       ||
    strlen($useremail)>100        ||
    empty($firstname)             ||
    strlen($fitsname)<5           ||
    strlen($full_name)>100        ||
    empty($lastname)              ||
    strlen($lastname)<5           ||
    strlen($lastname)>100         ||
    empty($phone)                 ||
    strlen($phone)>2              ||
    empty($postcode)              ||
    strlen($postcode)>5           ||
    empty($message)               ||
    strlen($message)<5            ||
    strlen($message)>500   
    ) return false;

    // préparation de la requête avec des marqueurs non nommés
    $stmt = $db->prepare("INSERT INTO `commentaire` (`useremail`, `firstname`, `lastname`, `phone`, `postcode`,`message`) VALUES (?,?,?,?,?,?);");
    // attribution des variables
    // $stmt->bindValue(1,$email,PDO::PARAM_STR);
    // $stmt->bindValue(2,$full_name);
    // $stmt->bindValue(3,$title);
    // $stmt->bindValue(4,$text_comment);

    // insertion
    $insert = $stmt->execute([$useremail,$firstname,$lastname,$phone,$postcode,$message]);
    // bonne pratique
    $stmt->closeCursor();
    // return envoi true si réussi, false en cas d'échec
    return $insert;
    // si pas de données complètes ou ne correspondant pas à nos attentes, on renvoie false
    return false;
   
}

/***************************
 * Sans le Bonus Pagination
 **************************/

// SELECTION de messages dans le livre d'or par ordre de date croissante
/**
 * @param PDO $db
 * @return array
 * Fonction qui récupère tous les messages du livre d'or par ordre de date croissante
 * venant de la base de données 'ti2web2026' et de la table 'guestbook'
 * Si pas de message, renvoie un tableau vide
 */
function getAllGuestbook(PDO $db): array
{
    // try catch
    // requête
    $stmt = $db->query("SELECT * FROM `gustbook` ORDER BY `post_date` DESC");
    // recupération des resultats en fetch_assoc (voir connexion)
    $result = $stmt->fetchAll();
    // bonne pratique
    $stmt->closeCursor();
    // si la requête a réussi,
    // bonne pratique, fermez le curseur
    // renvoyer le tableau de(s) message(s)
    return $result;
}

/**************************
 * Pour le Bonus Pagination
 **************************/

// SELECTION du nombre total de messages
/**
 * @param PDO $db
 * @return int
 * Fonction qui compte le nombre total de messages dans la table 'guestbook'
 */

function getNbTotalGuestbook(PDO $db): int
{
    $stmt = $db->query("SELECT COUNT(*) FROM `guestbook`");
    $nb = (int) $stmt->fetchColumn();
    $stmt->closeCursor();
    
    // bonne pratique, fermez le curseur,
    // renvoyez le nombre total de messages
    return $nb;

}

// SELECTION de messages dans le livre d'or par ordre de date croissante
// en lien avec la pagination
/**
 * @param PDO $db
 * @param int $pageActu = 1
 * @param int $limit = 5
 * @return array
 * Fonction qui récupère les messages du livre d'or par ordre de date croissante
 * venant de la base de données 'ti2web2026' et de la table 'guestbook'
 * en utilisant une requête préparée (injection SQL), n'affiche que les messages
 * de la page courante
 */
function getGuestbookPagination(PDO $db, int $pageActu=1, int $limit=5): array
{
    // Requête préparée obligatoire !
    // Le $offset et le $limit sont des entiers, il faut donc les passer
    // en paramètres de la requête préparée en tant qu'entiers !
    // si la requête a réussi,
    // bonne pratique, fermez le curseur
    // renvoyer le tableau de(s) message(s) (vide si pas de résultats)
    // requête prépare
    $stmt = $db->prepare("SELECT * FROM `guestbook` ORDER BY `post_date` DESC LIMIT :offset, :limit;");
    // utilisation obligatoire de bindParam ou bindValue
    $stmt->bindValue(":offset",$offset,PDO::PARAM_INT);
    $stmt->bindValue(":limit",$limit,PDO::PARAM_INT);
    $stmt->execute();
    // recupération des resultats en fetch_assoc (voir connexion)
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // bonne pratique
    $stmt->closeCursor();
    // retour
    return $result;

}

# Pour afficher la pagination dans la vue
// FONCTION de pagination
/**
 * @param int $nbtotalMessage
 * @param string $url
 * @param string $get
 * @param int $pageActu
 * @param int $perPage
 * @return string
 * Fonction qui génère le code HTML de la pagination
 * si le nombre de pages est supérieur à une.
 */
function pagination(int $nbtotalMessage, string $url="./?", string $get="page", int $pageActu=1, int $perPage=5 ): string
{
    $sortie = "";
    if ($nbtotalMessage === 0) return "";
    $nbPages = ceil($nbtotalMessage / $perPage);
    if ($nbPages == 1) return "";
    $sortie .= "<p>";
    for ($i = 1; $i <= $nbPages; $i++) {
        if ($i === 1) {
            if ($pageActu === 1) {
                $sortie .= "<< < 1 |";
            } elseif ($pageActu === 2) {
                $sortie .= " <a href='$url'><<</a> <a href='$url'><</a> <a href='$url'>1</a> |";
            } else {
                $sortie .= " <a href='$url'><<</a> <a href='$url&$get=" . ($pageActu - 1) . "'><</a> <a href='$url'>1</a> |";
            }
        } elseif ($i < $nbPages) {
            if ($i === $pageActu) {
                $sortie .= "  $i |";
            } else {
                $sortie .= "  <a href='$url&$get=$i'>$i</a> |";
            }
        } else {
            if ($pageActu >= $nbPages) {
                $sortie .= "  $nbPages > >>";
            } else {
                $sortie .= "  <a href='$url&$get=$nbPages'>$nbPages</a> <a href='$url&$get=" . ($pageActu + 1) . "'>></a> <a href='$url&$get=$nbPages'>>></a>";
            }
        }
    }
    $sortie .= "</p>";
    return $sortie;

}
<?php

/**
 * Permet de checker si les input ont moins de 255 caractères
 * @param string $input La chaine de caractère à vérifié
 * @return bool true si > 255 false sinon
 */

function is_under_255(string $input): bool
{
    if (strlen($input) > 255) {
        return false;
    } else {
        return true;
    }
}

/**
 * Permet de verifier si une valeur est dans un array contenant des arrays
 * @param mixed $value la valeur cherchée
 * @param array $array l'array contenant des arrays
 * @return bool true s
 */
function name_in_array(mixed $value, array $arrays): bool
{
    foreach ($arrays as $key => $names) {
        if (in_array($value, $names, true)) {
            return true;
        }
    }
    return false;
}

function empty_array(array $array): bool
{
    foreach ($array as $key => $value) {
        if (!empty($value)) {
            return false;
        }
    }
    return true;
}

function create_paging(array $list, array $paging): array
{
    $count = 0;
    $tab = [];
    foreach ($list as $guitar) {
        $tab[] = $guitar;
        $count++;
        if ($count === 3) {
            if (empty($paging)) {
                $paging[1] = $tab;
                $tab = [];
                $count = 0;
            } else {
                $paging[] = $tab;
                $tab = [];
                $count = 0;
            }
        }
    }
    if ($count != 0) {
        if (empty($paging)) {
            $paging[1] = $tab;
        } else {
            $paging[] = $tab;
        }
    }
    return $paging;
}

function get_guitar_by_id(mixed $id, array $tab): array
{
    foreach ($tab as $guitar) {
        if ($guitar['id'] == $id) {
            return $guitar;
        }
    }
}

function get_key_by_id(mixed $id, array $tab): int
{
    foreach ($tab as $key => $guitar) {
        if ($guitar['id'] == $id) {
            return $key;
        }
    }
}

function delete_from_incoming(mixed $id, array $tab)
{
    unlink("./assets/images/guitars/incoming/" . $tab[get_key_by_id($id, $tab)]['image']);
    unset($tab[get_key_by_id($id, $tab)]);
    $json = json_encode($tab, JSON_PRETTY_PRINT);
    file_put_contents("includes/data/incoming.json", $json);
    header("Location: ../admin");
}

function delete_from_guitars(mixed $id, array $tab)
{
    unlink("./assets/images/guitars/" . $tab[get_key_by_id($id, $tab)]['image']);
    unset($tab[get_key_by_id($id, $tab)]);
    $json = json_encode($tab, JSON_PRETTY_PRINT);
    file_put_contents("includes/data/guitars.json", $json);
    header("Location: ../home");
}

function get_next_id(array $tab): int
{
    $id = 0;
    foreach ($tab as $key => $guitar) {
        if ($guitar['id'] > $id) {
            $id = $guitar['id'];
        }
    }
    return $id + 1;
}

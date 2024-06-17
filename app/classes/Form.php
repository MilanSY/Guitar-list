<?php

namespace App\Classes;

use App\Classes\Database;

class Form extends Database
{

    private $dataBase;
    private $users;
    private $data = [];
    private $fields = [];
    private $errors = [];
    private $displays = [];

    public function __construct($data = [])
    {
        $this->data = $data;
        $dataBase = new Database();
        $users = $dataBase->getUsers();
    }

    public function addField($name, $type, $label)
    {
        $this->fields[] = [
            'name' => $name,
            'type' => $type,
            'label' => $label
        ];
    }

    public function process_login()
    {
        global $_SESSION;
        foreach ($this->fields as $field) {
            if (!empty($this->data[$field['name']])) {
                if (password_verify($this->data[$field['name']], $this->users[$this->data['email']]['password'])) {
                    $_SESSION = $this->users[$this->data['email']];
                    header("Location: ../home");
                } else {
                    $this->errors[$field['name']] = "email ou mot de passe incorrect";
                    $this->displays[$field['name']] = "block";
                }
            } else {
                $this->errors[$field['name']] = "Ce champs est obligatoire";
                $this->displays[$field['name']] = "block";
            }

            if (empty_array($this->errors)) {
                header("Location: ../home");
            }
        }
    }

    public function process_modify(int $id, string $type)
    {
        foreach ($this->fields as $field) {
            if ($field['name'] === "image") {
                $new_name = $type . "-id-" . $_GET['id'] . ".png";
                $this->data[$field['name']] = $new_name;
            } else if (!empty($this->data[$field['name']])) {
                if (!is_under_255($this->data[$field['name']])) {
                    $this->errors[$field['name']] = "Ce champs ne peut pas dépassé les 255 caractères";
                    $this->displays[$field['name']] = "block";
                }
            } else {
                $this->errors[$field['name']] = "Ce champs est obligatoire";
                $this->displays[$field['name']] = "block";
            }
        }
    }

    public function process_add()
    {
        foreach ($this->fields as $field) {
            if (!empty($this->data[$field['name']])) {
                if (!is_under_255($this->data[$field['name']])) {
                    $this->errors[$field['name']] = "Ce champs ne peut pas dépassé les 255 caractères";
                    $this->displays[$field['name']] = "block";
                }
            } else {
                $this->errors[$field['name']] = "Ce champs est obligatoire";
                $this->displays[$field['name']] = "block";
            }
        }
    }


    public function render($page)
    { ?>
        <div class="modify">
            <form>
                <?php
                foreach ($this->fields as $field) { ?>
                    <label for="<?= $field['name'] ?>"><?= $field['label'] ?></label>';
                    <input type="<?= $field['type'] ?>" name="<?= $field['name'] ?>" id="<?= $field['name'] ?>" />';
                    <p class="errormsg" style="display: <?= $this->displays[$field['name']] ?>"><?= $this->errors[$field['name']] ?></p>';
                <?php }
                if ($page === "login") { ?>
                    <button type="submit">connexion</button>
                <?php } else { ?>
                    <button type="submit">evoyer</button>
                <?php } ?>
            </form>
        </div>
<?php
    }
}

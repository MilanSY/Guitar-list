<?php

namespace App\Classes;

use App\Classes\Database;

class Form{

    private $dataBase;
    private $users;
    private $data = [];
    private $fields = [];
    private $errors = [];
    private $displays = [];

    public function __construct($data = []) {
        $this->data = $data;
        $dataBase = new Database();
        $users = $dataBase->getUsers();
    }

    public function addField($name, $type, $label) {
        $this->fields[] = [
            'name' => $name,
            'type' => $type,
            'label' => $label
        ];
    }

    public function process_login() {
        foreach ($this->fields as $field) {
            if (!empty($this->data[$field['name']])) {
                if (password_verify($this->data[$field['name']], $users[$this->data['email']]['password'])) {
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
        }
    }

    public function render() {?>
        <div class="modify">
        <form>
        <?php
        foreach ($this->fields as $field) {?>
            <label for="<?= $field['name'] ?>"><?= $field['label'] ?></label>';
            <input type="<?= $field['type'] ?>" name="<?= $field['name'] ?>" id="<?= $field['name'] ?>" />';
            <p class="errormsg" style="display: <?= $this->displays[$field['name']] ?>"><?= $this->errors[$field['name']] ?></p>';
        <?php } ?>

        <button type="submit">Submit</button>
        </form>
        </div>
        <?php
    }
}
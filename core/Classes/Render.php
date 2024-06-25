<?php

namespace App\Classes;

class Render
{
    private string $link;

    public function __construct(string $link)
    {
        $this->link = $link;
    }

    public function renderList(array $list, string $imagePath = "", string $details = "")
    {
        ob_start();
        include dirname(__DIR__) . '/views/partials/guitar_list.php';
        return ob_get_clean();
    }

    public function renderPaging(string $leftButton, string $rightButton, array $pages)
    {
        ob_start();
        include dirname(__DIR__) . '/views/partials/paging.php';
        return ob_get_clean();
    }

    public function renderShow(array $guitar, bool $adminButton, string $link, string $imagePath = "")
    {
        ob_start();
        include dirname(__DIR__) . '/views/partials/details.php';
        return ob_get_clean();
    }

    public function renderHeader(string $title, bool $adminButton, bool $connectButton)
    {
        global $link;
        ob_start();
        include dirname(__DIR__) . '/views/template/header.php';
        return ob_get_clean();
    }
    public function renderHead()
    {
        ob_start();
        include dirname(__DIR__) . '/views/template/head.php';
        return ob_get_clean();
    }

    public function renderConnect(array $errors, array $values, array $display)
    {
        ob_start();
        include dirname(__DIR__) . '/views/partials/login.php';
        return ob_get_clean();
    }

    public function renderError404()
    {
        ob_start();
        include dirname(__DIR__) . '/views/errors/404.php';
        return ob_get_clean();
    }

    public function renderAdmin()
    {
        ob_start();
        include dirname(__DIR__) . '/views/admin/admin.php';
        return ob_get_clean();
    }

    public function renderForm(array $data, array $errors, array $values, array $displays, $modify = null)
    {
        ob_start();
        include dirname(__DIR__) . '/views/partials/form.php';
        return ob_get_clean();
    }

}

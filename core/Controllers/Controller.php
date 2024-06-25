<?php

namespace App\Controllers;

use App\Classes\Database;
use App\Classes\Render;
use App\Classes\Process;

class Controller
{
    public string $path;
    public string $uri;
    public Render $render;

    public function __construct(string $link)
    {
        $this->path = $link;
        $this->render = new Render($link);
    }

    public function header(string $uri)
    {
        [$adminButton, $connectButton, $title, $userName, $userImage] = Process::processHeader($this->uri);
        $content = $this->render->renderHead($this->path);
        $content .= $this->render->renderHeader($title, $adminButton, $connectButton);
        return $content;
    }

    public function index(int $paging)
    {
        $content = Controller::header($this->uri);
        [$list, $leftButton, $rightButton, $pages] = Process::processList($paging, Database::getGuitars());
        $content .= $this->render->renderList($list);
        $content .=  $this->render->renderPaging($leftButton, $rightButton, $pages);
        return $content;
    }


    public function show($id, array $guitars)
    {
        $content = Controller::header($this->uri);
        [$guitar, $adminButton, $imagePath] = Process::processShow($id, $guitars);
        $content .= $this->render->renderShow($guitar, $adminButton, $this->path, $imagePath);
        return $content;
    }

    public function add(int $id)
    {
        Process::processAdd($id);
    }

    public function connect(array $data)
    {
        $content = Controller::header($this->uri);
        [$errors, $values, $display] = Process::processConnect($data);
        $content .= $this->render->renderConnect($errors, $values, $display);
        return $content;
    }

    public function disconnect()
    {
        return Process::processDisconnect();
    }

    public function delete($id, $tab)
    {
        Process::processDelete($id, $tab);
    }

    public function adminIndex(string $paging)
    {
        $content = Controller::header($this->uri);
        [$list, $leftButton, $rightButton, $pages, $imagePath, $details] = Process::processList($paging, Database::getIncoming());
        $content .= $this->render->renderList($list, $imagePath, $details);
        $content .=  $this->render->renderPaging($leftButton, $rightButton, $pages);
        return $content;
    }

    public function request(array $data)
    {
        $content = Controller::header($this->uri);
        [$errors, $values, $displays] = Process::processRequest($data);
        $content .= $this->render->renderForm($data, $errors, $values, $displays);
        return $content;
    }

    public function modify($id, $data)
    {
        $content = Controller::header($this->uri);
        [$errors, $values, $display, $modify] = Process::processModify($id, $data);
        $content .= $this->render->renderForm($data, $errors, $values, $display, $modify);
        return $content;
    }

    public function error404()
    {
        $content = Controller::header($this->uri);
        $content .= $this->render->renderError404();
        return $content;
    }
}

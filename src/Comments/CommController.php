<?php

namespace Anax\Comments;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Comments\HTMLForm\CreateCommForm;
use \Anax\Comments\HTMLForm\UpdateCommForm;
use \Anax\Comments\HTMLForm\DeleteCommForm;
use \Anax\Comments\HTMLForm\AdminDeleteCommForm;
use \Anax\Comments\ShowOneService;
use \Anax\Comments\ShowAllService;

/**
 * A controller class.
 */
class CommController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;


    /**
     * Sends data to view
     *
     * @param string $title
     * @param string $crud, path to view
     * @param array $data, htmlcontent to view
     */
    public function toRender($title, $crud, $data)
    {
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $view->add($crud, $data);
        $tempfix = "";
        $pageRender->renderPage($tempfix, ["title" => $title]);
    }


    /**
     * Show all items.
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "Inlägg";

        $text = new ShowAllService($this->di);

        $data = [
            "items" => $text->getHTML(),
        ];

        $crud = "comm/crud/front";
        $this->toRender($title, $crud, $data);
    }



    /**
     * Handler with form to create a new item.
     *
     * @return void
     */
    public function getPostCreateItem($id = null)
    {
        $title      = "Skriv ett inlägg";

        $session = $this->di->get("session");
        $sess = $session->get("user");

        if ($sess) {
            $form       = new CreateCommForm($this->di, $sess['id'], $id);
            $form->check();

            $data = [
                "form" => $form->getHTML(),
            ];
        } else {
            $data = [
                "form" => "Enbart för inloggade. Sorry!",
            ];
        }

        $crud = "comm/crud/create";
        $this->toRender($title, $crud, $data);
    }


    /**
     * Handler with form to delete an item.
     *
     * @return void
     */
    public function getPostDeleteItem($id)
    {
        $title      = "Ta bort ett inlägg";

        $session = $this->di->get("session");
        $sess = $session->get("user");

        if ($sess) {
            $form       = new DeleteCommForm($this->di, $id);
            $form->check();

            $data = [
                "form" => $form->getHTML(),
            ];
        } else {
            $data = [
                "form" => "Enbart för inloggade. Sorry!",
            ];
        }

        $crud = "comm/crud/delete";
        $this->toRender($title, $crud, $data);
    }



    /**
     * Handler with form to update an item.
     *
     * @return void
     */
    public function getPostAdminDeleteItem()
    {
        $title      = "Ta bort text";
        $form       = new AdminDeleteCommForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $crud = "comm/crud/admindelete";
        $this->toRender($title, $crud, $data);
    }



    /**
     * Handler with form to update an item.
     *
     * @return void
     */
    public function getPostUpdateItem($id)
    {
        $title      = "Uppdatera ditt inlägg";

        $session = $this->di->get("session");
        $sess = $session->get("user");

        if ($sess) {
            $form       = new UpdateCommForm($this->di, $id, $sess['id']);
            $form->check();

            $data = [
                "form" => $form->getHTML(),
            ];
        } else {
            $data = [
                "form" => "Enbart för inloggade. Sorry!",
            ];
        }

        $crud = "comm/crud/update";
        $this->toRender($title, $crud, $data);
    }


    /**
     * Handler with form to just show an item.
     *
     * @return void
     */
    public function getPostShow($id)
    {
        $title      = "Inlägg";
        $text       = new ShowOneService($this->di, $id);

        $data = [
            "items" => $text->getHTML(),
        ];

        $crud = "comm/crud/view-one";
        $this->toRender($title, $crud, $data);
    }
}

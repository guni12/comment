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
     * @var $data description
     */
    //private $data;


    /**
     * Show all items.
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "Inlägg";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $tempfix = "";

        $text = new ShowAllService($this->di);

        $data = [
            "items" => $text->getHTML(),
        ];
        $view->add("comm/crud/front", $data);
        
        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Handler with form to create a new item.
     *
     * @return void
     */
    public function getPostCreateItem($id = null)
    {
        $title      = "Skriv ett inlägg";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

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

        $view->add("comm/crud/create", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return void
     */
    public function getPostDeleteItem($id)
    {
        $title      = "Ta bort ett inlägg";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

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

        $view->add("comm/crud/delete", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Handler with form to update an item.
     *
     * @return void
     */
    public function getPostAdminDeleteItem()
    {
        $title      = "Ta bort text";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new AdminDeleteCommForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("comm/crud/admindelete", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Handler with form to update an item.
     *
     * @return void
     */
    public function getPostUpdateItem($id)
    {
        $title      = "Uppdatera ditt inlägg";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

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

        $view->add("comm/crud/update", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }


    /**
     * Handler with form to just show an item.
     *
     * @return void
     */
    public function getPostShow($id)
    {
        $title      = "Inlägg";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $text       = new ShowOneService($this->di, $id);

        $data = [
            "items" => $text->getHTML(),
        ];

        $view->add("comm/crud/view-one", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }
}

<?php

namespace Anax\Comments\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\Comments\Comm;

/**
 * Form to create an item.
 */
class CreateCommForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $id, $parentid = null)
    {
        //echo "parentid: " . $parentid;
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Gör ett inlägg",
            ],
            [
                "title" => [
                    "type"  => "text",
                    "label" => "Titel",
                    "validation" => ["not_empty"],
                ],

                "id" => [
                    "type"  => "hidden",
                    "value" => $id,
                ],

                "parentid" => [
                    "type"  => "hidden",
                    "value" => $parentid,
                ],

                "comment" => [
                    "type"  => "textarea",
                    "label" => "Text",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Spara",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $textfilter = $this->di->get("textfilter");

        $userController = $this->di->get("userController");
        $userdetails = $userController->getOne($this->form->value("id"));
        $parses = ["yamlfrontmatter", "shortcode", "markdown", "titlefromheader"];
        $comment = $textfilter->parse($this->form->value("comment"), $parses);
        $comment->frontmatter['title'] = $this->form->value("title");
        $comment = json_encode($comment);

        $now = date("Y-m-d H:i:s");

        $comm = new Comm();
        $comm->setDb($this->di->get("db"));
        $comm->title = $this->form->value("title");
        $comm->userid = $this->form->value("id");
        $comm->parentid = $this->form->value("parentid");
        $comm->comment = $comment;
        $comm->email = $userdetails["email"];
        $comm->created = $now;
        $comm->save();

        $back = (int)$this->form->value("parentid") > 0 ? "/view-one/" . $this->form->value("parentid") : "";
        $pagerender = $this->di->get("pageRender");
        $pagerender->redirect("comm" . $back);
    }
}

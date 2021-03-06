<?php

namespace Anax\Comments\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\Comments\Comm;

/**
 * Example of FormModel implementation.
 */
class UpdateCommForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(DIInterface $di, $id, $sessid)
    {
        parent::__construct($di);
        $comm = $this->getCommDetails($id);

        $comt = $this->decode($comm->comment);
        $this->aForm($id, $sessid, $comm, $comt);
    }


    /**
    * Converts json-string back to variables
    *
    * @param string $fromjson the jsoncode
    * @return the extracted comment-text
    */
    public function decode($fromjson)
    {
        $textfilter = $this->di->get("textfilter");
        $toparse = json_decode($fromjson);
        $comt = $textfilter->parse($toparse->text, ["yamlfrontmatter", "shortcode", "markdown", "titlefromheader"]);
        $comt = strip_tags($comt->text);
        return $comt;
    }

    /**
     * Create the form.
     *
     */
    public function aForm($id, $sessid, $comm, $comt)
    {
        $this->form->create(
            ["id" => __CLASS__, "legend" => "Uppdatera ditt konto"],
            [   "sessid" => ["type"  => "hidden", "value" => $sessid],
                "id" => ["type"  => "hidden", "value" => $id],
                "parentid" => ["type"  => "hidden", "value" => $comm->parentid],
                "title" => ["type" => "text", "validation" => ["not_empty"], "value" => $comm->title],
                "comment" => ["type" => "textarea", "validation" => ["not_empty"], "value" => $comt],
                "submit" => ["type" => "submit", "value" => "Spara", "callback" => [$this, "callbackSubmit"]],
                "reset" => ["type"      => "reset"],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Comm
     */
    public function getCommDetails($id)
    {
        $comm = new Comm();
        $comm->setDb($this->di->get("db"));
        $comm->find("id", $id);
        return $comm;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $now = date("Y-m-d H:i:s");

        $textfilter = $this->di->get("textfilter");

        $userController = $this->di->get("userController");
        $userdetails = $userController->getOne($this->form->value("sessid"));

        $parses = ["yamlfrontmatter", "shortcode", "markdown", "titlefromheader"];
        $comment = $textfilter->parse($this->form->value("comment"), $parses);
        $comment->frontmatter['title'] = $this->form->value("title");
        $comment = json_encode($comment);

        $comm = new Comm();
        $comm->setDb($this->di->get("db"));
        $comm->find("id", $this->form->value("id"));
        $comm->updated = $now;
        $comm->title = $this->form->value("title");
        $comm->userid = $this->form->value("sessid");
        $comm->comment = $comment;
        $comm->email = $userdetails["email"];
        $comm->save();

        $parentid = (int)$this->form->value("parentid");

        $back = $parentid > 0 ? "/view-one/" . $parentid : "/view-one/" . $this->form->value("id");

        $pagerender = $this->di->get("pageRender");
        $pagerender->redirect("comm" . $back);

        return true;
    }
}

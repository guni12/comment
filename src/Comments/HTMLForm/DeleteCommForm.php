<?php

namespace Anax\Comments\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\Comments\Comm;

/**
 * Form to delete an item.
 */
class DeleteCommForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $commid)
    {
        parent::__construct($di);
        $comm = $this->getCommDetails($commid);

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Alla kommentarer tas också bort",
            ],
            [
                "userid" => [
                    "type"        => "hidden",
                    "value"       => $comm->userid,
                ],

                "id" => [
                    "type"        => "text",
                    "readonly"    => true,
                    "value"       => $commid,
                    "label"       => "Ta bort inlägget",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Ta bort",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Get all items as array suitable for display in select option dropdown.
     *
     * @return array with key value of all items.
     */
    protected function getCommDetails($id)
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
        $comm = new Comm();
        $comm->setDb($this->di->get("db"));

        //echo "<br />" . $this->form->value("commid") . " Testar" . "<br />";

        $all = $comm->findAll();
        $objects = "";

        foreach ($all as $obj) {
            if ($obj->parentid && $obj->parentid == $this->form->value("id")) {
                //echo 'Ja: ' . $obj->parentid . ' kastar ' . $obj->id . '<br />';
                $comm->find("id", $obj->id);
                $objects .= $comm->title . ", ";
                $comm->delete();
            }
        }

        //echo "Kastar id: " . $this->form->value("id");
        $comm->find("id", $this->form->value("id"));
        $objects .= $comm->title;
        $comm->delete();
        //$this->form->addOutput($objects . ": kastats.");
        $pagerender = $this->di->get("pageRender");
        $pagerender->redirect("comm");
    }
}

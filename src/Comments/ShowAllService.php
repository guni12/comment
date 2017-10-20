<?php

namespace Anax\Comments;

use \Anax\DI\DIInterface;
use \Anax\Comments\Comm;

/**
 * Form to update an item.
 */
class ShowAllService
{
    /**
    * @var array $comments, all comments.
    */
    protected $comments;
    protected $sess;
    protected $users;
    protected $user;

    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        $this->di = $di;
        $this->comments = $this->getAll();
        $session = $this->di->get("session");
        $this->sess = $session->get("user");
        $addsess = isset($this->sess) ? $this->sess : null;
        $this->sess = $addsess;
        $userController = $this->di->get("userController");
        $this->users = $userController->getAllUsers();
        $this->user = $userController->getOne($this->sess['id']);
    }

    /**
     * Get details on all comments.
     *
     * @return Comm
     */
    public function getAll()
    {
        $comm = new Comm();
        $comm->setDb($this->di->get("db"));
        return $comm->findAll();
    }


    /**
     * Sets the callable to use for creating routes.
     *
     * @param callable $urlCreate to create framework urls.
     *
     * @return void
     */
    public function setUrlCreator($route)
    {
        $url = $this->di->get("url");
        return call_user_func([$url, "create"], $route);
    }


    /**
     * Returns link for gravatar img
     *
     * @param object $item
     *
     * @return string htmlcode
     */
    public function getGravatar($item)
    {
        $comm = new Comm();
        $gravatar = $comm->getGravatar($item);
        return '<img src="' . $gravatar . '" alt=""/>';
    }


    /**
     * Returns text if updated
     *
     * @param object $item
     * @return string htmlcode
     */
    public function getExtra($item)
    {
        $extra = "";
        if ($item) {
            $extra .= '<br />Uppdaterades: ' . $item;
        }
        return $extra;
    }


    /**
     * Returns correct loginlink
     *
     * @param boolean $isadmin
     * @param string $create
     * @param string $del
     *
     * @return string htmlcode
     */
    public function getLoginLink($isadmin, $create, $del)
    {
        $loggedin = '<a href="user/login">Logga in om du vill kommentera</a>';
        if ($this->sess['id']) {
            $loggedin = ' <a href="' . $create .'">Skriv ett inlägg</a>';
            if ($isadmin === true) {
                $loggedin .= ' | <a href="' . $del . '">Ta bort ett inlägg</a>';
            }
        }
        return $loggedin;
    }


    /**
     * Returns html for each item
     *
     * @param object $item
     * @param boolean $isadmin
     * @param string $viewone
     *
     * @return string htmlcode
     */
    public function getValHtml($item, $isadmin, $viewone)
    {
        $gravatar = $this->getGravatar($item->email);
        $extra = $this->getExtra($item->updated);
        if ($isadmin === true) {
            $showid = '(' . $item->id . '): ';
        }
        $html = '<h4><a href="' . $viewone . '/' . $item->id . '">';
        $html .= $showid . ' ' . $item->title . '</a></h4><p>';
        $html .= $item->created . ' ' . $item->email . ' ' . $gravatar . ' ' . $extra . '</p><hr />';
        return $html;
    }


    /**
     * Returns all text for the view
     *
     * @return string htmlcode
     */
    public function getHTML()
    {
        $loggedin = "";
        $showid = "";
        $gravatar = "";
        $extra = "";
        $html = "";

        $isadmin = $this->sess['isadmin'] === 1 ? true : false;

        $create = $this->setUrlCreator("comm/create");
        $del = $this->setUrlCreator("comm/admindelete");
        $viewone = $this->setUrlCreator("comm/view-one");

        $loggedin = $this->getLoginLink($isadmin, $create, $del);

        $html .= '<div class="col-sm-12 col-xs-12">
        <div class="col-lg-6 col-sm-7 col-xs-7">
        <h3>Gruppinlägg <span class="small">' . $loggedin . '</span></h3>
        <hr />';

        foreach ($this->comments as $value) {
            if ((int)$value->parentid > 0) {
                continue;
            }
            $html .= $this->getValHtml($value, $isadmin, $viewone);
        }
        
        $html .= '</div></div>';
        return $html;
    }
}

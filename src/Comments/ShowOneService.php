<?php

namespace Anax\Comments;

use \Anax\DI\DIInterface;
use \Anax\Comments\Comm;

/**
 * Form to update an item.
 */
class ShowOneService
{
    /**
    * @var array $commentitem, the chosen comment.
    */
    protected $comment;
    protected $comments;
    protected $sess;


    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to show
     */
    public function __construct(DIInterface $di, $id)
    {
        $this->di = $di;
        $this->comment = $this->getItemDetails($id);

        $where = "parentid = ?";
        $params = [$id];
        $this->comments = $this->getParentDetails($where, $params);

        $session = $this->di->get("session");
        $this->sess = $session->get("user");
    }


    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Comm
     */
    public function getItemDetails($id)
    {
        $comm = new Comm();
        $comm->setDb($this->di->get("db"));
        $comm->find("id", $id);
        return $comm;
    }


        /**
     * Get details on item to load form with.
     *
     * @param string $where
     * @param array $params get details on item with id parentid.
     *
     * @return Comm
     */
    public function getParentDetails($where, $params)
    {
        $comm = new Comm();
        $comm->setDb($this->di->get("db"));
        return $comm->findAllWhere($where, $params);
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
     * @return string htmlcode
     */
    public function getGravatar($item)
    {
        $comm = new Comm();
        $gravatar = $comm->getGravatar($item);
        return '<img src="' . $gravatar . '" alt=""/>';
    }


    /**
     * Returns json_decoded title and text
     * If lead text, headline is larger font
     * @param object $item
     * @return string htmlcode
     */
    public function getDecode(Comm $item, $lead = null)
    {
        $comt = json_decode($item->comment);
        if ($comt->frontmatter->title) {
            $til = $comt->frontmatter->title;
        } else {
            $til = $item->title;
        }
        $comt = $comt->text;
        if ($lead) {
            return '<h3>' . $til . '</h3><p>' . $comt . '</p>';
        }
        return '<h4>' . $til . '</h4><p>' . $comt . '</p>';
    }


    /**
     * If param met, returns string with edit-links
     * @param boolean $isadmin
     * @param object $item
     * @param string $del
     * @return string htmlcode
     */
    public function getCanEdit(Comm $item, $isadmin, $del)
    {
        $canedit = "";
        $update = $this->setUrlCreator("comm/update");
        if ($item->userid == $this->sess['id'] || $isadmin) {
            $canedit = '<br /><a href="' . $update . '/' . $item->id . '">Redigera</a>';
            $canedit .= ' | <a href="' . $del . '/' . $item->id . '">Ta bort inlägget</a></p>';
        } else {
            $canedit .= '</p>';
        }
        return $canedit;
    }


    /**
     * If session contains correct id, returns string with edit-links
     *
     * @return string htmlcode
     */
    public function getLoginurl()
    {
        $loginurl = $this->setUrlCreator("user/login");
        $create = $this->setUrlCreator("comm/create");

        $htmlcomment = '<a href="' . $loginurl . '">Logga in om du vill kommentera</a></p>';

        if ($this->sess && $this->sess['id']) {
            $htmlcomment = '<a href="' . $create . '/' . $this->comment->id . '">Kommentera</a>';
        }
        return $htmlcomment;
    }


    /**
     * If loggedin allowed to edit
     *
     * @param boolean $isadmin
     * @param string $userid
     * @param string $commid
     * @param string $htmlcomment, link
     *
     * @return string htmlcode
     */
    public function getEdit($isadmin, $userid, $commid, $htmlcomment)
    {
        $update = $this->setUrlCreator("comm/update");
        if ($isadmin || $userid == $this->sess['id']) {
            $edit = '<p><a href="' . $update . '/' . $commid . '">Redigera</a> | ';
            $edit .= $htmlcomment;
        } else {
            $edit = "<p>" . $htmlcomment . "</p>";
        }
        return $edit;
    }


    /**
     * If session contains correct id, returns string with edit-links
     *
     * @return string htmlcode
     */
    public function getDelete($isadmin, $userid, $del, $commid)
    {
        $delete = "";
        if ($isadmin || $userid == $this->sess['id']) {
            $delete = ' | <a href="' .  $del . '/' . $commid . '">Ta bort inlägget</a></p>';
        }
        return $delete;
    }


    /**
     * Returns html for each item
     *
     * @param object $item
     * @param string $can
     *
     * @return string htmlcod
     */
    public function getValHtml(Comm $item, $can)
    {
        $gravatar = $this->getGravatar($item->email);
        $updated = isset($item->updated) ? '| Uppdaterades: ' . $item->updated : "";
        
        $text = $this->getDecode($item);
        $text .= '<p><span class="smaller">' . $item->email . '</span> ' . $gravatar . '<br />';
        $text .= 'Skrevs: ' . $item->created . ' ' . $updated;
        $text .= $can;
        $text .= '<hr />';
        return $text;
    }


    /**
     * Returns all text for the view
     *
     * @return string htmlcode
     */
    public function getHTML()
    {
        $isadmin = $this->sess['isadmin'] == 1 ? true : false;

        $del = $this->setUrlCreator("comm/delete");
        $commpage = $this->setUrlCreator("comm");
        
        $htmlcomment = $this->getLoginurl();
        $edit = $this->getEdit($isadmin, $this->comment->userid, $this->comment->id, $htmlcomment);
        $delete = $this->getDelete($isadmin, $this->comment->userid, $del, $this->comment->id);

        $text = '<h3>Kommentarer</h3>';

        if ($this->comments) {
            foreach ($this->comments as $value) {
                $can = $this->getCanEdit($value, $isadmin, $del);
                $text .= $this->getValHtml($value, $can);
            }
        }

        $html = '<div class="col-sm-12 col-xs-12"><div class="col-lg-4 col-sm-7 col-xs-7 abookimg">';
        $html .= $this->getDecode($this->comment, true);
        $html .= '<br />' . $edit;
        $html .=  $delete;
        $html .=  '<p><a href="' . $commpage . '">Till Alla Inläggen</a></p>';
        $html .=  '</div><div class="col-sm-5 col-xs-5">';
        $html .= $text;
        $html .= '</div></div>';
        return $html;
    }
}

<?php
namespace Anax\Comments;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Comm extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Comm";


    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userid;
    public $email;
    public $title;
    public $comment;
    public $parentid;
    public $created;
    public $updated;


    public function getGravatar($email)
    {
        $size = 20;
        $dim = 'mm';
        $rad = 'g';
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$size&d=$dim&r=$rad";
        return $url;
    }
}

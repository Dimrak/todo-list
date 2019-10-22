<?php


namespace App\Model;


use Core\Database;

class UploadValues
{
    private $id;
    private $title;
    private $todo;
    private $parentId;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function create()
    {
        $columns = 'title, todo, parent_id';
        $values = "'$this->title', '$this->todo', $this->parentId";
        $this->db->insert('upload_values', $columns, $values);
        $this->db->execute();
    }

    public function getAll($id)
    {
        $this->db->select()->from('upload_values')->where('parent_id', $id);
        return $this->db->getAll();
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTodo()
    {
        return $this->todo;
    }

    /**
     * @param mixed $todo
     */
    public function setTodo($todo)
    {
        $this->todo = $todo;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param mixed $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

}
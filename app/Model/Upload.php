<?php


namespace App\Model;

use Core\Database;

class Upload
{
    private $name;
    private $db;
    private $title;
    private $todo;
    private $updatedAt;


    public function __construct()
    {
        $this->db = new Database();
    }

    public function create()
    {
        $columns = 'name, updated_at';
        $values = "'$this->name', '$this->updatedAt'";
        $this->db->insert('uploaded_files', $columns, $values);
        return $this->db->execute();
    }

    public function getFiles()
    {
        $this->db->select()->from('uploaded_files');
        return $this->db->getAll();
    }

    public function getLastUpdated()
    {
        $this->db->select()->from('uploaded_files')->orderBy('updated_at')->desc('DESC');
//        return $this->db->get();
        return $this->db->get();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

}
<?php


namespace App\Model;

use Core\Database;

class Todo
{
    private $id;
    private $title;
    private $todo;
    private $db;
    private $active;
    private $updatedAt;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create()
    {
        $columns = 'title, todo';
        $values = "'$this->title', '$this->todo'";
        $this->db->insert('todo_list', $columns, $values);
        $this->db->execute();
    }

    public function markCompleted($id)
    {
        $setContent = "active = $this->active, updated_at= '$this->updatedAt'";
        $this->db->update('todo_list', $setContent)->where('id', $id);
        return $this->db->execute();
    }

    public function getTodos()
    {
        $this->db->select()->from('todo_list');
        return $this->db->getAll();
    }

    public function update($id)
    {
        $setContent = "title = '$this->title', todo = '$this->todo'";
        $this->db->update('todo_list', $setContent)->where('id', $id);
        $this->db->execute();
    }



    public function destroy($id)
    {
        $this->db->delete()->from('todo_list')->where('id', $id);
        $this->db->execute();
        return $this;
    }

    public function getLast()
    {
        $this->db->select()->from('todo_list')->orderBy('id')->desc('DESC');
        return $this->db->get();
    }

    public function getLastUpdated()
    {
        $this->db->select()->from('todo_list')->orderBy('updated_at')->desc('DESC');
        return $this->db->get();
    }

    public function wipeDb()
    {
        $this->db->delete()->from('todo_list');
        return $this->db->execute();
    }


    /**
     * Getters and setters
     */
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTodo()
    {
        return $this->todo;
    }

    public function setTodo($todo)
    {
        $this->todo = $todo;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }

}
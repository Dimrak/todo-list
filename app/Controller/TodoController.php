<?php

namespace App\Controller;

use App\Helper\FormBuilder;
use App\Model\Todo;
use App\Helper\Helper;
use App\Model\Upload;
use App\Model\UploadValues;
use Core\Controller;

//use League\Csv\Reader;


class TodoController extends Controller
{
    public function index()
    {
        $todos = new Todo();
        $todos = $todos->getTodos();

        $form = new FormBuilder(url('todo/store'), 'post', '');
        $form->addInput([
            'id' => 'title',
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Title'
        ], 'd-block mb-2 border-0 text-dark')
            ->addTextarea([
                'name' => 'todo',
                'id' => 'todo',
                'placeholder' => 'Short explanation of your task',
//                'type' => 'textarea',
//                'cols' => 20,
                'rows' => 8,
            ], 'text-dark w-100')
            ->addSubmit([
                'id' => 'submit',
                'name' => 'submit',
                'type' => 'submit'
            ]);

        if (isset($_GET)) {
            $value = $_GET;
//            print_r($_GET);
            array_push($value, $todos);
        } else {

        }

        $this->view->form = $form->get();
        $this->view->todos = $todos;
        $uploaded_files = new Upload();
        $files = $uploaded_files->getFiles();
//        dd($files[0]);
        $this->view->files = $files;
        $this->view->render('todos/index');
    }


    public function store()
    {
        $response = [];
        $newTodo = new Todo();
        $newTodo->setTitle($_POST['title']);
        $newTodo->setTodo($_POST['todo']);
        $newTodo->create();
        $newTodo->getLast();
        $response['title'] = $newTodo->getLast()->title;
        $response['todo'] = $newTodo->getLast()->todo;
        $response['id'] = $newTodo->getLast()->id;
        echo json_encode($response);
//        return json_encode($id);
    }

    public function completed($id)
    {
        $completedTodo = new Todo();
        $completedTodo->setActive(0);
        $date = date('Y/m/d H:i:s', time());
        $completedTodo->setUpdatedAt($date);
        $completedTodo->markCompleted($id);
        $latest = $completedTodo->getLastUpdated();
        $response['title'] = $latest->title;
        $response['todo'] = $latest->todo;
        $response['id'] = $latest->id;
        echo json_encode($response);
    }

    public function delete($id)
    {
        $deleteTodo = new Todo();
        $deleteTodo->destroy($id);
//        $response = [];
//        $response['message'] = 'Todo removed';
        $_SESSION['delete'] = 'Todo removed';
//        echo json_encode($response);
//        redirect(url('/'));
    }

    public function edit()
    {
        $id = $_POST['id'];
        $editTodo = new Todo();
        $editTodo->setTitle($_POST['title']);
        $editTodo->setTodo($_POST['todo']);
        $editTodo->update($id);
        $response = [];
        $response['title'] = $editTodo->getTitle();
        $response['todo'] = $editTodo->getTodo();
        echo json_encode($response);

    }

    public function destroyAll()
    {
        $destruction = new Todo();
        $destruction->wipeDb();
        $_SESSION['message'] = 'Db cleared';
        redirect(url('/'));
    }

    public function loadFile($id)
    {
        $values = new UploadValues();
        $todos = $values->getAll($id);
        $todo_list = [];
        foreach ($todos as $todo) {
            $newTodo = new Todo();
            $newTodo->setTitle($todo->title);
            $newTodo->setTodo($todo->todo);
            $newTodo->setActive(1);
            array_push($todo_list, $newTodo);
        }
//        dd($todo_list);
        $response = [];
        $counter = 1;

        foreach ($todo_list as $responseTodo) {
//            dd($responseTodo->getTitle());
            $response['todoTitle' . $counter] = $responseTodo->getTitle();
            $response['todoTodo' . $counter] = $responseTodo->getTodo();
            $counter++;
        }
        echo json_encode($response);
    }

    public function upload()
    {
        if (empty($_FILES['fileToUpload']['name'])) {
            dd('Please choose a file');
//            $html .= "<p class='error'>Required field image</p>";
        } else {
            $file = $_FILES;
            $validator = new Helper;
            $fileChecker = $validator->validateFile($file);
            if (!empty($fileChecker)) {
                $html = '';
                echo $html;
            } else {
                $parentFile = new Upload();
                $file = $_FILES['fileToUpload']['name'];
                $parentFile->setName($file);
                $date = date('Y/m/d H:i:s', time());
                $parentFile->setUpdatedAt($date);
                $parentFile->create();
                $latestFile = $parentFile->getLastUpdated();
                // If the file is uploaded
                if (is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
                    // Open uploaded CSV file with read-only mode
                    $csvFile = fopen($_FILES['fileToUpload']['tmp_name'], 'r');
                    // Skip the first line
                    fgetcsv($csvFile); //title,todo
                    // Parse data from CSV file line by line
                    while (($line = fgetcsv($csvFile)) !== FALSE) {
                        // Get row data
                        //For table values
                        $newFile = new UploadValues();
                        $newFile->setParentId($latestFile->id);
                        $newFile->setTitle($line[0]);
                        $newFile->setTodo($line[1]);
                        $newFile->create();
                        //For table todos
                        $newTodo = new Todo();
                        $newTodo->setTitle($line[0]);
                        $newTodo->setTodo($line[1]);
                        $newTodo->create();
                    }
                }
            }
        }
        redirect(url('/'));
    }


}//Class end

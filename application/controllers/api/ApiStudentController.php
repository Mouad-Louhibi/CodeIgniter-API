<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class ApiStudentController extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('StudentModel');
    }

    public function index_get()
    {
        $students = new StudentModel;
        $students = $students->get_test();
        $this->response($students, 200);
    }

    public function indexStudent_get()
    {
        $students = new StudentModel;
        $students = $students->get_student();
        $this->response($students, 200);
    }

    public function storeStudent_post()
    {
        $students = new StudentModel;
        $json_string = file_get_contents('php://input');
        $json_a = json_decode($json_string, true);;
        $data = [
            'name' =>  $json_a['name'],
            'class' => $json_a['class'],
            'email' => $json_a['email']
        ];
        var_dump($data);
        $result = $students->insert_student($data);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'NEW STUDENT CREATED'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO CREATE NEW STUDENT'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function editStudent_get($id)
    {
        $students = new StudentModel;
        $students = $students->edit_student($id);
        $this->response($students, 200);
    }

    public function updateStudent_put($id)
    {
        $students = new StudentModel;
        $data = [
            'name' =>  $this->put('name'),
            'class' => $this->put('class'),
            'email' => $this->put('email')
        ];
        $result = $students->update_student($id, $data);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'STUDENT UPDATED'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO UPDATE STUDENT'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function deleteStudent_delete($id)
    {
        $students = new StudentModel;
        $result = $students->delete_student($id);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'STUDENT DELETED'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO DELETE STUDENT'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}

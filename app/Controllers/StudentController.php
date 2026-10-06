<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use CodeIgniter\HTTP\ResponseInterface;

class StudentController extends BaseController
{
    public function dashboardPage()
    {
        return view('dashboard');
    }
    public function studentsPage()
    {
        $model = new StudentModel();


        $search = $this->request->getGet('search');

        if (!empty($search)) {
            $model->groupStart()
                ->like('first_name', $search)
                ->orlike('middle_name', $search)
                ->orlike('last_name', $search)->groupEnd();
        }

        $students = $model->where('isDelete', 0)->paginate(10);

        $data = [
            'students' => $students,
            'pager' => $model->pager,
            'search' => $search,
        ];

        return view('students', $data);
    }

    public function addStudent()
    {
        $model = new StudentModel();

        $firstName = $this->request->getPost('firstName');
        $middleName = $this->request->getPost('middleName');
        $lastName = $this->request->getPost('lastName');
        $nameExtension = $this->request->getPost('nameExtension');
        $course = $this->request->getPost('course');
        $year = $this->request->getPost('year');
        $enrollmentDate = $this->request->getPost('enrollmentDate');
        $status = $this->request->getPost('status');

        $model->insert([
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'name_extension' => $nameExtension,
            'course' => $course,
            'year' => $year,
            'enrollment_date' => $enrollmentDate,
            'status' => $status
        ]);

        return redirect()->back();
    }

    public function deleteStudent($id)
    {
        $model = new StudentModel();

        $student = $model->find($id);

        if (!$student) {
            return redirect()->back()->with('message', 'Invalid Id');
        }

        $model->update($id, [
            'isDelete' => 1
        ]);

        return redirect()->back()->with('message', 'Deleted Succesfully');
    }
    public function updateStudent($id)
    {
        $model = new StudentModel();

        $updatedFirstName = $this->request->getPost('firstName');
        $updatedMiddleName = $this->request->getPost('middleName');
        $updatedLastName = $this->request->getPost('lastName');
        $updatedNameExtension = $this->request->getPost('nameExtension');
        $updatedCourse = $this->request->getPost('course');
        $updatedYear = $this->request->getPost('year');
        $updatedEnrollmentDate = $this->request->getPost('enrollmentDate');
        $updatedStatus = $this->request->getPost('status');

        $model->update($id, [
            'first_name' => $updatedFirstName,
            'middle_name' => $updatedMiddleName,
            'last_name' => $updatedLastName,
            'name_extension' => $updatedNameExtension,
            'course' => $updatedCourse,
            'year' => $updatedYear,
            'enrollment_date' => $updatedEnrollmentDate,
            'status' => $updatedStatus
        ]);

        return redirect()->back()->with('message', 'Updated Successfully!');
    }

    public function login()
    {
        return view('login');
    }
}

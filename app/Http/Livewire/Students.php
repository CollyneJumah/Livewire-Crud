<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Student;

class Students extends Component
{
    public $firstname,$lastname,$phone,$gender,$fetchStudent,$student_id;
    public $studentUpdate = false;
    public $searchStudent;

    //validate
    // public function hydrate(){
    //     $this->validate([
    //      'firstname' => 'required',
    //      'lastname' => 'required',
    //      'phone' => 'required',
    //      'gender' => 'required',
    //     ]);
    // }

    //insert student
    public function CreateStudent()
    {
        //validate 
        $this->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'phone' => ['required','max:10','unique:students'],
            'gender' => ['required'],
        ]);
        //1.call the model
        Student::create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'gender' => $this->gender
        ]);
        return view('livewire.students')->with('message','user created successfully');
    }

    private function clearData()
    {
        $this->firstname = null;
        $this->lastname =null;
        $this->phone = null;
        $this->gender = null;
    }
  
    public function render()
    {

        // $this->fetchStudent = Student::latest()->get();
        $this->fetchStudent =Student::where('firstname', 'like','%' .$this->searchStudent. '%')
            ->orWhere('lastname','like', '%' .$this->searchStudent. '%')
            ->get();

        return view('livewire.students');
    }
    protected $updateQueryString = ['searchStudent'];
    public function mount()
    {
        $this->searchStudent = request('searchStudent', $this->searchStudent);

    }

    //edit
    public function EditStudent($id)
    {
        $this->studentUpdate = true;
        $editStudent = Student::findOrFail($id);
        $this->student_id = $id;
        $this->firstname = $editStudent->firstname;
        $this->lastname = $editStudent->lastname;
        $this->phone = $editStudent->phone;
        $this->gender = $editStudent->gender;

    }
    //update
    public function UpdateStudent()
    {
        //pass data
        $updateStudent =Student::findOrFail($this->student_id);
        $updateStudent->update([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'gender' => $this->gender
        ]);

        $studentUpdate=false;
    }

    //delete student
    public function deleteStudent($id)
    {
        if ($id) {
            # code...
            $deleteStudent = Student::where('id', $id);
            $deleteStudent->delete();
        }
    }

    
}

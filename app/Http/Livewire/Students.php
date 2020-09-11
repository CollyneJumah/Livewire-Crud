<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Student;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class Students extends Component
{
    public $firstname,$lastname,$phone,$gender,$avatar,$fetchStudent,$student_id;
    public $studentUpdate = false;
    public $searchStudent;

    // use WithPagination;
    use WithFileUploads;

    //validate
    // public function hydrate(){
    //     $this->validate([
    //      'firstname' => 'required',
    //      'lastname' => 'required',
    //      'phone' => 'required',
    //      'gender' => 'required',
    //     ]);
    // }

    //realtime validation
    public function updated($fields)
    {
        $this->validateOnly($fields,
        [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'phone' => ['required','unique:students','starts_with:+2547'],
            'gender' => ['required'],
            'avatar' => ['required','image','max:1024','mimes:jpg,jpeg,gif,png']
        ]);
    }
    //insert student
    public function CreateStudent()
    {
        //validate 
        $this->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'phone' => ['required','unique:students','starts_with:+2547'],
            'gender' => ['required'],
            'avatar' => ['required','image','max:1024','mimes:jpg,jpeg,gif,png']
        ]);
        //1.call the model
        Student::create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'gender' => $this->gender
        ]);
        session()->flash('message','👍 user created successfully 😊');
        // return view('livewire.students')->with('message','user created successfully');
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

        return view('livewire.students',[
            'paginateStudent' => Student::latest()->paginate(4)
        ]
        );
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
            session()->flash('message','👌 user updated successfuly👏');
        $studentUpdate=false;
    }

    //delete student
    public function deleteStudent($id)
    {
        if ($id) {
            # code...
            $deleteStudent = Student::where('id', $id);
            $deleteStudent->delete();
            session()->flash('delete','😢user Deleted successfuly ');
        }
    }

    
}

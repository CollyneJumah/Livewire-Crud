<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
   @if ($studentUpdate)
        @include('livewire.student.update')
   @else
    @include('livewire.student.create')

   @endif

    {{-- table for student --}}
    <hr>
    <span class="float-right p-4"><input type="text" wire:model="searchStudent" class="form-control" placeholder="search..."></span>
<hr>

    <table class="table table-bordered table-stripped">
        <thead class="bg-dark text-white">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fetchStudent as $key =>$student)
                <tr>
                    <td>{{ ++$key}}</td>
                    <td>{{ $student->firstname}}</td>
                    <td>{{ $student->lastname}}</td>
                    <td>{{ $student->phone}}</td>
                    <td>{{ $student->gender}}</td>
                    <td>{{ $student->created_at->diffForHumans()}}</td>
                    <td>{{ $student->updated_at->diffForHumans()}}</td>
                    <td>
                        <a href="#" wire:click="EditStudent({{$student->id}})" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>edit</a>
                        <a href="#" onclick="confirm('Are you sure you want to delete?') || event.stopPropagation()" wire:click="deleteStudent({{ $student->id}})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>delete</a>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-danger"> No data found</td>
            </tr>
            @endforelse
            
        </tbody>
    </table>
    {{-- {{ $fetchStudent->links()}} --}}
</div>

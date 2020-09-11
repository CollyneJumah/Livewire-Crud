@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message')}}
    </div>
@endif
<form autocomplete="off" class="p-4">
    <div class="form-row">
        <input type="hidden" wire:model="student_id">
        <div class="form-group col-md-3">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" wire:model="firstname">
        </div>
        <div class="form-group col-md-3">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" wire:model="lastname">
        </div>
        <div class="form-group col-md-3">
            <label for="phone">Phone</label>
            <input type="tel" class="form-control" wire:model="phone">
        </div>
        <div class="form-group col-md-3">
            <label for="gender">Gender</label>
            <select  class="form-control" wire:model="gender">
                <option value="">---select gender--</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>
    </div>
    <input type="submit" wire:click.prevent="UpdateStudent" class="btn btn-info btn-xs float-right" value="update student" >
</form>
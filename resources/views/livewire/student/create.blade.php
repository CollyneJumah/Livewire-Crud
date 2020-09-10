<form autocomplete="off" class="p-4">
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control @error('firstname') is-invalid @enderror" wire:model="firstname">
            @if ($errors->has('firstname'))
                <strong class="invalid-feedback">{{ $errors->first('firstname')}}</strong>
            @endif
        </div>
        <div class="form-group col-md-3">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control @error('lastname') is-invalid @enderror" wire:model="lastname">
            @if ($errors->has('lastname'))
                <strong class="invalid-feedback">{{ $errors->first('lastname')}}</strong>
            @endif
        </div>
        <div class="form-group col-md-3">
            <label for="phone">Phone</label>
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" wire:model="phone">
            @error('phone')
                <strong class="invalid-feedback">{{ $message}}</strong>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="gender">Gender</label>
            <select  class="form-control @error('gender') is-invalid @enderror" wire:model="gender">
                <option value="">---select gender--</option>
                <option>Male</option>
                <option>Female</option>
            </select>
            @if ($errors->has('gender'))
                <span class="invalid-feedback">{{ $errors->first('gender')}}</span>
            @endif
        </div>
    </div>
    <input type="submit" wire:click.prevent="CreateStudent" class="btn btn-dark btn-xs float-right" value="create student" >
</form>
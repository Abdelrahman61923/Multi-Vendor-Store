@if ($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occured!</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <x-form.input label="Name" name="name" :value="$admin->name" />
</div>
<div class="form-group">
    <x-form.input label="Email" name="email" :value="$admin->email" />
</div>
<div class="form-group">
    <label class="form-label">Roles</label>
    @foreach ($roles as $role)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}"
                {{ in_array($role->id, $admin_roles) ? 'checked' : '' }}>

            <label class="form-check-label" for="role_{{ $role->id }}">
                {{ $role->name }}
            </label>
        </div>
    @endforeach
</div>

<div class="form-group">
    @csrf
    <button type="submit" class="btn btn-sm btn-primary">{{ $button_label ?? 'Store' }}</button>
</div>

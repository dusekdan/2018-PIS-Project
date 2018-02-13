@extends('admin.home')

@section('subpage-contents')

@if ($errors->any())
    <div class="alert alert-danger">
        <h5 class="alert-heading">Úprava selhala!</h5>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (\Session::has('error'))
    <div class="alert alert-danger">
        <h5 class="alert-heading">Úprava selhala!</h5>
         {{ \Session::get('error') }}
    </div>
@endif

<h5>Upravit profil uživatele: {{  $user->name }}</h5>
<hr>
<form method="post" action="{{ route('admin.user-management.edit', ['id' => $id]) }}">

    <div class="form-group">
        <label for="user-name" class="required">Jméno:</label>
        <input
                type="text"
                id="user-name"
                name="user-name"
                title="user-name"
                class="form-control"
                value="{{ empty(old('user-name')) ? ($user->name) : (old('user-name')) }}"
        >
    </div>

    <div class="form-group">
        <label for="user-email" class="required">Email:</label>
        <input
                type="text"
                id="user-email"
                name="user-email"
                title="user-email"
                class="form-control"
                value="{{ empty(old('user-email')) ? ($user->email) : (old('user-email')) }}"
        >
    </div>

    <div class="form-group">
        <label for="user-password">Heslo:</label>
        <input
                type="password"
                id="user-password"
                name="user-password"
                title="user-password"
                class="form-control"
                value=""
        >
        <small id="passwordHelp" class="form-text text-muted">Není-li vyplněno, nebude změněno.</small>
    </div>

    <div class="form-group">
        <label for="user-password_confirmation">Heslo pro kontrolu:</label>
        <input
                type="password"
                id="user-password_confirmation"
                name="user-password_confirmation"
                title="user-password_confirmation"
                class="form-control"
                value=""
        >
    </div>

    <div class="form-group">
        <label for="user-role" class="required">Role:</label>
        <select name="user-role" id="user-role" title="user-role" class="form-control">
            @foreach ($roles as $role)
                <option
                        value="{{$role->id}}"
                        {{ empty(old('user-role')) ? ($role->id == $user->role_id ? 'selected' : '') :(old('user-role') == $role->id ? 'selected' : '') }}
                >
                    {{\App\Services\RoleService::getUserRoleDisplayName($role->name)}}
                </option>
            @endforeach
        </select>
    </div>

    {{ csrf_field() }}
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Upravit uživatele</button>
    </div>
</form>
@endsection
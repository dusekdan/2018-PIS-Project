@extends('admin.home')

@section('subpage-contents')

    @if ($errors->any())
        <div class="alert alert-danger">
            <h5 class="alert-heading">Přidání uživatele selhalo</h5>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (\Session::has('error'))
        <div class="alert alert-danger">
            <h5 class="alert-heading">Přidání uživatele selhalo!</h5>
            {{ \Session::get('error') }}
        </div>
    @endif

    <h4>Přidat uživatele </h4>

    <div class="alert alert-info">
        <h5 class="alert-heading">Snadnější testování!</h5>
        <strong>Čtete!</strong> Pro vyšší pohodlí při testování tohoto projektu můžete kliknout na tlačítko níže, které předvyplní testovací data do formuláře pro vytvoření nového uživatele.<br>
        <br><p><a href="#" onclick="prefillAddUserForm(); return false;" class="btn btn-info btn-xs">Vyplnit formulář testovacími daty</a></p>
    </div>


    <form method="post" action="{{ route('admin.user-management') }}">

        <div class="form-group">
            <label for="user-name" class="required">Jméno</label>
            <input
                    type="text"
                    id="user-name"
                    name="user-name"
                    title="user-name"
                    class="form-control"
                    required="required"
                    value="{{old('user-name')}}"
            >
        </div>

        <div class="form-group">
            <label for="user-email" class="required">Email</label>
            <input
                    type="text"
                    id="user-email"
                    name="user-email"
                    title="user-email"
                    class="form-control"
                    required="required"
                    value="{{old('user-email')}}"
            >
        </div>

        <div class="form-group">
            <label for="user-password" class="required">Heslo</label>
            <input
                    type="password"
                    id="user-password"
                    name="user-password"
                    title="user-password"
                    class="form-control"
                    required="required"
                    value="{{old('user-password')}}"
            >
        </div>

        <div class="form-group">
            <label for="user-password_confirmation" class="required">Heslo pro kontrolu</label>
            <input
                    type="password"
                    id="user-password_confirmation"
                    name="user-password_confirmation"
                    title="user-password_confirmation"
                    class="form-control"
                    required="required"
                    value="{{old('user-password_confirmation')}}"
            >
        </div>

        <div class="form-group">
            <label for="user-role" class="required">Role</label>
            <select name="user-role" id="user-role" title="user-role" class="form-control" required="required">
            @foreach ($roles as $role)
                <option
                        value="{{$role->id}}"
                        {{old('user-role') == $role->id ? 'selected' : '' }}
                >
                    {{\App\Services\RoleService::getUserRoleDisplayName($role->name)}}
                </option>
            @endforeach
            </select>
        </div>

        {{ csrf_field() }}
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Přidat uživatele</button>
        </div>
    </form>

    <br>
    <hr>
    <br>



    <!--
    Anchor must come before success alert, so the user can see success alert box even if the
    user list is longer than one screen.
    -->
    <a name="user-list"></a>
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <h5 class="alert-heading">Akce byla úspěšná!</h5>
            {{ \Session::get('success') }}
        </div>
    @endif

    <h4>Uživatelé systému</h4>
    <!-- Print out order list -->
    <table class="table table-striped">
        <tr>
            <th>Jméno</th>
            <th>Email</th>
            <th>Role</th>
            <th>Akce</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ \App\Services\RoleService::getUserRoleDisplayName($user->role->name) }}</td>
                <td>
                    @if (Auth::user()->id != $user->id)
                    <form class="form-inline float-left" method="post" action="{{ route('admin.user-management.delete', ['id' => $user->id]) }}">
                        <input onclick="return confirm('Jste si jistý/á, že chcete tohoto uživatele odstranit? Tuto akci nebude možné vzít zpět.')"
                               class="form-control btn-danger btn-xs" type="submit" value="Odstranit">
                        {{ csrf_field() }}
                    </form>
                    |
                    <a class="btn btn-warning btn-xs" href="{{route('admin.user-management.edit', ['id' => $user->id])}}">&nbsp;&nbsp;Upravit&nbsp;&nbsp;</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

@endsection
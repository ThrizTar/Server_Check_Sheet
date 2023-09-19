<table id="user_table" class="table" width="100%">
    <thead class="text-center">
        <tr>
            <td>No.</td>
            <td>Username</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Organize</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $key => $user)
            <tr class="text-center">
                <td>{{ ++$key }}</td>
                <td>{{ $user->username }} <input type="hidden" name="username_import" id="username_import"
                        value="{{ $user->username }}"></td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                @if ($user->organize == null)
                    <td> - </td>
                @else
                    <td>{{ $user->organize }}</td>
                @endif
                <td>
                    <button type="button"class="btn btn-primary import_user">Grant</button>
                </td>
                <td>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination justify-content-center">
    {!! $users->links() !!}
</div>

@if ($errors->any())
    <b-notification auto-close type="is-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </b-notification>
@endif
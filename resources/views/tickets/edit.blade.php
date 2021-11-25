@extends('base')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Update a ticket</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <form method="post" action="{{ route('tickets.update', $tickets->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">

                    <label for="first_name">Text:</label>
                    <input type="text" class="form-control" name="Text" value={{ $tickets->Text }} />
                </div>

                <div class="form-group">
                    <label for="last_name">Status:</label>
                    <input type="text" class="form-control" name="Status" value={{ $tickets->Status }} />
                </div>

                <div class="form-group">
                    <label for="email">Attachments:</label>
                    <input type="text" class="form-control" name="Attachments" value={{ $tickets->Attachments }} />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

    </div>
@endsection

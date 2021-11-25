@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12">

                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
            <h1 class="display-3">Tickets</h1>
            <div>
                <a style="margin: 19px;" href="{{ route('tickets.create')}}" class="btn btn-primary">New ticket</a>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>Text</td>
                    <td>Status</td>
                    <td>Attachments</td>
                    <td colspan = 2>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{$ticket->Text}}</td>
                        <td>{{$ticket->Status}}</td>
                        <td>{{$ticket->Attachments}}</td>
                        <td>
                            <a href="{{ route('tickets.edit',$ticket->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('tickets.destroy', $ticket->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        <div>
    </div>
@endsection

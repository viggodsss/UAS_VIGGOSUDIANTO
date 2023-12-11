@extends('students.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Game</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.Game.create') }}"> Create Game</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Kelas</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($Game as $Game)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $Game->Game }}</td>
            <td>{{ $Game->Developers }}</td>
            <td>
                <form action="{{ route('admin.Game.destroy',$Game->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('admin.Game.show',$Game->id) }}">Show</a>
    
                    <a class="btn btn-primary ml-2" href="{{ route('admin.Game.edit',$Game->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $students->links() !!}
      
@endsection
<!DOCTYPE html>
@extends('layout.layout')

@include('scripts.scripts')

@section('content')
    <!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content" class="mt-4">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Tasks</h1>
            <p class="mb-4">This CRUD was made to explain the implementation of repository pattern in a Laravel
                project</p>

            <!-- Success message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif

            <!-- Error messages -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Button to switch database -->
            <form method="POST" onsubmit="Loader.open()" action="{{route('change')}}">
                @csrf
                <input type="hidden" value="{{$databaseValue}}" name="is_sql" id="databaseType">
                <button type="submit" class="btn btn-outline-danger btn-lg mb-4">Switch
                    to {{$oppositeDatabase}}</button>
            </form>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-lg" title="Create task" data-toggle="modal"
                            data-target="#createTask">
                        <i class="fa fa-plus"></i>
                    </button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Duration</th>
                                <th>Is critical?</th>
                                <th>Posts</th>
                                <th>Items</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{$task->name}}</td>
                                    <td>{{$task->duration}}</td>
                                    <td>{{$task->is_critical ? 'YES' :  'NO'}}</td>
                                    <td>
                                        @forelse($task->posts as $post)
                                            <li class="ml-2">{{$post->title}}</li>
                                        @empty
                                            <li class="ml-2">No posts related</li>
                                        @endforelse
                                    </td>
                                    <td>
                                        @forelse($task->items as $item)
                                            <li class="ml-2">{{$item->name}}</li>
                                        @empty
                                            <li class="ml-2">No items related</li>
                                        @endforelse
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-3">
                                                <button title="Update task" id="updateButton" type="button"
                                                        class='btn btn-info btn-xs' data-toggle="modal"
                                                        data-target="#updateTask" value="{{$task}}">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                            </div>
                                            <div class="col-3">
                                                <form method="POST" action="{{route('tasks.destroy', [$task->id])}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button title="Delete task" type="submit"
                                                            class="btn btn-danger btn-xs"
                                                            onclick="return confirm('Are you sure you want to delete this task?')">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Guillermo Felipetti 2022</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

@include('tables.tasks.create_task', [$posts, $items])
@include('tables.tasks.update_task', [$posts, $items])

@endsection

@push('scripts')
    <script src={{asset('js/tasks.js')}}></script>
@endpush()


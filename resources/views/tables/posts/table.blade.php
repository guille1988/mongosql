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
            <h1 class="h3 mb-2 text-gray-800">Posts</h1>
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
                    <button type="button" class="btn btn-primary btn-lg" title="Create post" data-toggle="modal"
                            data-target="#createPost">
                        <i class="fa fa-plus"></i>
                    </button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Slug</th>
                                <th>Task</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->body}}</td>
                                    <td>{{$post->slug}}</td>
                                    <td>{{$post->task->name}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-6">
                                                <button title="Update post" id="updateButton" type="button"
                                                        class='btn btn-info btn-xs' data-toggle="modal"
                                                        data-target="#updatePost" value="{{$post}}">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <form method="POST" action="{{route('posts.destroy', [$post->id])}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button title="Delete post" type="submit"
                                                            class="btn btn-danger btn-xs"
                                                            onclick="return confirm('Are you sure you want to delete this post?')">
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

@include('tables.posts.create_post', $tasks)
@include('tables.posts.update_post', $tasks)

@endsection

@push('scripts')
    <script src={{asset('js/posts.js')}}></script>
@endpush()


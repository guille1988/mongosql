<!-- Modal -->

<div class="modal fade" id="createPost" tabindex="-1" role="dialog" aria-labelledby="createPostLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="createPostLabel">Create post</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <form id="createForm" method="POST" action="{{route('posts.store')}}">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                    </div>

                    <div class="form-group">
                        <label for="body">Body</label>
                        <input type="text" class="form-control" id="body" name="body" placeholder="Enter body">
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug">
                    </div>

                    <div class="form-group">
                        <label for="task">Tasks</label>
                        <select class="form-control" id="task" name="task_id">
                            <option selected disabled>Open this select menu</option>
                            @foreach($tasks as $task)
                                <option value="{{$task->id}}">{{$task->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->

<div class="modal fade" id="updatePost" tabindex="-1" role="dialog" aria-labelledby="updatePostLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="updatePostLabel">Update post</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <form method="POST" action="" id="updateForm">
                @method('PUT')
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="updateTitle">Title</label>
                        <input type="text" class="form-control" id="updateTitle" name="title">
                    </div>

                    <div class="form-group">
                        <label for="updateBody">Body</label>
                        <input type="text" class="form-control" id="updateBody" name="body">
                    </div>

                    <div class="form-group">
                        <label for="updateSlug">Slug</label>
                        <input type="text" class="form-control" id="updateSlug" name="slug">
                    </div>

                    <div class="form-group">
                        <label for="updateTask">Tasks</label>
                        <select class="form-control" id="updateTask" name="task_id">
                            @foreach($tasks as $task)
                                <option class="options" value="{{$task->id}}">{{$task->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>

                </div>
            </form>
        </div>
    </div>
</div>

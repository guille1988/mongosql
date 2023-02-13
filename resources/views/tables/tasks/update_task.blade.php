<!-- Modal -->

<div class="modal fade" id="updateTask" tabindex="-1" role="dialog" aria-labelledby="updateTaskLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="updateTaskLabel">Update task</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <form method="POST" action="" id="updateForm">
                @method('PUT')
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="updateName" name="name" placeholder="Enter name">
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" id="updateDuration" name="duration" placeholder="Enter duration">
                    </div>

                    <div class="form-group">
                        <label for="is_critical">Is critical?</label>
                        <select class="form-control" id="updateIsCritical" name="is_critical">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="updateItem">Items</label>
                        <select class="form-control" multiple id="updateItem" name="item_ids[]">
                            @foreach($items as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
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

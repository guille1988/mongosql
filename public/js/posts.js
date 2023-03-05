$(document).ready(function ()
{
    $(document).on('click', '#updateButton', function ()
    {
        let post = JSON.parse($(this).val());

        $('#updateForm').attr('action', '/posts/' + (post.id == undefined ? post._id : post.id));
        $('#updateTitle').val(post.title);
        $('#updateBody').val(post.body);
        $('#updateSlug').val(post.slug);
        $(".options").map(function () {
            if (this.innerHTML === post.task.name) return this;
        }).first().attr('selected', true);
    });

    $("#createForm").submit(function(e)
    {
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(data)
            {
                if(data.success === true)
                    location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(JSON.parse(xhr.responseText));
                console.log(ajaxOptions);
                console.log(thrownError);
            }
        });
    });
});

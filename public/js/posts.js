$(document).ready(function ()
{
    ['success', 'error'].forEach(function(result)
    {
        let item = localStorage.getItem(result);
        let selector = $('#' + result);

        if(item)
        {
            selector.removeAttr('hidden');
            selector.html(item);
            localStorage.removeItem(result);
        }
    })

    $('#updatePost').on('hidden.bs.modal', function()
    {
        let errorSelector = $('.modal-input-error');

        errorSelector.html('');
        errorSelector.attr('hidden', 'hidden');
    });

    $('#createPost').on('hidden.bs.modal', function()
    {
        let errorSelector = $('.modal-input-error');

        errorSelector.html('');
        errorSelector.attr('hidden', 'hidden');

        $('.modal-input').val('');
        $('.form-control option:contains("Open this select menu")').prop('selected', true);
    });

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
                {
                    localStorage.setItem('success', data.data);
                    location.reload();
                }
            },
            error: function(error)
            {
                if(error.status === 422)
                {
                    let allErrors = JSON.parse(error.responseText).errors;
                    let keys = Object.keys(allErrors);
                    let errors = Object.entries(allErrors);

                    keys.forEach(function(key)
                    {
                       errors.forEach(function(error)
                       {
                           if(error[0] === key)
                           {
                               let selector = $('#' + key + 'Error');
                               selector.removeAttr('hidden');
                               selector.html(error[1][0]);
                           }
                       });
                    });
                }
                else
                {
                    localStorage.setItem('error', 'Sorry, an error has occurred. Please try again');
                    location.reload();
                }
            }
        });
    });
});

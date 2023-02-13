$(document).ready(function ()
{
    let dropdowns = ['post', 'item'];

    dropdowns.map(function(dropdown)
    {
        $('#' + dropdown + ' option').mousedown(function(e)
        {
            e.preventDefault();
            $(this).prop('selected', !$(this).prop('selected'));
            return false;
        });
    } )

    $(document).on('click', '#updateButton', function () {
        let task = JSON.parse($(this).val());

        $('#updateForm').attr('action', '/tasks/' + (task.id == undefined ? task._id : task.id));
        $('#updateName').val(task.name);
        $('#updateDuration').val(task.duration);
        $.each($('#updateIsCritical option'), function()
        {
            if($(this).val() == task.is_critical)
                $(this).prop('selected', true);
        });

        function convert(model)
        {
            return model.id == undefined ? model._id : model.id.toString();
        }

        const selector = $('#updateItem option');
        $.each(selector, function()
        {
            $(this).prop('selected', false);
        });

        const fields = task.items.map(post => convert(post));

        $.each(selector, function()
        {
            if(fields.includes($(this).val()))
                $(this).prop('selected', true);
        });
    });
});

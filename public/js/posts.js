$(document).ready(function () {
    $(document).on('click', '#updateButton', function () {
        let post = JSON.parse($(this).val());

        $('#updateForm').attr('action', '/posts/' + (post.id == undefined ? post._id : post.id));
        $('#updateTitle').val(post.title);
        $('#updateBody').val(post.body);
        $('#updateSlug').val(post.slug);
        $(".options").map(function () {
            if (this.innerHTML === post.task.name) return this;
        }).first().attr('selected', true);
    });
});

$(document).ready(function () {
    $('.form--delete-post').submit(onSubmitDeletePostForm);
});

function onSubmitDeletePostForm(e) {
    if (confirm('postをDeleteTo場合はOKボタンを押してください。')) {
        return true;
    }
    e.preventDefault();
    return false;
}

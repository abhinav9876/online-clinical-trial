$(document).ready(function () {
    $('.form--edit-status-post').submit(onSubmitStatusPostForm);
});

function onSubmitStatusPostForm(e) {
    if (confirm('postをDeleteTo場合はOKボタンを押してください。')) {
        return true;
    }
    e.preventDefault();
    return false;
}

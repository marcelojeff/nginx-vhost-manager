var configureModal = function(modal, title, body) {
    var modalTitle = modal.find('h4[data-selector="modal-title"]');
    var modalBody = modal.find('div[data-selector="modal-body-container"]');
    modalTitle.html(title);
    modalBody.html(body);
    return modal;
}
var configureForm = function(form, action) {
    form.attr('action', baseUrl + action);
    return form;
}
$(document).ready(function(){
    var modalForm = $('#modal-form');
    var modal = $('div[data-selector="modal-editor"]');
    modalForm.submit(function(e){
        e.preventDefault();
        var form = $(this);
        $.post(form.attr('action'), form.serialize(), function(result) {
            if (result) {
                modal.modal('toggle');
            } else {
                console.log(result);
            }
        });
    });
    $('a[data-selector="edit-file"').click(function (e) {
        e.preventDefault();
        var btn = $(this);
        var url = baseUrl + 'view-file-content';
        var fileName = btn.attr('href');
        $.get(url, {file: fileName}, function(result){
            var source = $('#content-editor-template').html();
            var template = Handlebars.compile(source);
            var data = {content: result.content, filename: fileName};
            configureForm(modalForm, 'save-vhost');
            configureModal(modal, fileName, template(data));
            modal.modal();
        });
    });
    $('a[data-selector="create-vhost-btn"]').click(function (e) {
        e.preventDefault();
        var btn = $(this);
        var url = baseUrl + 'view-file-content';
    });
});

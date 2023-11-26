let $resetPage = {};
let $formValidator = $.extend({}, $validator);

$resetPage.validationInit = function () {
    $('form').submit(function (e) {
        e.preventDefault();

        $formValidator.attemptToValidate(event.target.action, $(this).serialize(), function (action) {

            if ($('form').attr('id') === 'email-reset') {
                window.location.href = '/reset/email/confirm'
            } else {
                window.location.href = '/reset/successful';
            }

        });
    });
}

$resetPage.init = function () {
    $resetPage.validationInit();
}

$resetPage.init();

let $validator = {};
$validator.errors = {};

$validator.getInputsOriginalPlaceHolders = function () {
    $inputsOriginalPlaceHolderNames = {};

    $allInputs = $('.form-input');

    $allInputs.each(function (){
        $currentInput = $(this);
        $currentInputName = $(this).attr('name');
        $currentInputOriginalPlaceHolderName = $(this).attr('placeholder');
        $inputsOriginalPlaceHolderNames[$currentInputName] = $currentInputOriginalPlaceHolderName;
    })

    return $inputsOriginalPlaceHolderNames
}

$validator.inputsOriginalPlaceHolders = $validator.getInputsOriginalPlaceHolders();

$validator.setErrors = function ($errors) {
    $validator.errors = $errors;
}

$validator.getErrors = function () {
    return $validator.errors;
}

$validator.getInvalidInputs = function ($errors) {

    $invalidInputFields = [];

    for (const $errorsKey of Object.keys($errors)) {
        $inputFields = $(`input[name$=${$errorsKey}]`)

        // $invalidInputFields.push($inputField);


        // if you have not made inputs with duplicated name attributes you can just comment this if,else block and uncomment commented part on above

        if ($inputFields.length > 1) {
            $inputFields.each(function (index, item) {
                $inputField = $(this);
                $(this).parentsUntil($('.register-form')).each(function (index) {
                    if ($(this).is(':visible')) {
                        $invalidInputFields.push($inputField);
                    }
                })
            })
        } else {
            $invalidInputFields.push($inputFields);
        }
    }

    return $invalidInputFields;
}

$validator.drawErrorWarnings = function () {
    $errors = $validator.getErrors();
    $allInputs = $('.form-input');
    $inavlidInputFields = $validator.getInvalidInputs($errors)
    $inputsOriginalPlaceHolderNames = $validator.inputsOriginalPlaceHolders;

    $allInputs.each(function (){
        $currentInput = $(this);
        $currentInputName = $(this).attr('name');
        $inputErrorMessage = $errors[$currentInputName];
        $currentInput.css({border: 'none'});
        $currentInput.removeClass('invalid-input');
        $currentInput.attr("placeholder", $inputsOriginalPlaceHolderNames[$currentInputName]);

        for (const $invalidInput of $invalidInputFields) {
            if ($currentInput[0] === $invalidInput[0]) {
                $currentInput.val("");
                $currentInput.attr("placeholder", `${$inputErrorMessage}`);
                $currentInput.css({border:'1px solid red'});
                $currentInput.addClass('invalid-input')
            }
        }
    })
}

$validator.removeErrorWarnings = function () {
    $('.form-input').each(function (){
        $currentInputName = $(this).attr('name');
        $currentInput = $(this);
        $currentInput.css({border: 'none'})
        $currentInput.attr("placeholder", $validator.inputsOriginalPlaceHolders[$currentInputName]);
        $currentInput.removeClass('invalid-input');
    })
}

$validator.attemptToValidateSetup = function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

$validator.attemptToValidate = function ($action, $values, $onSuccessCallBack, $files = false) {
    this.attemptToValidateSetup();

    $.ajax({
        type: "POST",
        url: $action,
        data: $values,
        dataType: 'json',
    })
        .done(function ($response) {
            if ($response.status === 'INVALID_DATA') {
                $validator.setErrors($response.errors);
                $validator.drawErrorWarnings();
            } else {
                $validator.removeErrorWarnings();
                $onSuccessCallBack();
            }
        });

}



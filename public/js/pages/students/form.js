

/* global form_utilities, userid, mode */

(function () {
    $(document).ready(function () {
        initializeUI();
        initializeForm();
    });

    function initializeUI() {
        $('[name=bday]').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
        }).on('change', function () {
            var birthday = $(this).datepicker('getDate');
            var ageDifMs = Date.now() - birthday.getTime();
            var ageDate = new Date(ageDifMs); // miliseconds from epoch

            $('[name=age]').val(Math.abs(ageDate.getUTCFullYear() - 1970));

        });
    }

    function initializeForm() {
        form_utilities.moduleUrl = "/students";
        form_utilities.updateObjectId = sn;
        form_utilities.onSaveMessage = "Student Saved";
        form_utilities.validate = true;

        form_utilities.initializeDefaultProcessing($('.fields-container'));
        form_utilities.errorHandler = function (errorMessage) {

            //  default to the error message if a conversion is not available
            var humanReadableErrorMessage = errorMessage;

            if (errorMessage.indexOf("SN_UNIQUE") > -1 || (errorMessage.indexOf("Duplicate entry") > -1 && errorMessage.indexOf("PRIMARY") > -1)) {
                humanReadableErrorMessage = "A student with the same student number already exists";
                form_utilities.setFieldError('SN', humanReadableErrorMessage);
            }

            swal("Error!", humanReadableErrorMessage, "error");
        };
    }
})();

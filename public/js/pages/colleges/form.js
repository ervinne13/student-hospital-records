

/* global form_utilities, collegeid, mode */

(function () {
    $(document).ready(function () {
        form_utilities.moduleUrl = "/colleges";
        form_utilities.updateObjectId = collegeid;
        form_utilities.onSaveMessage = "College Saved";
        form_utilities.validate = true;

        form_utilities.initializeDefaultProcessing($('.fields-container'));
        form_utilities.errorHandler = function (errorMessage) {

            //  default to the error message if a conversion is not available
            var humanReadableErrorMessage = errorMessage;

            if (errorMessage.indexOf("college_UNIQUE") > -1) {
                humanReadableErrorMessage = "College code already registered";
                form_utilities.setFieldError('college', humanReadableErrorMessage);
            }

            swal("Error!", humanReadableErrorMessage, "error");
        };
    });
})();

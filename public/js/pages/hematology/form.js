

/* global form_utilities, userid, mode */

(function () {
    $(document).ready(function () {
        initializeUI();
        initializeForm();
    });

    function initializeUI() {
        $("[data-mask]").inputmask();
    }

    function initializeForm() {
        form_utilities.moduleUrl = "/hematology";
        form_utilities.updateObjectId = id;
        form_utilities.onSaveMessage = "Hematology Record Saved";
        form_utilities.validate = true;

        form_utilities.initializeDefaultProcessing($('.fields-container'));
        form_utilities.errorHandler = function (errorMessage) {

            //  default to the error message if a conversion is not available
            var humanReadableErrorMessage = errorMessage;

            if (errorMessage.indexOf("pSN") > -1 || errorMessage.indexOf("SN") > -1) {

                humanReadableErrorMessage = "Invalid";

                if (errorMessage.indexOf("fk_tbl_xray_tbl_studentlist1") > -1) {
                    humanReadableErrorMessage = "Invalid student number, this student number might not be existing";
                } else if (errorMessage.indexOf("Incorrect integer value") > -1) {
                    humanReadableErrorMessage = "Incorrect integer value";
                }

                form_utilities.setFieldError('SN', humanReadableErrorMessage);

            }

            swal("Error!", humanReadableErrorMessage, "error");
        };
    }
})();
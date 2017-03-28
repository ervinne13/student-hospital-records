

/* global form_utilities, userid, mode */

(function () {
    $(document).ready(function () {
        initializeUI();
        initializeForm();
        
        if (mode == "VIEW") {
            $('.form-control').prop('disabled', true);
        }
        
    });

    function initializeUI() {
        $("[data-mask]").inputmask();
    }

    function initializeForm() {
        form_utilities.moduleUrl = "/pe";
        form_utilities.updateObjectId = id;
        form_utilities.onSaveMessage = "Physical Exam Record Saved";
        form_utilities.validate = true;

        form_utilities.initializeDefaultProcessing($('.fields-container'));
        form_utilities.errorHandler = function (errorMessage) {

            //  default to the error message if a conversion is not available
            var humanReadableErrorMessage = errorMessage;

            if (errorMessage.indexOf("pSN") > -1 || errorMessage.indexOf("SN") > -1) {

                humanReadableErrorMessage = "Invalid";

                if (errorMessage.indexOf("fk_tbl_vitalsigns_tbl_studentlist1") > -1) {
                    humanReadableErrorMessage = "Invalid student number, this student number might not be existing";
                } else if (errorMessage.indexOf("Incorrect integer value") > -1) {
                    humanReadableErrorMessage = "Incorrect integer value";
                }

                form_utilities.setFieldError('SN', humanReadableErrorMessage);

            } else if (errorMessage.indexOf("fk_tbl_vitalsigns_tbl_physicianaccount1") > -1) {
                humanReadableErrorMessage = "Invalid physician license no., make sure that the physician is registered.";
                form_utilities.setFieldError('license_no', humanReadableErrorMessage);
            } else if (errorMessage.indexOf('plicense_no') > -1 && errorMessage.indexOf('Incorrect integer value') > -1) {
                humanReadableErrorMessage = "Incorrect integer value";
                form_utilities.setFieldError('license_no', humanReadableErrorMessage);
            }

            swal("Error!", humanReadableErrorMessage, "error");
        };
    }
})();

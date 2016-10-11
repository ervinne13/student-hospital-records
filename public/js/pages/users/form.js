

/* global form_utilities, userid, mode */

(function () {
    $(document).ready(function () {
        form_utilities.moduleUrl = "/users";
        form_utilities.updateObjectId = userid;
        form_utilities.onSaveMessage = "User Account Saved";
        form_utilities.validate = true;

        form_utilities.initializeDefaultProcessing($('.fields-container'));
        form_utilities.errorHandler = function (errorMessage) {

            //  default to the error message if a conversion is not available
            var humanReadableErrorMessage = errorMessage;

            if (errorMessage.indexOf("Passwords do not match") > -1) {
                humanReadableErrorMessage = "Passwords do not match";

                if (mode == "ADD") {
                    form_utilities.setFieldError('password', humanReadableErrorMessage);
                    form_utilities.setFieldError('password_repeat', humanReadableErrorMessage);
                } else {
                    form_utilities.setFieldError('new_password', humanReadableErrorMessage);
                    form_utilities.setFieldError('new_password_repeat', humanReadableErrorMessage);
                }

            } else if (errorMessage.indexOf("fk_tbl_useraccount_tbl_usertype1") > -1) {
                humanReadableErrorMessage = "Invalid User Type";
                form_utilities.setFieldError('usertype', humanReadableErrorMessage);
            } else if (errorMessage.indexOf("username_UNIQUE") > -1) {
                humanReadableErrorMessage = "Username already registered";
                form_utilities.setFieldError('username', humanReadableErrorMessage);
            } else if (errorMessage.indexOf("Incorrect Password") > -1) {
                humanReadableErrorMessage = "Incorrect Password";
                form_utilities.setFieldError('password', humanReadableErrorMessage);
            }

            swal("Error!", humanReadableErrorMessage, "error");
        };
    });
})();

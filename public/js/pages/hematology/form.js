

/* global form_utilities, userid, mode, hematologyRef */

(function () {

    var hematologyCriteria;

    $(document).ready(function () {

        initializeCriteria();

        initializeUI();
        initializeForm();
        initializeEvents();
    });

    function initializeCriteria() {
        hematologyCriteria = {};
        hematologyRef = JSON.parse(hematologyRef);
        for (var i in hematologyRef) {
            hematologyCriteria[hematologyRef[i]["com_bld_count"]] = {
                min: hematologyRef[i]["normal_min"],
                max: hematologyRef[i]["normal_max"],
            };
        }

    }

    function initializeUI() {
        $("[data-mask]").inputmask();
    }

    function initializeEvents() {
        $('#gender').change(displayWarnings);
        $('.has-criteria').change(displayWarnings);
    }

    function displayWarnings() {

        $('.has-criteria').each(function () {
            var value = $(this).val();
            var name = $(this).attr('name');
            var comp = $(this).data('comp');

            var $container = $(this).parent();
            var $label = $container.find('label');

            $container.removeClass('has-warning');
            $label.text($label.data('original-label'));

            if (!comp) {
                comp = name.toUpperCase();
            }

            if (["hemoglobin", "hematocrit", "red_blood"].indexOf(name) > -1) {
                comp += "_" + $('#gender').val();
            }

            console.log(comp);
            var min = hematologyCriteria[comp]["min"];
            var max = hematologyCriteria[comp]["max"];

            if (value < min || value > max) {
                $container.addClass('has-warning');
                $label.data('original-label', $label.text());
                $label.text($label.text() + ' (Not Normal)');
            }

        });

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

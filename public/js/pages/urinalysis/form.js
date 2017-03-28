

/* global form_utilities, userid, mode, urinalysisRef */

(function () {

    var urinalysisCriteria;

    $(document).ready(function () {
        initializeUI();
        initializeForm();
        prepareCriteria();
        initializeEvents();
        
        if (mode == "VIEW") {
            $('.form-control').prop('disabled', true);
        }
    });

    function prepareCriteria() {
        urinalysisCriteria = {};
        urinalysisRef = JSON.parse(urinalysisRef);
        for (var i in urinalysisRef) {
            urinalysisCriteria[urinalysisRef[i]["scopic_exam"]] = {
                min: urinalysisRef[i]["normal_min"],
                max: urinalysisRef[i]["normal_max"]
            };
        }

    }

    function initializeEvents() {
        $('[name=color]').change(function () {
            var $container = $(this).parent();
            var val = $(this).val().toUpperCase();

            $container.removeClass('has-warning');
            $container.find('label').text('Color');

            if (val != urinalysisCriteria["COLOR"]["min"] && val != urinalysisCriteria["COLOR"]["max"]) {
                $container.addClass('has-warning');
                $container.find('label').text('Color (Not Normal)');
            }

        });

        $('[name=transparency]').change(function () {
            var $container = $(this).parent();
            var val = $(this).val().toUpperCase();

            $container.removeClass('has-warning');
            $container.find('label').text('Transparency');

            if (val != urinalysisCriteria["TRANSPARENCY"]["min"] && val != urinalysisCriteria["TRANSPARENCY"]["max"]) {
                $container.addClass('has-warning');
                $container.find('label').text('Transparency (Not Normal)');
            }

        });

        $('[name=reaction]').change(function () {
            var $container = $(this).parent();
            var val = $(this).val();

            $container.removeClass('has-warning');
            $container.find('label').text('Reaction');

            if (parseFloat(val) < urinalysisCriteria["REACTION"]["min"] || parseFloat(val) > urinalysisCriteria["REACTION"]["max"]) {
                $container.addClass('has-warning');
                $container.find('label').text('Reaction (Not Normal)');
            }

        });

        $('[name=sp_gravity]').change(function () {
            var $container = $(this).parent();
            var val = $(this).val();

            $container.removeClass('has-warning');
            $container.find('label').text('SP Gravity');

            console.log(parseFloat(val) < parseFloat(urinalysisCriteria["SP_GRAVITY"]["min"]));
            console.log(parseFloat(val) > parseFloat(urinalysisCriteria["SP_GRAVITY"]["max"]));
            console.log(parseFloat(val));
            console.log(parseFloat(urinalysisCriteria["SP_GRAVITY"]["min"]));
            console.log(parseFloat(urinalysisCriteria["SP_GRAVITY"]["max"]));

            if (parseFloat(val) < parseFloat(urinalysisCriteria["SP_GRAVITY"]["min"]) || parseFloat(val) > parseFloat(urinalysisCriteria["SP_GRAVITY"]["max"])) {
                $container.addClass('has-warning');
                $container.find('label').text('SP Gravity (Not Normal)');
            }

        });

        $('[name=sugar]').change(function () {
            var $container = $(this).parent();
            var val = $(this).val().toUpperCase();

            $container.removeClass('has-warning');
            $container.find('label').text('Sugar');

            if (val != urinalysisCriteria["SUGAR"]["min"] && val != urinalysisCriteria["SUGAR"]["max"]) {
                $container.addClass('has-warning');
                $container.find('label').text('Sugar (Not Normal)');
            }

        });

        $('[name=protein]').change(function () {
            var $container = $(this).parent();
            var val = $(this).val().toUpperCase();

            $container.removeClass('has-warning');
            $container.find('label').text('Protein');

            if (val != urinalysisCriteria["PROTEIN"]["min"] && val != urinalysisCriteria["PROTEIN"]["max"]) {
                $container.addClass('has-warning');
                $container.find('label').text('Protein (Not Normal)');
            }

        });
    }

    function initializeUI() {
        $("[data-mask]").inputmask();
    }

    function initializeForm() {
        form_utilities.moduleUrl = "/urinalysis";
        form_utilities.updateObjectId = id;
        form_utilities.onSaveMessage = "Urinalysis Record Saved";
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

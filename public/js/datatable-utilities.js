
/* global _ */

var datatable_utilities = {};

/**
 * Requires #template-table-inline-actions
 * @param {type} actions
 * @returns {undefined}
 */
datatable_utilities.getInlineActionsView = function (actions) {

    var template = _.template($('#template-table-inline-actions').html());

    return template({actions: actions});

};

datatable_utilities.getDefaultViewAction = function (id) {
    return {
        id: id,
        href: window.location.href + "/" + id,
        name: "view",
        displayName: "View",
        icon: "fa-search"
    };
};

datatable_utilities.getDefaultEditAction = function (id) {
    return {
        id: id,
        href: window.location.href + "/" + id + "/edit",
        name: "edit",
        displayName: "Edit",
        icon: "fa-pencil"
    };
};


datatable_utilities.getDefaultDeleteAction = function (id) {
    return {
        id: id,
        href: window.location.href + "/" + id,
        name: "delete",
        displayName: "Delete",
        icon: "fa-times"
    };
};


//<editor-fold defaultstate="collapsed" desc="Actions">
datatable_utilities.initializeDeleteAction = function () {

    $(document).on('click', '.action-delete', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        var url = window.location.href + "/" + id;

        swal({
            title: "Are you sure?",
            text: "This record will be permanently deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }).then(function () {
            $.ajax({
                url: url,
                type: "DELETE",
                success: function (response) {
                    console.log(response);
                    swal("Success", "Record deleted", "success");

                    setTimeout(function () {
                        location.reload();
                    }, 1500);

                },
                error: function (response) {
                    console.error(response);
                    swal("Error", response.responseText, "error");
                }
            });
        });
    });


};
//</editor-fold>

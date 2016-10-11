
/* global datatable_utilities */

(function () {

    $(document).ready(function () {
        initializeTable();
    });

    function initializeTable() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: {
                url: "/colleges/datatable"
            },
            order: [1, "desc"],
            columns: [
                {data: 'collegeid'},
                {data: 'collegeid'},
                {data: 'college'},
                {data: 'collegedesc'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0]},
                {orderable: false, targets: [0]},
                {
                    targets: 0,
                    render: function (id, type, rowData, meta) {

                        var editAction = datatable_utilities.getDefaultEditAction(id);
//                        var viewAction = datatable_utilities.getDefaultViewAction(id);
//                        var view = datatable_utilities.getInlineActionsView([viewAction, editAction]);
                        var view = datatable_utilities.getInlineActionsView([editAction]);

                        return view;
                    }
                }
            ]
        });
    }

})();

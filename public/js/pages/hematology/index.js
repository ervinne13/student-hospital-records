
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
                url: "/hematology/datatable"
            },
            order: [1, "desc"],
            columns: [
                {data: 'SY'},
                {data: 'SY'},
                {data: 'sem'},
                {data: 'SN'},
                {data: 'date_saved'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0]},
                {orderable: false, targets: [0]},
                {
                    targets: 0,
                    render: function (sy, type, rowData, meta) {

                        var id = rowData.SY + "|" + rowData.sem + "|" + rowData.SN;

                        var editAction = datatable_utilities.getDefaultEditAction(id);
                        var view = datatable_utilities.getInlineActionsView([editAction]);

                        return view;
                    }
                }
            ]
        });
    }

})();

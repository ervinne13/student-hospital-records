
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
                url: "/logs/datatable"
            },
            order: [1, "desc"],
            columns: [
                {data: 'logno'},
                //{data: 'logno'},
//                {data: 'userid', name: 'tbl_useraccount.userid'},
                {data: 'complete_name', name: 'tbl_useraccount.complete_name'},
                {data: 'logdesc'},
                {data: 'logdate'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0]},
                {orderable: false, targets: [0]},
                {
                    targets: 0,
                    render: function (id, type, rowData, meta) {

                        var viewAction = datatable_utilities.getDefaultViewAction(id);
                        var view = datatable_utilities.getInlineActionsView([viewAction]);

                        return view;
                    }
                }
            ]
        });
    }

})();

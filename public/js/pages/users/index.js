
/* global datatable_utilities */

(function () {

    $(document).ready(function () {
        initializeTable();
        datatable_utilities.initializeDeleteAction();
    });

    function initializeTable() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: {
                url: "/users/datatable"
            },
            order: [1, "desc"],
            columns: [
                {data: 'userid'},
                {data: 'username'},
                {data: 'complete_name'},
                {data: 'userdesc', name: 'userdesc'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0]},
                {orderable: false, targets: [0]},
                {
                    targets: 0,
                    render: function (id, type, rowData, meta) {

                        var view = datatable_utilities.getDefaultViewAction(id);
                        var actions = [view];

                        if (username == "Administrator") {
                            actions.push(datatable_utilities.getDefaultEditAction(id));
                        }

                        if (rowData.username != "Administrator") {
                            actions.push(datatable_utilities.getDefaultDeleteAction(id));
                        }

                        var view = datatable_utilities.getInlineActionsView(actions);

                        return view;
                    }
                }
            ]
        });
    }

})();

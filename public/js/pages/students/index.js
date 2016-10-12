
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
                url: "/students/datatable"
            },
            order: [1, "desc"],
            columns: [
                {data: 'SN'},
                {data: 'SN'},
                {data: 'first_name', name: 'first_name'},
                {data: 'age'},
                {data: 'college', name: 'tbl_college.college'},
                {data: 'course'},                                
                {data: 'yearlevel'},
                {data: 'status'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0]},
                {orderable: false, targets: [0]},
                {
                    targets: 0,
                    render: function (id, type, rowData, meta) {

                        var editAction = datatable_utilities.getDefaultEditAction(id);
                        var view = datatable_utilities.getInlineActionsView([editAction]);

                        return view;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, rowData, meta) {
                        return rowData.first_name + " " + rowData.last_name;
                    }
                },
                {
                    targets: 6,
                    render: function (level, type, rowData, meta) {
                        switch (level) {
                            case 1:
                                return "1st Year";
                            case 2:
                                return "2nd Year";
                            case 3:
                                return "3rd Year";
                            case 4:
                                return "4th Year";
                            case 5:
                                return "5th Year";
                        }
                    }
                },
                {
                    targets: 7,
                    render: function (data, type, rowData, meta) {
                        if (data == 0) {
                            return "Healthy";
                        } else {
                            return "Has Illness";
                        }
                    }
                },
            ]
        });
    }

})();

var slectedTable = $("#datatable-selected").length && $("#datatable-selected").DataTable({
    select: "multi",
    dom: "Blfrtip",
    buttons: [
        {
            extend: 'excel',
            text: 'Excel',
            className: 'btn-sm',
            filename: 'Reports',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            }
        },
        {
            extend: 'csv',
            text: 'CSV',
            className: 'btn-sm',
            filename: 'Reports',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            }
        },
        {
            extend: 'pdf',
            text: 'PDF',
            className: 'btn-sm',
            filename: 'Reports',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            }
        },
        {
            extend: 'print',
            text: 'Print',
            className: 'btn-sm',
            filename: 'Reports',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            }
        },
        {text: "<i class='fa fa-check text-default'></i> Select all", className: "btn-sm", action: function () {
            slectedTable.rows().select();
        }},
        {text: "<i class='fa fa-times text-default'></i> Select none", className: "btn-sm", action: function () {
            slectedTable.rows().deselect();
        }},
    ],
    lengthMenu: [
        [5, 10, 25, 50, -1 ],
        ['5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
    responsive: true
})


var handleDataTableButtons = function () {
    "use strict";
    0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
        dom: "Blfrtip",
        buttons: [
            // {
            //     extend: 'pageLength',
            //     className: 'btn-sm btn-success',
            // },
            {
                extend: 'excel',
                text: 'Excel',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
        ],
        lengthMenu: [
            [5, 10, 25, 50, -1 ],
            ['5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        responsive: !0
    })
}, TableManageButtons = function () {
    "use strict";
    return {
        init: function () {
            handleDataTableButtons()
        }
    }
}();

var handleDataTableButtons2 = function () {
    "use strict";
    0 !== $("#datatable-buttons2").length && $("#datatable-buttons2").DataTable({
        dom: "Blfrtip",
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
        ],
        lengthMenu: [
            [5, 10, 25, 50, -1 ],
            ['5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        responsive: !0
    })
}, TableManageButtons2 = function () {
    "use strict";
    return {
        init: function () {
            handleDataTableButtons2()
        }
    }
}();

var handleDataTableButtons3 = function () {
    "use strict";
    0 !== $("#datatable-buttons3").length && $("#datatable-buttons3").DataTable({
        dom: "Blfrtip",
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn-sm',
                filename: 'Reports',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
        ],
        lengthMenu: [
            [5, 10, 25, 50, -1 ],
            ['5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        responsive: !0
    })
}, TableManageButtons3 = function () {
    "use strict";
    return {
        init: function () {
            handleDataTableButtons3()
        }
    }
}();
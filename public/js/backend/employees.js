(function () {

FTX.Employees = {

    list: {
    
        selectors: {
            employees_table: $('#employees-table'),
        },
    
        init: function () {

            this.selectors.employees_table.dataTable({

                processing: false,
                serverSide: true,
                ajax: {
                    url: this.selectors.employees_table.data('ajax_url'),
                    type: 'post',
                    data: { status: 1, trashed: false }
                },
                columns: [

                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'company', name: 'company' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'actions', name: 'actions', searchable: false, sortable: false }
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                "createdRow": function (row, data, dataIndex) {
                    FTX.Utils.dtAnchorToForm(row);
                }
            });
        }
    },

    edit: {
        init: function (locale) {
            FTX.tinyMCE.init(locale);                
        }
    },
}
})();                    
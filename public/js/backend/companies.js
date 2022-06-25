(function () {

    FTX.Pages = {

        list: {
        
            selectors: {
                pages_table: $('#pages-table'),
            },
        
            init: function () {

                this.selectors.pages_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.pages_table.data('ajax_url'),
                        type: 'post',
                        data: { status: 1, trashed: false }
                    },
                    columns: [

                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'telephone', name: 'telephone' },
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
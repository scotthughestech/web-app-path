// Make sure the page is finished loading
$(document).ready(function () {
    // Fetch data via AJAX
    $.getJSON(site_url('browse/fetch'), function (data) {
        $('#purchases').DataTable({
            data: data,
            columns: [
                {
                    data: 'date',
                    title: 'Date'
                },
                {
                    data: 'price',
                    title: 'Price'
                },
                {
                    data: 'description',
                    title: 'Description'
                },
                {
                    data: 'category_id',
                    title: 'Category',
                    render: function (data) {
                        return getName(data);
                    }
                },
                {
                    data: 'id',
                    title: 'Edit',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal" data-id="' + data + '" aria-label="Edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
                    }
                }
            ],
            order: [[0, "desc"]]
        });
        $('#loading').hide();
    });

    // Set up our view model
    var myViewModel = {
        date: ko.observable(),
        price: ko.observable(),
        description: ko.observable(),
        category_id: ko.observable(),
        id: ko.observable(),
        savePurchase: function () {
            var data = ko.toJSON(myViewModel);
            $.post(site_url('browse/save'), data, function (message) {
                if (message === 'Success') {
                    // Load up the table api
                    var table = $('#purchases').DataTable();

                    // Get the row using the id
                    var row = table.row('#id_' + myViewModel.id());

                    // Set up the data
                    data = {
                        date: myViewModel.date(),
                        price: myViewModel.price(),
                        description: myViewModel.description(),
                        category_id: myViewModel.category_id()
                    };

                    // Set the data from the observables
                    row.data( data );

                    // Redraw the table
                    table.draw();

                    // Toggle the modal
                    $('#editModal').modal('toggle');
                }
            });
        }
    };

    // Activate Knockout
    ko.applyBindings(myViewModel);

    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        // Load up table api
        var table = $('#purchases').DataTable();

        // Get the row using the id
        var row = table.row('#id_' + id);

        // Get the data (purchase) from the row
        var purchase = row.data();

        // Update observables
        myViewModel.date(purchase.date);
        myViewModel.price(purchase.price);
        myViewModel.description(purchase.description);
        myViewModel.category_id(purchase.category_id);
        myViewModel.id(purchase.id);
    });
});
// Make sure the page is finished loading
$( document ).ready( function() {
    // Fetch data via AJAX
    $.getJSON(site_url('browse/fetch'), function(data) {
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
                    data: 'name',
                    title: 'Category'
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
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        
        // Set up post variable
        var post = {};
        post.id = id;
        
        //Get JSON of post
        json = ko.toJSON(post);
        
        // Post to our browse/load controller function
        $.post(site_url('browse/load'), json, function(purchase) {
            console.log(purchase);
        });
    });
});
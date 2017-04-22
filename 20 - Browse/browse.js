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
                }
            ],
            order: [[0, "desc"]]
        });
    });
});
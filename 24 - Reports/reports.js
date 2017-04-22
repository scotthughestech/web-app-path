// Make sure the page is finished loading
$( document ).ready( function() {
    // Set up chart
    chart = new Morris.Line({
        element: 'myfirstchart',
        data: [],
        xkey: 'date',
        ykeys: ['price'],
        labels: ['Total']
    });
    $.getJSON(site_url('reports/fetch'), function (data) {
        chart.setData(data);
        $('#loading').hide();
    });
    // Set up view model
    var myViewModel = {
        from: ko.observable(),
        to: ko.observable(),
        filterChart: function (formElement) {
            // Show the spinner
            $('#loading').show();
            
            // Get json of the data
            json = ko.toJSON(myViewModel);
            // Post json to controller
            $.post(site_url('reports/fetchd'), json, function (data) {
                $('#loading').hide();
                if (data !== 'problem') {
                    $('#invalid').hide();
                    chart.setData(data);
                } else {
                    $('#invalid').show();
                }
            });
        }
    };
    // Activate Knockout
    ko.applyBindings(myViewModel);
});
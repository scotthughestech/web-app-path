function getToday() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; // January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    return yyyy + '-' + mm + '-' + dd;
}

// Make sure the page is finished loading
$( document ).ready( function() {
    // Set up our view model
    var myViewModel = {
        date: ko.observable(getToday()),
        price: ko.observable(),
        description: ko.observable(),
        category_id: ko.observable(),
        savePurchase: function() {
            var data = ko.toJSON(myViewModel);
            $.post(site_url('add/save'), data, function(message) {
                if (message === 'Success') {
                    myViewModel.date(getToday());
                    myViewModel.price('');
                    myViewModel.description('');
                    myViewModel.category_id(1);
                }
            });
        }
    };
    // Activate Knockout
    ko.applyBindings(myViewModel);
});
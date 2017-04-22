// Make sure the page is finished loading
$( document ).ready( function() {
    // Set up our view model
    var myViewModel = {
        inputEmail: ko.observable(''),
        inputPassword: ko.observable(''),
        shouldShowAlert: ko.observable(false),
        doLogin: function() {
            // Convert model to JSON
            var data = ko.toJSON(this);
            // Post the data using AJAX
            $.post(site_url('welcome/login'), data, function(message) {
                if (message === 'good') {
                    // Redirect to app/index controller
                    url = site_url('app/index');
                    window.location.replace(url);
                } else {
                    myViewModel.shouldShowAlert(true);
                }
            });
        }
    };
    // Activate Knockout
    ko.applyBindings(myViewModel);
});
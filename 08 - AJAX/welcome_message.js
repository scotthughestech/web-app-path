// Make sure the page is finished loading
$( document ).ready( function() {
    // Set up our view model
    var myViewModel = {
        inputEmail: ko.observable(''),
        inputPassword: ko.observable(''),
        doLogin: function() {
            // Convert model to JSON
            var data = ko.toJSON(this);
            // Post the data using AJAX
            $.post(site_url('welcome/login'), data, function(message) {
                
            });
        }
    };
    // Activate Knockout
    ko.applyBindings(myViewModel);
});
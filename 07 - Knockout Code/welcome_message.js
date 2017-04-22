// Make sure the page is finished loading
$( document ).ready( function() {
    // Set up our view model
    var myViewModel = {
        inputEmail: ko.observable(''),
        inputPassword: ko.observable(''),
        doLogin: function() {
            alert('form submitted');
        }
    };
    // Activate Knockout
    ko.applyBindings(myViewModel);
});
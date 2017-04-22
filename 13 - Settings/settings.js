// Make sure the page is finished loading
$( document ).ready( function() {
    // Set up our view model
    var myViewModel = {
        favorite: ko.observable(''),
        saveSettings: function() {
            var data = ko.toJSON(this);
            $.post(site_url('app/savesettings'), data, function(message) {
                alert(message)
            });
        }
    };
    // Activate Knockout
    ko.applyBindings(myViewModel);
});
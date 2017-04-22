// Make sure the page is finished loading
$( document ).ready( function() {
    // Fetch current settings from database
    $.getJSON(site_url('settings/getsettings'), function(settings) {
        // Set up our view model
    var myViewModel = {
        favorite: ko.observable(settings.favorite),
        saveSettings: function() {
            var data = ko.toJSON(this);
            $.post(site_url('settings/savesettings'), data, function(message) {
                //alert(message)
            });
        }
    };
    // Activate Knockout
    ko.applyBindings(myViewModel);
    });   
});
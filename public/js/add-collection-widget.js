// add-collection-widget.js
jQuery(document).ready(function () {
    jQuery('.add-another-collection-widget').click(function () {
        var list = $('#char_guns');
        // Try to find the counter of the list or use the length of the list
        console.log(list);
        var counter = list.data('widget-counter') || list.children().length;
        console.log(counter);
        // grab the prototype template
        var newWidget = list.attr('data-prototype');

        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, counter);
        console.log(newWidget);
        // Increase the counter
        counter++;
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data('widget-counter', counter);

        // create a new list element and add it to the list
        list.append(newWidget);
    });
});
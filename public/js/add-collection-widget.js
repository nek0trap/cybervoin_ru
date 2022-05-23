// add-collection-widget.js
jQuery(document).ready(function () {
    jQuery('.add-another-weapon').click(function () {
        var list = $('#char_guns');
        var counter = list.data('widget-counter') || list.children().length + 1;
        var newWidget = list.attr('data-prototype');
        newWidget = newWidget.replace(/__name__label__/g, "Gun " + counter);
        newWidget = newWidget.replace(/__name__/g, counter);

        counter++;
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data('widget-counter', counter);
        // create a new list element and add it to the list
        list.append(newWidget);
    });
});
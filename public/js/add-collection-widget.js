// add-collection-widget.js
jQuery(document).ready(function () {
    var list = $('#guns-list');
    var gunCounter = list.data('widget-counter') || list.children().length;
    jQuery('.add-another-gun').click(function () {
        var newWidget = '<li class="list-group-item guns-list">' + list.attr('data-prototype') + '</li>';
        console.log(newWidget)
        newWidget = newWidget.replace(/__name__/g,gunCounter);

        gunCounter++;
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data('widget-counter', gunCounter);
        // create a new list element and add it to the list
        list.append(newWidget);
    });
    jQuery('.remove-another-gun').click(function () {
        gunCounter--;
        $('.guns-list').last().remove();
    });
});
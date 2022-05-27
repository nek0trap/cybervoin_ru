// add-collection-widget.js
$(document).ready(function () {
    createAddRemoveButtonWithId('gear');
    createAddRemoveButtonWithId('guns');
    createAddRemoveButtonWithId('cyberware');
});

function createAddRemoveButtonWithId(buttonId) {
    var buttonList = $(`#${buttonId}-list`);
    var buttonCounter = buttonList.data('widget-counter') || buttonList.children().length;

    $(`.add-another-${buttonId}`).click(function () {
        var newWidget = `<li class="list-group-item ${buttonId}-list">` + buttonList.attr('data-prototype') + `</li>`;
        newWidget = newWidget.replace(/__name__/g,buttonCounter);
        buttonCounter++;
        buttonList.data('widget-counter', buttonCounter);
        buttonList.append(newWidget);
    });

    $(`.remove-another-${buttonId}`).click(function () {
        buttonCounter--;
        $(`.${buttonId}-list`).last().remove();
    });
}

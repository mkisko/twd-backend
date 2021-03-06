var $collectionHolder;

// setup an "add a point" link
var $addPointButton = $('<button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Добавить точку</button>');
var $newLinkLi = $('<tr></tr>').append($addPointButton);

console.log($addPointButton);
jQuery(document).ready(function () {
    // Get the ul that holds the collection of points
    $collectionHolder = $('p.points');

    // add the "add a point" anchor and li to the points ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addPointButton.on('click', function (e) {
        // add a new point form (see next code block)
        addPointForm($collectionHolder, $newLinkLi);
    });
});

function addPointForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your points field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a point" link li
    var $newFormLi = $('<tr></tr>').append(newForm);
    $newLinkLi.before($newFormLi);
}
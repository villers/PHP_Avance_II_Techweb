/// <reference path="typings/tsd.d.ts" />
var i;
var nbList = $('.scroll').children().length;
var sizeList = (parseInt($('.liste').css('width'), 10) + 5) * nbList;
$('.scroll').css('width', sizeList);
$(".list-group").sortable();
$('.list-group-item').draggable({
    snap: ".list-group",
    connectToSortable: ".list-group"
});
$('.click').click(function (elem) {
    i = $(this).data('id');
});
$('.delete').click(function (elem) {
    i = $(this).data('id');
    $.post('/liste/' + i + '/delete', function (data) {
        location.reload();
    });
});
$('.delete-card').click(function (elem) {
    i = $(this).data('id');
    $.post('/card/' + i + '/delete', function (data) {
        location.reload();
    });
});
$('#submitList').click(function () {
    var name = $('#listName').val();
    console.log(name);
    $.post('/liste/' + $(".scroll-x").data('id') + '/create', { 'title': name }, function (data) {
        location.reload();
    });
});
$('#submitCard').click(function () {
    var name = $('#cardName').val();
    var description = $('#cardDescription').val();
    $.post('/card/' + i + '/create', { 'title': name, 'description': description }, function (data) {
        location.reload();
    });
});
//# sourceMappingURL=main.js.map
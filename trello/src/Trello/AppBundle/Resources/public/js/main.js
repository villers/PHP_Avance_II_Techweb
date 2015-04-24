/// <reference path="typings/tsd.d.ts" />
'use strict';
var i;
var nbList = $('.scroll').children().length;
var sizeList = (parseInt($('.liste').css('width'), 10) + 20) * nbList;
$('.scroll').css('width', sizeList);
$(".list-group").sortable();
$('.list-group-item').draggable({
    snap: ".list-group",
    connectToSortable: ".list-group",
    stop: function (event, ui) {
        var current = $(event.target).data('id');
        var liste = $(event.toElement).parents('.liste').data('id');
        $.post('/card/' + current + '/update', { 'id': liste });
    }
});
$('.click').click(function (elem) {
    i = $(this).data('id');
});
$('.delete').click(function (elem) {
    i = $(this).data('id');
    $.post('/liste/' + i + '/delete', function (data) {
        $(elem.currentTarget).parents('.liste').slideUp();
    });
});
$('.delete-card').click(function (elem) {
    i = $(this).data('id');
    $.post('/card/' + i + '/delete', function (data) {
        $(elem.currentTarget).parent('li').slideUp();
    });
});
$('.archived-card').click(function (elem) {
    i = $(this).data('id');
    $.post('/card/' + i + '/archived');
});
$('#submitList').click(function () {
    var name = $('#listName').val();
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
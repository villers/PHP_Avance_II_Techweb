/// <reference path="typings/tsd.d.ts" />
'use strict';

var i: number;
var nbList: number = $('.scroll').children().length;
var sizeList: number = (parseInt($('.liste').css('width'), 10) + 20) * nbList;
$('.scroll').css('width', sizeList);

$(".list-group" ).sortable();
$('.list-group-item').draggable({
    snap: ".list-group",
    connectToSortable: ".list-group",
    stop: ( event, ui ) => {
        var current: HTMLElement = $(event.target).data('id');
        var liste: HTMLElement =  $(event.toElement).parents('.liste').data('id');
        $.post(
            '/card/'+current+'/update',
            {'id': liste}
        );
    }
});

$('.click').click(function(elem) {
    i = $(this).data('id');
});

$('.delete').click(function(elem) {
    i = $(this).data('id');
    $.post(
        '/liste/'+i+'/delete',
        (data) => {
            $(elem.currentTarget).parents('.liste').slideUp();
        }
    );
});

$('.delete-card').click(function(elem) {
    i = $(this).data('id');
    $.post(
        '/card/'+i+'/delete',
        (data) => {
            $(elem.currentTarget).parent('li').slideUp();
        }
    );
});

$('.archived-card').click(function(elem) {
    i = $(this).data('id');
    $.post(
        '/card/'+i+'/archived'
    );
});


$('#submitList').click(() => {
    var name: string = $('#listName').val();
    $.post(
        '/liste/'+$(".scroll-x").data('id')+'/create',
        { 'title': name},
        (data) => {
            location.reload();
        }
    );
});

$('#submitCard').click(() => {
    var name: string = $('#cardName').val();
    var description: string = $('#cardDescription').val();

    $.post(
        '/card/'+i+'/create',
        { 'title': name, 'description': description},
        (data) => {
            location.reload();
        }
    );
});

/// <reference path="typings/tsd.d.ts" />
var i: number;
var nbList: number = $('.scroll').children().length;
var sizeList: number = (parseInt($('.liste').css('width'), 10) + 5) * nbList;
$('.scroll').css('width', sizeList);


$( ".list-group" ).sortable();
$('.list-group-item').draggable({
    snap: ".list-group",
    connectToSortable: ".list-group"
});

$('.click').click(function(elem) {
    i = $(this).data('id');
});

$('.delete').click(function(elem) {
    i = $(this).data('id');
    $.post(
        '/liste/'+i+'/delete',
        (data) => {
            location.reload();
        }
    );
});

$('.delete-card').click(function(elem) {
    i = $(this).data('id');
    $.post(
        '/card/'+i+'/delete',
        (data) => {
            location.reload();
        }
    );
});


$('#submitList').click(() => {
    var name: string = $('#listName').val();
    console.log(name);

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
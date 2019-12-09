$(window).on("load", function() {
    $(".loader-wrapper").fadeOut(1600);
})

$("#submit").on("click", function() {
    alert("Insertion Complete");
})



var today = new Date();
var monthly = today.getFullYear() + '-' + (today.getMonth() + 1);
var annual = today.getFullYear();

$(document).ready(function() {
    var table = $('#table').DataTable();
    //monthly payments button
    $('.search-month').click(function() {
        table.search(monthly).draw();
    });
    //yearly payment mathod
    $('.search-annual').click(function() {
        table.search(annual).draw();
    });
    //search by payment method
    $("#select-payment-search").change(function() {
        table.search($("select#select-payment-search option:checked").val()).draw();

    });
    //search by category
    $("#select-category-search").change(function() {
        table.search($("select#select-category-search option:checked").val()).draw();

    });

});
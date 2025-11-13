jQuery(document).ready(function ($) {

    $('.accordion-collapse').on('show.bs.collapse', function () {

        var accordionItem = $(this).closest('.accordion-item');


        accordionItem.addClass('bg-gray-900');
    });

    $('.accordion-collapse').on('hide.bs.collapse', function () {

        var accordionItem = $(this).closest('.accordion-item');

        accordionItem.removeClass('bg-gray-900 ');
    });

});
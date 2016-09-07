jQuery(document).ready(function($) {


    $(".slc_qus li").click(function () {
        $(".slc_qus li").removeClass("active");
        $(this).addClass("active");   
    });


    // $('#agenda_date').datepicker()



    function toggleChevron(e) {
        $(e.target)
            .prev('.box_acd_title')
            .find("i.indicator")
            .toggleClass('fa-angle-up fa-angle-down');
        }
    $('.box_accordian').on('hidden.bs.collapse', toggleChevron);
    $('.box_accordian').on('shown.bs.collapse', toggleChevron);




    //tinymce.init({ selector:'.tinymce' });
    tinymce.init({
        selector: '.tinymce',  // change this value according to your HTML
        menubar: false,
        theme: 'modern',
        toolbar: 'bold italic underline | bullist numlist outdent indent | link image | ',
    });

    tinymce.init({
        selector: 'div.tinymce_div',  // change this value according to your HTML
        menubar: false,
        theme: 'modern',
        toolbar: 'bold italic underline ',
    });



 });










/* Handle sidebar state */
$("#sidebarBackdrop").on("click", function (e) {
    e.preventDefault();

    document.body.classList.toggle('sb-sidenav-toggled');
    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
});


/* Datatable fix header width when init */
$("table.datatable-fix").on('draw.dt', function () {
    $($('#' + $(this).attr('id') + '_wrapper')).find(".dt-scroll-head .dt-scroll-headInner").css("width", "100%");
    $($('#' + $(this).attr('id') + '_wrapper')).find(".dt-scroll-head .dt-scroll-headInner table").css("width", "100%");
});

/* Back to top */
function backToTop(selector = '#content') {
    $(selector).animate({ scrollTop: 0 });
}
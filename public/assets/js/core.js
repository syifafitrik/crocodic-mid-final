/* Handle sidebar state */
if (!$("body").hasClass("nosidebar")) {
    if (sidebarState == null) {
        var sidebarState = (GetCurrentBreakpoint() == 'lg' || GetCurrentBreakpoint() == 'xl') && localStorage.getItem(
            "sidebarOpen") ?
            localStorage.getItem("sidebarOpen") :
            "true";
    }

    $("#sidebarToggle").on("click", function (e) {
        e.preventDefault();

        toggleSidebar();
    });

    $("#sidebarBackdrop").on("click", function (e) {
        e.preventDefault();

        toggleSidebar();
    });

    function toggleSidebar() {
        if (sidebarState == null) {
            if (GetCurrentBreakpoint() == 'lg' || GetCurrentBreakpoint() == 'xl') {
                sidebarState = localStorage.getItem("sidebarOpen")
                    ? localStorage.getItem("sidebarOpen")
                    : "true";
            } else {
                sidebarState = "false";
            }
        }

        if (sidebarState == "true") {
            {
                sidebarState = "false";
                $("body").removeClass("sb-sidenav-toggled");

                if (GetCurrentBreakpoint() == 'lg' || GetCurrentBreakpoint() == 'xl')
                    localStorage.setItem("sidebarOpen", "false");
            }
        } else {
            sidebarState = "true";

            if (GetCurrentBreakpoint() == 'lg' || GetCurrentBreakpoint() == 'xl') {
                $("body").addClass("sb-sidenav-toggled");
                localStorage.setItem("sidebarOpen", "true");
            }
            else {
                $("body").removeClass("sb-sidenav-toggled");
            }
        }
    }
}


/* Datatable fix header width when init */
$("table.datatable-fix").on('draw.dt', function () {
    $($('#' + $(this).attr('id') + '_wrapper')).find(".dt-scroll-head .dt-scroll-headInner").css("width", "100%");
    $($('#' + $(this).attr('id') + '_wrapper')).find(".dt-scroll-head .dt-scroll-headInner table").css("width", "100%");
});
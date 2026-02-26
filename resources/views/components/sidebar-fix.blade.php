<script>
    /* Check Breakpoint State */
    function GetCurrentBreakpoint() {
        if (window.matchMedia('(max-width: 575.98px)').matches)
            return 'xs';
        else if (window.matchMedia('(max-width: 767.98px)').matches)
            return 'sm';
        else if (window.matchMedia('(max-width: 991.98px)').matches)
            return 'md';
        else if (window.matchMedia('(max-width: 1199.98px)').matches)
            return 'lg';
        else
            return 'xl';
    }

    if (GetCurrentBreakpoint() != 'lg' && GetCurrentBreakpoint() != 'xl') {
        document.body.classList.remove('sb-sidenav-toggled');
    } else {
        if (localStorage.getItem("sb|sidebar-toggle") === 'true')
            document.body.classList.add('sb-sidenav-toggled');
        else if (localStorage.getItem("sb|sidebar-toggle") === 'false')
            document.body.classList.remove('sb-sidenav-toggled');
    }
</script>

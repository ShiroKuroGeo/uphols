    
    <!-- Start of the Footer Code -->
    <script src="/uphols/Assets/Js/jquery.js"></script>
    <script src="/uphols/Backend/Middleware/Vue/axios.js"></script>
    <script src="/uphols/Backend/Middleware/Vue/vue.3.js"></script>
    <script src="/uphols/Backend/Middleware/Members/customer.js"></script>
    <script src="/uphols/Assets/Plugins/Toastr/toastr.min.js"></script>
    <script src="/uphols/Assets/Js/customerFunction.js"></script>
    <script src="/uphols/Assets/Js/simplebar.min.js"></script>
    <script src="/uphols/Assets/Js/tiny-slider.js"></script>
    <script src="/uphols/Assets/Js/tippy-bundle.umd.min.js"></script>
    <script src="/uphols/Assets/Js/slider.js"></script>
    <script src="/uphols/Assets/Js/tooltip.js"></script>
    <script src="/uphols/Assets/Js/boostrap.js"></script>
    <script src="/uphols/Assets/Js/theme.min.js"></script>
    <!-- End of the Footer Code -->
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>
</html>
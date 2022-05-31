@if (session('create_alert'))
    <script>
        let alertInfo = @json(session('create_alert'));
        Swal.fire({
            title: alertInfo.title,
            text: alertInfo.message,
            icon: alertInfo.icon,
            confirmButtonText: 'Continue'
        })
    </script>
@endif

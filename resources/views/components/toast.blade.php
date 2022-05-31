@if (session('toast'))
    <script>
        let toastInfo = @json(session('toast'));
        console.log(toastInfo);
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: toastInfo.icon,
            title: toastInfo.title
        })
    </script>
@endif

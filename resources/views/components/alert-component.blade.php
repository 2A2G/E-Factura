@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let timerInterval;
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2",
            },
            buttonsStyling: false
        });
        Livewire.on('post-created', (name) => {
            swalWithBootstrapButtons.fire({
                title: "Actualizacion Exitosa",
                text: name.name,
                icon: "success",
                timer: 3000,
                timerProgressBar: true,
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        })

        Livewire.on('post-deleted', (name) => {
            swalWithBootstrapButtons.fire({
                title: "Eliminacion Exitosa",
                text: name.name,
                icon: "success",
                timer: 3000,
                timerProgressBar: true,
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        })
        Livewire.on('post-error', (name) => {
            console.log('post-error', name.name);
            swalWithBootstrapButtons.fire({
                title: "Error",
                text: name.name,
                icon: "error",
                timer: 3000,
                timerProgressBar: true,
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        })
        Livewire.on('post-warning', (name) => {
            console.log('post-warning', name.name);
            swalWithBootstrapButtons.fire({
                title: "Advertencia",
                text: name.name,
                icon: "warning",
                timer: 5000,
                timerProgressBar: true,
                showConfirmButton: false,
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("La advertencia se cerró automáticamente");
                }
            });
        });
    </script>
@endpush

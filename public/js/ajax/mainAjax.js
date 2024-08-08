const forms_ajax = document.querySelectorAll('.form-ajax')
/*const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
})*/

forms_ajax.forEach(forms => {
    forms.addEventListener('submit', function(e){
        e.preventDefault()

        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Los datos son modificables',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: "Sí, Guardar",
            cancelButtonText: "No, Cancelar",
        }).then((result) => {

            let data = new FormData(this)
            let method = this.getAttribute('method')
            let action = this.getAttribute('action')

            let headers = new Headers()

            let config = {
                method: method,
                headers: headers,
                mode: 'cors',
                cache: 'no-cache',
                body: data,
            }

            fetch(action,config)
            .then(response => response.json())
            .then(response => {
                return alertsAjax(response)
            })
        })
    })
})


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

function alertsAjax(alert){
    
    if(alert.type === 'simple'){
        Swal.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar'
        })
    } else if(alert.type === 'reload'){
        Swal.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            showCancelButton: true,
            confirmButtonText: 'Sí, Aceptar',
            cancelButtonText: 'No, Cancelar'
        }).then((result) => {
            if(result.isConfirmed){
                location.reload()
            }
        })
    } else if(alert.type === 'clean'){
        Swal.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            showCancelButton: true,
            confirmButtonText: 'Sí, Aceptar',
            cancelButtonText: 'No, Cancelar'
        }).then((result) => {
            if(result.isConfirmed){
                document.querySelector('.form-ajax').reset()
            }
        })
    } else if(alert.type === 'redirect'){
        window.location.href=alert.url
    }
}


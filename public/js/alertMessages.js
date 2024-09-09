const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success m-1',
        cancelButton: 'btn btn-danger m-1'
    },
    buttonsStyling: false
})

export function confirmAlert(type, values){
    switch(type){
        case 'reload':
            alertMessages({
                ...values,
                confirmButton: true,
                confirmButtonText: 'Aceptar'
            })
        break
        case 'simple':
            alertMessages({
                ...values,
                confirmButton: true,
                confirmButtonText: 'Aceptar'
            })
        break
    }
}

export function alertMessages({icon, title, text, ...others}){
    return swalWithBootstrapButtons.fire({
        icon: icon,
        title: title,
        text: text,
        ...others
    })
}
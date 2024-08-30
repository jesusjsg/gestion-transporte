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
            alert({
                ...values,
                confirmButton: true,
                confirmButtonText: 'Aceptar'
            })
        break
    }
}

export function alert({icon, title, text, ...others}){
    return swalWithBootstrapButtons.fire({
        icon: icon,
        title: title,
        text: text,
        ...others
    })
}
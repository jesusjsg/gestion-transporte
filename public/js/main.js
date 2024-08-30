const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success m-1',
        cancelButton: 'btn btn-secondary m-1'
    },
    buttonsStyling: false
})

export function formAjaxHandler(form){
    //const formAjax = document.querySelectorAll('.form-ajax')
    //formAjax.forEach(form => {
        form.addEventListener('submit', function(e){
            e.preventDefault()
    
            swalWithBootstrapButtons.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas realizar la siguiente operación?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: "Sí, Guardar",
                cancelButtonText: "No, Cancelar",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed){
    
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
    
                    fetch(action, config)
                    .then(response => response.json())
                    .then(response => {
                        return alertsAjax(response)
                    })
                }
    
            })
        })
    //})
}

function alertsAjax(alert){
    
    if(alert.type == 'simple'){
        swalWithBootstrapButtons.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar'
        })
    } else if(alert.type == 'reload'){
        swalWithBootstrapButtons.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if(result.isConfirmed){
                location.reload()
            }
        })
    } else if(alert.type == 'clean'){
        swalWithBootstrapButtons.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if(result.isConfirmed){
                document.querySelector('.form-ajax').reset()
            }
        })
    } else if(alert.type == 'redirect'){
        window.location.href = alert.url
    }
}

// Funcion para el sidebar 
(function () {
	"use strict";

	const treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

})();


import { getDatatable } from "./components/datatable.js";
import { AJAX_TABLES } from "./apiAjax.js";


const tableConductor = document.querySelector('#table-conductor')
const tableUsuario = document.querySelector('#table-usuario')
const tableGeneral = document.querySelector('#table-general')
const tableVehiculo = document.querySelector('#table-vehiculo')
const tableRuta = document.querySelector('#table-ruta')

function main(){
    renderTables()
}

function renderTables(){ // render all tables
    initConductorTable()
    initUsuarioTable()
    initGeneralTable()
    initVehiculoTable()
    initRutaTable()
}

function initConductorTable(){
    getDatatable(tableConductor, AJAX_TABLES.conductor, [ // conductor table
        {'data': 'id_conductor'},
        {'data': 'nombre_conductor'},
        {'data': 'cedula_conductor'},
        {'data': 'telefono_conductor'},
        {'data': 'id_vehiculo'},
        {'data': 'tipo_nomina'},
        {'data': 'opciones', 'className': 'dt-center'}
    ])
}

function initUsuarioTable(){
    getDatatable(tableUsuario, AJAX_TABLES.usuario, [ // usuario table
        {'data': 'id_usuario', visible:false},
        {'data': 'nombre_apellido'},
        {'data': 'nombre_usuario'},
        {'data': 'nombre_rol', 'className':'dt-center'},
        {'data': 'opciones', 'className':'dt-center'},
    ])
}

function initGeneralTable(){
    getDatatable(tableGeneral, AJAX_TABLES.general, [ // general table
        {'data': 'id_registro'},
        {'data': 'id_entidad'},
        {'data': 'descripcion1'},
        {'data': 'descripcion2'},
        {'data': 'descripcion3'},
        {'data': 'valor', 'className':'dt-right'},
        {'data': 'opciones'}
    ])
}

function initVehiculoTable(){
    getDatatable(tableVehiculo, AJAX_TABLES.vehiculo, [ // vehiculo table
        {'data': 'id_vehiculo'},
        {'data': 'tipo_vehiculo'},
        {'data': 'propiedad'},
        {'data': 'unidad_negocio'},
        {'data': 'marca'},
        {'data': 'modelo'},
        {'data': 'year_vehiculo', visible:false},
        {'data': 'serial_carroceria', visible:false},
        {'data': 'serial_motor', visible:false},
        {'data': 'numero_ejes', visible:false},
        {'data': 'capacidad_carga', visible:false},
        {'data': 'uso'},
        {'data': 'vencimiento_poliza', visible:false},
        {'data': 'vencimiento_racda', visible:false},
        {'data': 'vencimiento_sanitario', visible:false},
        {'data': 'vencimiento_rotc', visible:false},
        {'data': 'fecha_fumigacion', visible:false},
        {'data': 'fecha_impuesto', visible:false},
        {'data': 'bolipuertos', visible:false},
        {'data': 'gps', visible:false},
        {'data': 'link_gps', visible:false},
        {'data': 'estatus_vehiculo'},
        {'data': 'id_municipio', visible:false},
        {'data': 'activo_uno'},
        {'data': 'activo_dos'},
        {'data': 'activo_tres'},
        {'data': 'opciones'}
    ])
}

function initRutaTable(){
    getDatatable(tableRuta, AJAX_TABLES.ruta, [ // ruta table
        {'data': 'id_ruta'},
        {'data': 'nombre_ruta'},
        {'data': 'origen'},
        {'data': 'destino'},
        {'data': 'kilometros'},
        {'data': 'opciones'}
    ])
}

document.addEventListener('DOMContentLoaded', main)



const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success m-1',
        cancelButton: 'btn btn-danger m-1'
    },
    buttonsStyling: false
})

export function formAjaxHandler(form){
    const formAjax = document.querySelectorAll('.form-ajax')
    formAjax.forEach(form => {
        form.addEventListener('submit', function(e){
            e.preventDefault()
    
            swalWithBootstrapButtons.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas realizar la siguiente operación?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: "Sí, Aceptar",
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
    })
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

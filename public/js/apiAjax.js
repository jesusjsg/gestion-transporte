export const AJAX_TABLES = {
    viaje: 'http://localhost/gestion-transporte/ajax/viaje?action=load_viaje',
    conductor: 'http://localhost/gestion-transporte/ajax/conductor?action=load_conductores',
    general: 'http://localhost/gestion-transporte/ajax/general?action=load_general',
    vehiculo: 'http://localhost/gestion-transporte/ajax/vehiculo?action=load_vehiculos',
    ruta: 'http://localhost/gestion-transporte/ajax/ruta?action=load_ruta',
    usuario: 'http://localhost/gestion-transporte/ajax/usuarios?action=load_users',
}

export const AJAX_AUTOCOMPLETE = {
    cliente: 'http://localhost/gestion-transporte/ajax/viaje?action=get_cliente',
    municipio: 'http://localhost/gestion-transporte/ajax/viaje?action=get_municipio',
    conductor: 'http://localhost/gestion-transporte/ajax/viaje?action=get_conductor',
    placaVehiculo: 'http://localhost/gestion-transporte/ajax/viaje?action=get_placa',
}

export const AJAX_KILOMETERS = {
    ruta: 'http://localhost/gestion-transporte/ajax/ruta?action=get_kilometers',
}
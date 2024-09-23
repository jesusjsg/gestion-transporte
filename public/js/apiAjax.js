const BASE_URL = 'http://localhost/gestion-transporte/';

export const AJAX_TABLES = {
    viaje: `${BASE_URL}ajax/viaje?action=load_viaje`,
    conductor: `${BASE_URL}ajax/conductor?action=load_conductores`,
    general: `${BASE_URL}ajax/general?action=load_general`,
    vehiculo: `${BASE_URL}ajax/vehiculo?action=load_vehiculos`,
    ruta: `${BASE_URL}ajax/ruta?action=load_ruta`,
    usuario: `${BASE_URL}ajax/usuarios?action=load_users`,
};

export const AJAX_AUTOCOMPLETE = {
    cliente: `${BASE_URL}ajax/viaje?action=get_cliente`,
    municipio: `${BASE_URL}ajax/ruta?action=get_municipio`,
    conductor: `${BASE_URL}ajax/viaje?action=get_conductor`,
    placaVehiculo: `${BASE_URL}ajax/conductor?action=get_placa`,
};

export const AJAX_KILOMETERS = {
    ruta: `${BASE_URL}ajax/ruta?action=get_kilometers`,
};

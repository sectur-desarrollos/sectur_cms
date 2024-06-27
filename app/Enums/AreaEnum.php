<?php

namespace App\Enums;

enum AreaEnum: string {
    case Administrador = 'Administrador';
    case SecretariaParticular = 'Secretaría Particular';
    case UnidadApoyoAdministrativo = 'Unidad de Apoyo Administrativo';
    case AreaRecursosHumanos = 'Área de Recursos Humanos';
    case AreaRecursosFinancierosContabilidad = 'Área de Recursos Financieros y Contabilidad';
    case AreaRecursosMaterialesServiciosGenerales = 'Área de Recursos Materiales y Servicios Generales';
    case UnidadPlaneacion = 'Unidad de Planeación';
    case AreaPlaneacionProgramacion = 'Área de Planeación y Programación';
    case AreaEvaluacionControl = 'Área de Evaluación y Control';
    case UnidadAsuntosJuridicos = 'Unidad de Asuntos Jurídicos';
    case UnidadInformatica = 'Unidad de Informática';
    case UnidadTransparencia = 'Unidad de Transparencia';
    case UnidadVinculacionSanCristobal = 'Unidad de Vinculación San Cristóbal de las Casas';
    case UnidadVinculacionPalenque = 'Unidad de Vinculación Palenque';
    case UnidadVinculacionTapachula = 'Unidad de Vinculación en Tapachula';
    case SubsecretariaPromocionTuristica = 'Subsecretaría de Promoción Turística';
    case DireccionProyeccionTuristica = 'Dirección de Proyección Turística';
    case DepartamentoGestionProyectosPromocionales = 'Departamento de Gestión de Proyectos Promocionales';
    case DepartamentoDifusionTuristica = 'Departamento de Difusión Turística';
    case DireccionEventosAtencionSegmentosTuristicos = 'Dirección de Eventos y Atención a Segmentos Turísticos';
    case DepartamentoEventos = 'Departamento de Eventos';
    case DepartamentoAtencionSegmentosTuristicos = 'Departamento de Atencion a Segmentos Turísticos';
    case SubsecretariaDesarrolloTuristico = 'Subsecretaría de Desarrollo Turistico';
    case DireccionInformacionEstadistica = 'Dirección de Información y Estadística';
    case DepartamentoSistemasInformacionTuristica = 'Departamento de Sistemas de Información Turística';
    case DepartamentoInformacionTurista = 'Departamento de Información al Turista';
    case DireccionDesarrolloTurismoAlternativoComunitario = 'Dirección de Desarrollo de Turismo Alternativo y Comunitario';
    case DireccionDesarrolloProductos = 'Dirección de Desarrollo de Productos';
    case DepartamentoImpulsoProductosTuristicos = 'Departamento de Impulso a Productos Turísticos';
    case DepartamentoProyectosInfraestructuraTuristica = 'Departamento de Proyectos de Infraestructura Turística';
    case DireccionCompetitividadNormatividadTuristica = 'Dirección de Competitividad y Normatividad Turística';
    case DepartamentoCapacitacionCulturaTuristica = 'Departamento de Capacitación y Cultura Turística';
    case DepartamentoCertificacionTuristica = 'Departamento de Certificación Turística';
    case DepartamentoNormatividadTuristica = 'Departamento de Normatividad Turística';
}
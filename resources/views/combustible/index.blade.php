@extends('admin.main')

@section('contenido')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">
                            Registro de Combustible y Rutas
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalRegistroCombustible">
                                <i class="fas fa-file"></i> Nuevo Registro
                            </button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <form action="" method="get">
                                <input class="form-control me-2" type="search" placeholder="Buscar conductor"
                                    aria-label="Search" id="buscador">

                            </form>
                        </div>
                        <div class="mt-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th width="10%">Opciones</th>
                                            <th width="10%">ID</th>
                                            <th width="10%">Ruta</th>
                                            <th width="10%">Número de Factura</th>
                                            <th width="10%">Grifo</th>
                                            <th width="10%">Fecha y Hora</th>
                                            <th width="10%">Galones de Combustible</th>
                                            <th width="10%">Importe</th>
                                            <th width="10%">Kilometraje Inicial</th>
                                            <th width="10%">Kilometraje Final</th>
                                            <th width="10%">Tipo de Combustible</th>
                                        </tr>
                                    </thead>
                                    <tbody id="combustibleTableBody">
                                        {{-- Aquí se llenará dinámicamente la tabla con JavaScript --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('combustible.registro') {{-- Modal para registrar nuevo combustible --}}

@endsection

@push('scripts')
<script>
    // Función para obtener datos de combustible y rutas desde la API
    function fetchCombustibles() {
    $.ajax({
        url: "http://127.0.0.1:8000/api/combustibles", // Ajusta la URL a la API de combustibles
        method: "GET",
        success: function(response) {
            console.log(response); // <-- Para revisar la respuesta

            let tbody = $("#combustibleTableBody");
            tbody.empty(); 
            
            // Asegúrate de que 'response' sea un array con los registros de combustible y rutas
            $.each(response, function(index, combustible) {
                // Construir la información de la ruta
                let combustibleInfo = combustible.ruta 
                    ? `${combustible.ruta.id} - De ${combustible.ruta.origen} a ${combustible.ruta.destino}` 
                    : 'Ruta: N/A';

                // Añadir el registro a la tabla
                tbody.append(`
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-warning btn-sm editar me-2" onclick="editar(${combustible.id})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <button type="button" class="btn btn-danger btn-sm eliminar" onclick="eliminar(${combustible.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>                     
                        <td>${combustible.id}</td>    
                        <td>${combustibleInfo}</td>  <!-- Recuadro con la información de la ruta -->           
                        <td>${combustible.num_factura}</td>
                        <td>${combustible.grifo}</td>
                        <td>${combustible.fecha_hora}</td>
                        <td>${combustible.galonesCombustible}</td>
                        <td>${combustible.importe}</td>
                        <td>${combustible.kilometraje_inicial}</td>
                        <td>${combustible.kilometraje_final}</td>
                        <td>${combustible.tipo_combustible}</td>
                        
                    </tr>
                `);
            });
        },
        error: function() {
            alert("Error al obtener datos de combustible.");
        }
    });
}


    // BARRA DE BUSQUEDA
$(document).ready(function() {
        $("#buscador").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            let hasVisibleRow = false;

            // Si el buscador está vacío, recargar los conductores completos
            if (value === "") {
                fetchCombustibles(); // Llamar a la función que carga los conductores
            } else {
                // Filtrar por nombre (columna 3) y por la cuarta columna
                $("#combustibleTableBody tr").filter(function() {
                    const nombre = $(this).find('td:eq(3)').text().toLowerCase();
                    const otraColumna = $(this).find('td:eq(4)').text().toLowerCase(); // Agregar la quinta columna
                    const isVisible = nombre.indexOf(value) > -1 || otraColumna.indexOf(value) > -1; // Buscar en ambas columnas
                    $(this).toggle(isVisible);
                    if (isVisible) {
                        hasVisibleRow = true;
                    }
                });

                // Si no hay resultados visibles, mostrar un mensaje
                if (!hasVisibleRow) {
                    $("#combustibleTableBody").html(
                        '<tr><td colspan="9" class="text-center">No se encontraron resultados</td></tr>'
                    );
                }
            }
        });
    });















    function eliminar(id) {
        Swal.fire({
            title: 'Eliminar registro',
            text: "¿Está seguro de querer eliminar el registro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'DELETE',
                    url:  `http://127.0.0.1:8000/api/combustibles/${id}`,
                    headers:{
                      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res){
                        window.location.reload();
                        Swal.fire({
                            icon: res.status,
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function (res){
                        console.log(res);
                    }
                });
            }
        });
    }
</script>
@endpush

<x-app-layout>

    <nav class="">
        <div class="container flex flex-row justify-between items-center ">
            <a class="" href={{ route('home') }}><x-boton-inicio /></a>
            <h1 class=" h1">Cajas</h1>
            <div class="w-40"></div>
        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')

    <div class="container mt-3 card rounded-none">
        <div class="card-body rounded-none my-3">
            {{-- tabla Cajas --}}
            <table id="cajas_Datatables" class="table  table-striped table-hover ">
                <thead>

                    <tr>
                        <th>ID</th>
                        <th>FECHA/HORA</th>
                        <th>EFECTIVO</th>
                        <th>TARJETA</th>
                        <th>BIZUM</th>
                        <th>TOTAL</th>

                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
     

        $(document).ready(function() {
           
            
            var table = $('#cajas_Datatables').DataTable({

                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                "order": [
                    [0, "desc"]
                ],
                "lengthMenu": [5, 10, 20],
                "language": {

                    "lengthMenu": "Mostrar _MENU_ registros por páginas",
                    "zeroRecords": "Nada encontrado",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                ajax: "{{ route('cajas.index') }}",
                "columnDefs": [{
            "targets": 1, // Índice de la columna 'created_at' (0-indexado)
            "render": function(data) {
                // Formatear la fecha
                var created_at = new Date(data);
                return created_at.toLocaleString(); // Puedes ajustar el formato según tus necesidades
            }
        }],
        
        
                columns: [

                    {
                        data: 'id',
                        name: 'id',
                        "className": "fw-bold  align-middle"
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        "className": " fw-bold  align-middle"

                    },
 
                    {
                        data: 'efectivo',
                        name: 'efectivo',
               
                        "className": "fw-bold  align-middle"
                    },
                    {
                        data: 'tarjeta',
                        name: 'tarjeta',
                        "className": " fw-bold align-middle "
                    },

                    {
                        data: 'bizum',
                        name: 'bizum',
                        "className": "fw-bold   align-middle"
                    },
                    {
                        data: 'total',
                        name: 'total',
                        "className": " fw-bold  align-middle"
                    },


                ],

            

            });
          
        });
        
    </script>
</x-app-layout>

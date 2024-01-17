import './bootstrap';



import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
/* datatables */
$('#tabla_Datatables').DataTable({

    responsive: true,
    autoWidth: false,
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros por páginas",
        "zeroRecords": "Nada encontrado - disculpa",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "No records available",
        "infoFiltered": "(filtrado de _MAX_ registros)",
        "search": "Buscar:",
        "paginate": {
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }
});
/* imagenes */
$(document).ready(function(e) {
    $('#imagen').change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#imagenSeleccionada').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

});

function descargarPDF() {
    // Reemplaza 'ruta/al/archivo.pdf' con la ruta real de tu archivo PDF
    var rutaPDF = ' public_path('facturas\factura.pdf')';

    // Crea un enlace temporal
    var enlace = document.createElement('a');
    enlace.href = rutaPDF;
    enlace.download = 'factura.pdf';

    // Dispara un clic en el enlace
    enlace.click();
}
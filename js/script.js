$(document).ready(function () {
    // Inicializar el calendario
    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function (dateText) {
            $("#fechaSeleccionada").val(dateText);
            // Cargar horarios dinámicamente
            cargarHorarios(dateText);
        }
    });

    function cargarHorarios(fecha) {
        $.ajax({
            url: "../modelo/modeloHorario.php",
            type: "GET",
            data: { fecha: fecha },
            success: function (response) {
                if (response.success) {
                    const horarios = response.data;
                    // Mostrar los horarios en los campos de entrada
                    $("#hora-apertura").val(horarios.hApertura);
                    $("#hora-cierre").val(horarios.hCierre);
                    
                    // Poblamos las listas de selección con los valores de hora
                    $("#lista-horarios-apertura, #lista-horarios-cierre").empty();
                    for (let hora = 9; hora <= 21; hora++) {
                        let horaFormateada = hora < 10 ? '0' + hora + ':00' : hora + ':00';
                        let optionApertura = `<option value="${horaFormateada}">${horaFormateada}</option>`;
                        let optionCierre = `<option value="${horaFormateada}">${horaFormateada}</option>`;
                        $("#lista-horarios-apertura").append(optionApertura);
                        $("#lista-horarios-cierre").append(optionCierre);
                    }

                    // Seleccionamos el horario por defecto
                    $("#lista-horarios-apertura").val(horarios.hApertura);
                    $("#lista-horarios-cierre").val(horarios.hCierre);
                } else {
                    alert(response.error || "Error desconocido.");
                }
            },
            error: function () {
                alert("Error al cargar horarios.");
            }
        });
    }
});
$(document).ready(function () {
    // Inicializar el calendario
    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function (dateText) {
            $("#fechaSeleccionada").val(dateText);
            // Cargar horarios dinámicamente
            cargarHorarios(dateText);
        }
    });

    function cargarHorarios(fecha) {
        $.ajax({
            url: "../modelo/modeloHorario.php",
            type: "GET",
            data: { fecha: fecha },
            success: function (response) {
                if (response.success) {
                    const horarios = response.data;
                    // Mostrar los horarios en los campos de entrada
                    $("#hora-apertura").val(horarios.hApertura);
                    $("#hora-cierre").val(horarios.hCierre);
                    
                    // Poblamos las listas de selección con los valores de hora
                    $("#lista-horarios-apertura, #lista-horarios-cierre").empty();
                    for (let hora = 9; hora <= 21; hora++) {
                        let horaFormateada = hora < 10 ? '0' + hora + ':00' : hora + ':00';
                        let optionApertura = `<option value="${horaFormateada}">${horaFormateada}</option>`;
                        let optionCierre = `<option value="${horaFormateada}">${horaFormateada}</option>`;
                        $("#lista-horarios-apertura").append(optionApertura);
                        $("#lista-horarios-cierre").append(optionCierre);
                    }

                    // Seleccionamos el horario por defecto
                    $("#lista-horarios-apertura").val(horarios.hApertura);
                    $("#lista-horarios-cierre").val(horarios.hCierre);
                } else {
                    alert(response.error || "Error desconocido.");
                }
            },
            error: function () {
                alert("Error al cargar horarios.");
            }
        });
    }
});

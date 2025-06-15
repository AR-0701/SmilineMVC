
const respuesta = document.getElementById("respuesta");
const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
recognition.lang = "es-MX";
recognition.continuous = false;

const afirmaciones = ["sí", "si", "sii", "sip", "shi", "claro", "por supuesto", "afirmativo", "correcto"];
const negaciones = ["no", "negativo", "nunca", "para nada"];

const btnIniciar = document.getElementById("iniciarAsistente");

btnIniciar.addEventListener("click", () => {
    hablar("Bienvenido. Por favor, dime tu nombre.");
    recognition.start();
    btnIniciar.style.display = "none";
});

let estado = "bienvenida";
let nombreCliente = "";
let diaDisponible = "";
let horaDisponible = "";

function hablar(texto) {
    recognition.abort(); // Detenemos el reconocimiento

    const voz = new SpeechSynthesisUtterance(texto);
    voz.lang = "es-MX";

    voz.onstart = () => {
        // Evita cualquier escucha accidental mientras habla
        if (!speechSynthesis.speaking) {
            speechSynthesis.speak(voz);
        }
    };

    voz.onend = () => {
        if (estado !== "finalizado") {
            setTimeout(() => {
                recognition.start(); // Espera 800 ms antes de volver a escuchar
            }, 800);
        }
    };

    speechSynthesis.speak(voz);
}



recognition.onresult = function (event) {

    let texto = event.results[0][0].transcript.toLowerCase().trim();
    texto = texto.normalize("NFD").replace(/[\u0300-\u036f]/g, ""); // quita acentos

    respuesta.textContent = "Escuchado: " + texto;
    recognition.interimResults = false; // solo resultados finales


    if (estado === "bienvenida") {
        nombreCliente = texto;
        console.log("Nombre del cliente:", nombreCliente);
        hablar(`¿Confirmas que tu nombre es ${nombreCliente}? Responde sí o no.`);
        estado = "confirmarNombre";

    } else if (estado === "confirmarNombre") {
        hablar(`modo cita`);

        if (afirmaciones.some(p => texto.includes(p))) {
            document.getElementById("nombreCliente").value = nombreCliente;
            estado = "consultarFechas";

            fetch("../inclusivo/consultar_disponibilidad.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `nombre=${encodeURIComponent(nombreCliente)}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        hablar("Lo siento, hubo un error al consultar las fechas disponibles.");
                        estado = "finalizado";
                        return;
                    }

                    let opciones = data.map((item, index) => {
                        const fecha = new Date(item.fecha).toLocaleDateString('es-MX', { weekday: 'long', day: 'numeric', month: 'long' });
                        const hora = item.horas[0]; // solo mostramos 1 por simplicidad
                        return `Opción ${index + 1}: el ${fecha} a las ${hora}`;
                    });

                    hablar(`Estas son tus opciones: ${opciones.join(". ")}, por favor di opción 1, 2 o 3.`);
                    localStorage.setItem("citasOpciones", JSON.stringify(data));
                    estado = "seleccionCita";
                });

        } else if (negaciones.some(p => texto.includes(p))) {
            hablar("Por favor, repite tu nombre.");
            estado = "bienvenida";
        } else {
            hablar("No entendí tu respuesta. ¿Podrías repetir? Responde sí o no.");
        }
    }
    else if (estado === "seleccionCita") {
        const opciones = JSON.parse(localStorage.getItem("citasOpciones"));

        if (texto.includes("uno")) {
            asignarCita(0, opciones);
        } else if (texto.includes("dos")) {
            asignarCita(1, opciones);
        } else if (texto.includes("tres")) {
            asignarCita(2, opciones);
        } else {
            hablar("No entendí qué opción elegiste. Di opción uno, dos o tres.");
        }
    }
    else if (estado === "confirmarCita") {
        if (afirmaciones.some(p => texto.includes(p))) {
            document.getElementById("diaCita").value = diaDisponible;
            document.getElementById("horaCita").value = horaDisponible;
            hablar(`Cita agendada para ${nombreCliente} el ${diaDisponible} a las ${horaDisponible}. Gracias.`);
            estado = "finalizado";
            document.querySelector("form button[type=submit]").disabled = true;

            const modalAgendada = new bootstrap.Modal(document.getElementById('modalCitaAgendada'));
            modalAgendada.show();
            setTimeout(() => {
                modalAgendada.hide();
            }, 3000);
        } else if (negaciones.some(p => texto.includes(p))) {
            hablar("Cita no agendada. Puedes intentarlo más tarde.");
            estado = "finalizado";
        } else {
            hablar("No entendí tu respuesta. ¿Podrías repetir?");
        }
    }

};

// ... (código anterior se mantiene igual hasta la función asignarCita)

function asignarCita(indice, opciones) {
    const cita = opciones[indice];
    const fechaObj = new Date(cita.fecha);
    const fechaFormateada = fechaObj.toLocaleDateString('es-MX', { weekday: 'long', day: 'numeric', month: 'long' });
    const hora = cita.horas[0];

    diaDisponible = cita.fecha;
    horaDisponible = hora;

    hablar(`Cita seleccionada para el ${fechaFormateada} a las ${hora}. ¿Deseas agendar esta cita?`);
    estado = "confirmarCita";
}

// Modificación en el reconocimiento de voz para manejar la confirmación
recognition.onresult = function (event) {
    let texto = event.results[0][0].transcript.toLowerCase().trim();
    texto = texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

    respuesta.textContent = "Escuchado: " + texto;
    recognition.interimResults = false;

    if (estado === "bienvenida") {
        nombreCliente = texto;
        hablar(`¿Confirmas que tu nombre es ${nombreCliente}? Responde sí o no.`);
        estado = "confirmarNombre";

    } else if (estado === "confirmarNombre") {
        if (afirmaciones.some(p => texto.includes(p))) {
            document.getElementById("nombreCliente").value = nombreCliente;
            estado = "consultarFechas";

            fetch("../inclusivo/consultar_disponibilidad.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `nombre=${encodeURIComponent(nombreCliente)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    hablar("Lo siento, hubo un error al consultar las fechas disponibles.");
                    estado = "finalizado";
                    return;
                }

                if (data.length === 0) {
                    hablar("Lo siento, no hay horarios disponibles en este momento.");
                    estado = "finalizado";
                    return;
                }

                let opciones = data.map((item, index) => {
                    const fecha = new Date(item.fecha).toLocaleDateString('es-MX', { weekday: 'long', day: 'numeric', month: 'long' });
                    const hora = item.horas[0];
                    return `Opción ${index + 1}: el ${fecha} a las ${hora}`;
                });

                hablar(`Estas son tus opciones: ${opciones.join(". ")}, por favor di opción 1, 2 o 3.`);
                localStorage.setItem("citasOpciones", JSON.stringify(data));
                estado = "seleccionCita";
            });

        } else if (negaciones.some(p => texto.includes(p))) {
            hablar("Por favor, repite tu nombre.");
            estado = "bienvenida";
        } else {
            hablar("No entendí tu respuesta. ¿Podrías repetir? Responde sí o no.");
        }
    }
    else if (estado === "seleccionCita") {
        const opciones = JSON.parse(localStorage.getItem("citasOpciones"));

        if (texto.includes("uno") || texto.includes("1")) {
            asignarCita(0, opciones);
        } else if (texto.includes("dos") || texto.includes("2")) {
            asignarCita(1, opciones);
        } else if (texto.includes("tres") || texto.includes("3")) {
            asignarCita(2, opciones);
        } else {
            hablar("No entendí qué opción elegiste. Di opción uno, dos o tres.");
        }
    }
    else if (estado === "confirmarCita") {
        if (afirmaciones.some(p => texto.includes(p))) {
            // Guardar la cita temporal en el servidor
            fetch("../inclusivo/guardar_cita_temporal.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `nombre=${encodeURIComponent(nombreCliente)}&dia=${encodeURIComponent(diaDisponible)}&hora=${encodeURIComponent(horaDisponible)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    hablar("Lo siento, no pude agendar la cita. " + data.error);
                    estado = "finalizado";
                    return;
                }

                document.getElementById("diaCita").value = diaDisponible;
                document.getElementById("horaCita").value = horaDisponible;
                hablar(`Cita agendada para ${nombreCliente} el ${diaDisponible} a las ${horaDisponible}. Gracias.`);
                estado = "finalizado";
                document.querySelector("form button[type=submit]").disabled = true;

                const modalAgendada = new bootstrap.Modal(document.getElementById('modalCitaAgendada'));
                modalAgendada.show();
                setTimeout(() => {
                    modalAgendada.hide();
                }, 3000);
            });
        } else if (negaciones.some(p => texto.includes(p))) {
            hablar("Cita no agendada. Puedes intentarlo más tarde.");
            estado = "finalizado";
        } else {
            hablar("No entendí tu respuesta. ¿Podrías repetir?");
        }
    }
};

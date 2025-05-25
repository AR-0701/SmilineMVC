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
let diaDisponible = "martes 15 de octubre";
let horaDisponible = "10:00 de la mañana";

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
        hablar(`¿Confirmas que tu nombre es ${nombreCliente}? Responde sí o no.`);
        estado = "confirmarNombre";

    } else if (estado === "confirmarNombre") {
        if (afirmaciones.some(p => texto.includes(p))) {
            document.getElementById("nombreCliente").value = nombreCliente;
            hablar(`Gracias, ${nombreCliente}. Las citas disponibles son el ${diaDisponible} a las ${horaDisponible}. ¿Deseas agendar esta cita?`);
            estado = "confirmarCita";
                recognition.interimResults = false; // solo resultados finales

        } else if (negaciones.some(p => texto.includes(p))) {
            hablar("Por favor, repite tu nombre.");
            estado = "bienvenida";  
        } else {
            hablar("No entendí tu respuesta. ¿Podrías repetir? Responde sí o no.");
        }

    } else if (estado === "confirmarCita") {
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




window.onload = function () {
    // Solo hablamos, no iniciamos automáticamente
    // hablar("Bienvenido. Por favor, dime tu nombre.");
    // recognition.start();
};

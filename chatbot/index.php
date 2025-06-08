<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Chatbot de asistencia odontológica">
    <title>Chat Odontológico</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #00A99D;
            --color-primary-dark: #00857a;
            --color-bg: #fff;
            --color-user: #00A99D;
            --color-user-text: white;
            --color-bot: #e9e9e9;
            --color-text: #333;
            --color-border: #e0e0e0;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        .body_chat.dark {
            --color-bg: #1f1f1f;
            --color-bot: #2a2a2a;
            --color-text: #f0f0f0;
            --color-border: #444;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .body_chat {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: var(--color-bg);
            color: var(--color-text);
            line-height: 1.5;
        }

        #chat-container {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 380px;
            max-width: calc(100vw - 40px);
            background: var(--color-bg);
            border-radius: 16px;
            box-shadow: var(--shadow);
            display: none;
            flex-direction: column;
            overflow: hidden;
            transition: var(--transition);
            z-index: 1000;
            border: 1px solid var(--color-border);
        }

        #chat-header {
            background: var(--color-primary);
            color: white;
            padding: 14px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: move;
        }

        #chat-header h3 {
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
        }

        #chatbox {
            height: 400px;
            overflow-y: auto;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            background: var(--color-bg);
        }

        .msg {
            padding: 12px 16px;
            border-radius: 16px;
            max-width: 85%;
            word-wrap: break-word;
            line-height: 1.4;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-msg {
            align-self: flex-end;
            background: var(--color-user);
            color: var(--color-user-text);
            border-bottom-right-radius: 4px;
        }

        .bot-msg {
            align-self: flex-start;
            background: var(--color-bot);
            color: var(--color-text);
            border-bottom-left-radius: 4px;
        }

        .msg-time {
            font-size: 0.7rem;
            opacity: 0.7;
            margin-top: 4px;
            text-align: right;
        }

        #input-area {
            display: flex;
            padding: 12px;
            border-top: 1px solid var(--color-border);
            gap: 8px;
            background: var(--color-bg);
        }

        #userInput {
            flex: 1;
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid var(--color-border);
            font-size: 14px;
            background: var(--color-bg);
            color: var(--color-text);
            transition: var(--transition);
        }

        #userInput:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(0, 169, 157, 0.2);
        }

        #sendBtn {
            background: var(--color-primary);
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #sendBtn:hover {
            background: var(--color-primary-dark);
            transform: translateY(-1px);
        }

        #sendBtn:active {
            transform: translateY(0);
        }

        #chat-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--color-primary);
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: var(--shadow);
            cursor: pointer;
            z-index: 999;
            transition: var(--transition);
        }

        #chat-button:hover {
            background: var(--color-primary-dark);
            transform: scale(1.05);
        }

        #chat-button:active {
            transform: scale(0.98);
        }

        .chat-controls {
            display: flex;
            gap: 8px;
        }

        .chat-controls button {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .chat-controls button:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .typing {
            font-style: italic;
            opacity: 0.7;
            font-size: 0.9rem;
            padding-left: 6px;
        }

        .typing-dots {
            display: inline-flex;
            align-items: center;
        }

        .typing-dots span {
            width: 6px;
            height: 6px;
            margin: 0 2px;
            background-color: var(--color-text);
            border-radius: 50%;
            display: inline-block;
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .typing-dots span:nth-child(1) {
            animation-delay: -0.32s;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1);
            }
        }

        /* Scrollbar styling */
        #chatbox::-webkit-scrollbar {
            width: 6px;
        }

        #chatbox::-webkit-scrollbar-track {
            background: transparent;
        }

        #chatbox::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        body.dark #chatbox::-webkit-scrollbar-thumb {
            background: #555;
        }

        /* Welcome message */
        .welcome-message {
            text-align: center;
            padding: 16px;
            color: var(--color-text);
            opacity: 0.8;
            font-size: 0.9rem;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            #chat-container {
                width: calc(100vw - 40px);
                right: 20px;
                bottom: 20px;
                max-height: 80vh;
            }

            #chatbox {
                height: 60vh;
            }
        }
    </style>
</head>

<div class="body_chat">
    <!-- Botón flotante -->
    <button id="chat-button" onclick="toggleChat()" aria-label="Abrir chat">
        <i class="fas fa-comment-dots"></i>
    </button>

    <!-- Contenedor del chat -->
    <div id="chat-container">
        <div id="chat-header">
            <h3>Chat Odontológico</h3>
            <div class="chat-controls">
                <button id="theme-toggle" onclick="toggleTheme()" aria-label="Cambiar tema">
                    <i class="fas fa-moon"></i>
                </button>
                <button onclick="toggleChat()" aria-label="Cerrar chat">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div id="chatbox">
            <div class="welcome-message">
                ¡Hola! Soy tu asistente odontológico. ¿En qué puedo ayudarte hoy?
            </div>
        </div>
        <div id="input-area">
            <input type="text" id="userInput" placeholder="Escribe tu mensaje..." aria-label="Escribe tu mensaje">
            <button id="sendBtn" onclick="sendMessage()" aria-label="Enviar mensaje">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <script>
        // Variables para el arrastre del chat  
        let isDragging = false;
        let offsetX, offsetY;
        const chatContainer = document.getElementById('chat-container');
        const chatHeader = document.getElementById('chat-header');

        // Función para mostrar/ocultar el chat
        function toggleChat() {
            chatContainer.style.display = chatContainer.style.display === "none" || chatContainer.style.display === "" ? "flex" : "none";

            // Si se está mostrando, enfocar el input
            if (chatContainer.style.display === "flex") {
                setTimeout(() => {
                    document.getElementById('userInput').focus();
                }, 100);
            }
        }

        // Función para cambiar el tema
        function toggleTheme() {
            document.body.classList.toggle("dark");
            const themeIcon = document.querySelector('#theme-toggle i');
            if (document.body.classList.contains('dark')) {
                themeIcon.classList.replace('fa-moon', 'fa-sun');
            } else {
                themeIcon.classList.replace('fa-sun', 'fa-moon');
            }
        }

        // Función para obtener la hora actual formateada
        function getCurrentTime() {
            const now = new Date();
            return now.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Función para enviar mensaje con Enter
        function setupInput() {
            const input = document.getElementById('userInput');
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        }

        // Función principal para enviar mensajes
        function sendMessage() {
            const input = document.getElementById('userInput');
            const msg = input.value.trim();
            const chatbox = document.getElementById('chatbox');

            if (!msg) return;

            // Crear y mostrar mensaje del usuario
            const userMsg = document.createElement('div');
            userMsg.className = 'msg user-msg';
            userMsg.textContent = msg;

            const timeSpan = document.createElement('span');
            timeSpan.className = 'msg-time';
            timeSpan.textContent = getCurrentTime();
            userMsg.appendChild(timeSpan);

            chatbox.appendChild(userMsg);
            input.value = '';

            // Mostrar animación de "escribiendo..."
            const typing = document.createElement('div');
            typing.className = 'msg bot-msg typing';
            typing.innerHTML = '<div class="typing-dots"><span></span><span></span><span></span></div>';
            chatbox.appendChild(typing);
            chatbox.scrollTop = chatbox.scrollHeight;

            // Enviar la pregunta al servidor
            fetch("../chatbot/chatbot.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: new URLSearchParams({
                        pregunta: msg
                    })
                })
                .then(res => res.json())
                .then(data => {
                    chatbox.removeChild(typing);

                    const botMsg = document.createElement('div');
                    botMsg.className = 'msg bot-msg';

                    // Mostrar categoría si está disponible (solo para desarrollo)
                    if (data.categoria && data.categoria !== 'desconocida') {
                        const categoriaSpan = document.createElement('span');
                        categoriaSpan.className = 'msg-category';
                        categoriaSpan.textContent = `[${data.categoria}] `;
                        categoriaSpan.style.opacity = '0.6';
                        categoriaSpan.style.fontSize = '0.8em';
                        botMsg.appendChild(categoriaSpan);
                    }

                    botMsg.appendChild(document.createTextNode(data.respuesta));

                    const botTimeSpan = document.createElement('span');
                    botTimeSpan.className = 'msg-time';
                    botTimeSpan.textContent = getCurrentTime();
                    botMsg.appendChild(botTimeSpan);

                    chatbox.appendChild(botMsg);
                    chatbox.scrollTop = chatbox.scrollHeight;
                })
                .catch(error => {
                    chatbox.removeChild(typing);

                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'msg bot-msg';
                    errorMsg.textContent = 'Parece que hay un problema con la conexión. Por favor, inténtalo de nuevo más tarde.';
                    chatbox.appendChild(errorMsg);
                    chatbox.scrollTop = chatbox.scrollHeight;

                    console.error('Error:', error);
                });
        }

        // Funcionalidad de arrastre del chat
        chatHeader.addEventListener('mousedown', (e) => {
            isDragging = true;
            offsetX = e.clientX - chatContainer.getBoundingClientRect().left;
            offsetY = e.clientY - chatContainer.getBoundingClientRect().top;
            chatContainer.style.cursor = 'grabbing';
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;

            const x = e.clientX - offsetX;
            const y = e.clientY - offsetY;

            // Limitar el movimiento dentro de la ventana
            const maxX = window.innerWidth - chatContainer.offsetWidth;
            const maxY = window.innerHeight - chatContainer.offsetHeight;

            chatContainer.style.left = `${Math.min(Math.max(0, x), maxX)}px`;
            chatContainer.style.top = `${Math.min(Math.max(0, y), maxY)}px`;
            chatContainer.style.right = 'auto';
            chatContainer.style.bottom = 'auto';
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
            chatContainer.style.cursor = '';
        });

        // Inicialización
        document.addEventListener('DOMContentLoaded', () => {
            setupInput();

            // Posición inicial del chat
            chatContainer.style.right = '20px';
            chatContainer.style.bottom = '80px';
        });
    </script>

</div>
</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Odontológico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #chat-container {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 320px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: none;
            overflow: hidden;
            border: 1px solid #ccc;
        }

        #chat-header {
            background: #00A99D;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            cursor: pointer;
        }

        #chatbox {
            height: 300px;
            overflow-y: auto;
            padding: 10px;
        }

        #userInput {
            width: 75%;
            padding: 5px;
            border: 1px solid #ccc;
        }

        #sendBtn {
            background: #00A99D;
            color: white;
            border: none;
            padding: 6px;
            cursor: pointer;
        }

        /* Estilos para el botón flotante */
        #chat-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #00A99D;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 22px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        #chat-button:hover {
            background: #00837A;
        }
    </style>
</head>

<body>

    <!-- Botón flotante -->
    <button id="chat-button" onclick="toggleChat()">💬</button>

    <!-- Contenedor del chat -->
    <div id="chat-container">
        <div id="chat-header" onclick="toggleChat()">Chatbot Odontológico ✖</div>
        <div id="chatbox"></div>
        <div style="padding: 10px;">
            <input type="text" id="userInput" placeholder="Escribe tu pregunta">
            <button id="sendBtn" onclick="sendMessage()">Enviar</button>
        </div>
    </div>

    <script>
        function toggleChat() {
            let chat = document.getElementById("chat-container");
            chat.style.display = chat.style.display === "none" ? "block" : "none";
        }

        function sendMessage() {
            let input = document.getElementById("userInput").value;
            let chatbox = document.getElementById("chatbox");

            if (input.trim() !== "") {
                chatbox.innerHTML += "<p><strong>Tú:</strong> " + input + "</p>";

                fetch("chatbot.php", {
                        method: "POST",
                        body: new URLSearchParams({ "pregunta": input }),
                        headers: { "Content-Type": "application/x-www-form-urlencoded" }
                    })
                    .then(response => response.json())
                    .then(data => {
                        chatbox.innerHTML += "<p><strong>Chatbot:</strong> " + data.respuesta + "</p>";
                        chatbox.scrollTop = chatbox.scrollHeight;
                    });

                document.getElementById("userInput").value = "";
            }
        }
    </script>

</body>

</html>

const express = require('express');
const cors = require('cors')
const venom = require('venom-bot');

const app = express();
const server = require('http').createServer(app);
const io = require('socket.io')(server, {
    cors: {
        origin: ["http://localhost", "http://10.53.8.26"],
        methods: ["GET", "POST"],
        credentials: true
    },
    allowEIO3: true
});

let session = [];

let messages = [];

app.use(cors({
    origin: "*",
}));


app.get('/', (req, res) => {
    res.status(200).send();
})


io.on('connection', socket => {
    console.log("Socket connectado: " + socket.id);
    initVenom(socket);


    socket.on('sendMessage', data => {
        messages.push(data);
        console.log(data);
        socket.broadcast.emit('receivedMessage', data);
    })
});

const initVenom = (socket) => {
    let session_name = "sessionName";
    venom
        .create(
            session_name,
            (base64Qr, asciiQR, attempts, urlCode) => {
                console.log(asciiQR); // Optional to log the QR in the terminal
                var matches = base64Qr.match(/^data:([A-Za-z-+\/]+);base64,(.+)$/),
                    response = {};

                if (matches.length !== 3) {
                    return new Error('Invalid input string');
                }
                response.type = matches[1];
                response.data = new Buffer.from(matches[2], 'base64');

                var imageBuffer = response;
                require('fs').writeFile(
                    '../assets/qrcode/out.png',
                    imageBuffer['data'],
                    'binary',
                    function (err) {
                        if (err != null) {
                            console.log(err);
                        }
                        socket.emit('qrcode', {success: true, qrcode: 'out.png'})
                    }
                );
            },
            undefined,
            {logQR: false}
        )
        .then((client) => {

            start(client);
        })
        .catch((erro) => {
            console.log(erro);
        });
}

const start = (client) => {
    client.onMessage((message) => {
        if (message.body === 'Hi' && message.isGroupMsg === false) {
            client
                .sendText(message.from, 'Welcome Venom 🕷')
                .then((result) => {
                    console.log('Result: ', result); //return object success
                })
                .catch((erro) => {
                    console.error('Error when sending: ', erro); //return object error
                });
        }
    });
}

server.listen(45000, () => {
    console.log('Rodando na porta 45000');
});

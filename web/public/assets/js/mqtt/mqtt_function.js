const clientId = "mqttjs_" + Math.random().toString(16).substr(2, 8);

const host = "ws://broker.emqx.io:8083/mqtt";

const options = {
  username: "Aflah",
  password: "1234567890",
  keepalive: 30,
  clientId,
  protocolId: "MQTT",
  protocolVersion: 4,
  clean: true,
  reconnectPeriod: 1000,
  connectTimeout: 30 * 1000,
  will: {
    topic: "WillMsg",
    payload: "Connection Closed abnormally..!",
    qos: 0,
    retain: false,
  },
  rejectUnauthorized: false,
};

console.log("connecting mqtt client");
const client = mqtt.connect(host, options);

client.on("error", (err) => {
  console.log(err);
  client.end();
});

client.on("connect", () => {
  console.log("client connected:" + clientId);
  // client.subscribe("water/ketinggian", { qos: 1 });
  // client.subscribe("water/action", { qos: 1 });
  client.subscribe("lampu/kirim", { qos: 1 });
});

client.on("message", (topic, message, packet) => {
  if (topic === 'lampu/kirim') {
      // const ketinggianWater = message.toString();
      // document.getElementById('ketinggian').innerText = ketinggianWater;
      // document.getElementById('water-level-vertical').value = ketinggianWater;
  } 
  // else if (topic === 'water/action') {
  //     const actionWater = message.toString();
  //     document.getElementById('action').innerText = actionWater;
  //     document.getElementById('action-vertical').value = actionWater;
  // }

  // var now = new Date();

  // // Array hari dalam seminggu
  // var days =  ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

  // // Mendapatkan komponen tanggal dan waktu
  // var dayName = days[now.getDay()]; // Mengambil nama hari
  // var day = now.getDate();
  // var month = now.getMonth() + 1; // Bulan di JavaScript dihitung dari 0, jadi tambahkan 1
  // var year = now.getFullYear();
  // var hours = now.getHours();
  // var minutes = now.getMinutes();
  // var seconds = now.getSeconds();

  // // Menambahkan '0' di depan angka yang kurang dari 10 agar tampilannya menjadi 2 digit
  // day = day < 10 ? '0' + day : day;
  // month = month < 10 ? '0' + month : month;
  // hours = hours < 10 ? '0' + hours : hours;
  // minutes = minutes < 10 ? '0' + minutes : minutes;
  // seconds = seconds < 10 ? '0' + seconds : seconds;

  // // Membuat format tanggal dan waktu yang diinginkan
  // var date = year + '-' + month + '-' + day;
  // var time = hours + ':' + minutes + ':' + seconds;

  // // Tampilkan hasil di elemen dengan id
  // document.getElementById('date-vertical').value = date;
  // document.getElementById('days-vertical').value = dayName;
  // document.getElementById('time-vertical').value = time;

  // Submit otomatis
  // document.getElementById('waterLevelForm').submit();
  
  
  
  console.log(
    "Received Message:= " + message.toString() + "\nOn topic:= " + topic
  );
  
});

function controlLED(color) {
  client.publish('lampu/terima', color);
}

// Event listener untuk tombol
document.getElementById('redButton').addEventListener('click', () => controlLED('red'));
document.getElementById('greenButton').addEventListener('click', () => controlLED('green'));
document.getElementById('blueButton').addEventListener('click', () => controlLED('blue'));
document.getElementById('offButton').addEventListener('click', () => controlLED('off'));


client.on("close", () => {
  console.log(clientId + " disconnected");
});

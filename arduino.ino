#include <Arduino.h>
#include <WiFi.h>
#include <PubSubClient.h>
#include <Ultrasonic.h>

// Replace with your network credentials
const char* ssid = "Redmi Note 13 Pro 5G";
const char* password = "113333555555";

// Replace with your MQTT Broker IP address or hostname
const char* mqtt_server =  "broker.emqx.io";

WiFiClient espClient;
PubSubClient client(espClient);
Ultrasonic ultrasonic(5, 18); // trigPin, echoPin

const int relayPin = 19;
const int ledRPin = 25;
const int ledGPin = 26;
const int ledBPin = 27;


void setup() {
  Serial.begin(115200);

  // Set pin modes
  pinMode(relayPin, OUTPUT);
  pinMode(ledRPin, OUTPUT);
  pinMode(ledGPin, OUTPUT);
  pinMode(ledBPin, OUTPUT);

  setup_wifi();
  client.setServer(mqtt_server, 1883);

  while (!client.connected()) {
    Serial.print("Menghubungkan ke MQTT...");
    if (client.connect("ESP32Client")) {
      Serial.println("Tersambung");
    } else {
      Serial.print("Gagal, rc=");
      Serial.print(client.state());
      delay(5000);
    }
  }
  
}

void setup_wifi() {
  delay(10);
  Serial.println();
  Serial.print("Menghubungkan ke ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi tersambung");
}


void loop() {
  if (!client.connected()) {
    while (!client.connected()) {
      Serial.print("Menghubungkan kembali ke MQTT...");
      if (client.connect("ESP32Client")) {
        Serial.println("kembali terhubung");
        client.subscribe("water/command");
      } else {
        Serial.print("Gagal, rc=");
        Serial.print(client.state());
        delay(5000);
      }
    }
  }
  client.loop();

  // Measure water level
  float ketinggianAir = ultrasonic.read();

  const float safe = 300.0;
  const float warning = 200.0;
  const float danger = 75.0;

  String action = "";

  if (ketinggianAir <= danger) {
    action = "Danger",
    Serial.print("Ketinggian air: ");
    Serial.println(ketinggianAir);
    Serial.print("Keterangan air: ");
    Serial.println(action);
    digitalWrite(relayPin, HIGH);
    delay(500);
    setColor(HIGH, LOW, LOW); // Red
  } else if (ketinggianAir <= warning) {
    action = "Warning",
    Serial.print("Ketinggian air: ");
    Serial.println(ketinggianAir);
    Serial.print("Keterangan air: ");
    Serial.println(action);
    digitalWrite(relayPin, LOW);
    setColor(HIGH, HIGH, LOW); // Yellow
  } else {
    action = "Safe",
    Serial.print("Ketinggian air: ");
    Serial.println(ketinggianAir);
    Serial.print("Keterangan air: ");
    Serial.println(action);
    digitalWrite(relayPin, LOW);
    setColor(LOW, HIGH, LOW); // Green
  }

  // Publish the water level
  String data_k = String(ketinggianAir);
  client.publish("water/ketinggian", data_k.c_str());

  String data_a = String(action);
  client.publish("water/action", data_a.c_str());

  delay(15000);
}

void setColor(int r, int g, int b) {
  analogWrite(ledRPin, r);
  analogWrite(ledGPin, g);
  analogWrite(ledBPin, b);
}

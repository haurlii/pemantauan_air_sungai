<?php

namespace App\Console\Commands;

use App\Models\Normal;
use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Exceptions\MqttClientException;

class MqttListenerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen to MQTT broker and save water level data to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $server   = 'test.mosquitto.org'; // Alamat broker MQTT
        $port     = 1883;
        $clientId = 'mqttx_074c365e';
        $username = null; // Jika broker membutuhkan autentikasi, isi di sini
        $password = '11223344';
        $clean_session = true;

        try {
            $mqtt = new MqttClient($server, $port, $clientId);

            $mqtt->connect($username, $password, $clean_session);

            $this->info("Connected to MQTT broker at {$server}:{$port}");

            $mqtt->subscribe('sungai/ketinggianAir', function ($topic, $message) {
                $this->info("Received message on topic [{$topic}]: {$message}");

                // Parsing JSON message
                $data = json_decode($message, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    // Save data to database
                    Normal::create([
                        'ketinggian_air' => $data['ketinggian_air'],
                        'status' => $data['status'],
                        'received_at' => now(),
                    ]);

                    $this->info("Data saved to database successfully.");
                } else {
                    $this->error("Failed to parse JSON message: " . json_last_error_msg());
                }
            }, 0);

            $mqtt->loop(true); // Loop indefinitely

            $mqtt->disconnect();

            return 0;
        } catch (MqttClientException $e) {
            $this->error("Could not connect to MQTT broker: {$e->getMessage()}");
            return 1;
        }
    }
}

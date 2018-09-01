#include <SPI.h>
#include <Ethernet.h>
#define sensor 0 
#include<stdlib.h>

int Ventrada; // Variável para ler o sinal do pino do Arduino
float Temperatura; // Variável que recebe o valor convertido para temperatura.
char Temp[10];
String var;
// Enter a MAC address for your controller below.
// Newer Ethernet shields have a MAC address printed on a sticker on the shield
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
// if you don't want to use DNS (and reduce your sketch size)
// use the numeric IP instead of the name for the server:
//IPAddress server(192,168,0,20); // Número IP do WebService
IPAddress server(192,168,0,21); // Número IP do WebService
//char server[] = "ws.marcelo.com.br"; // Nome do dominio do Webservice
// Set the static IP address to use if the DHCP fails to assign
IPAddress ip(192,168,0,177);
// Initialize the Ethernet client library
// with the IP address and port of the server 
// that you want to connect to (port 80 is default for HTTP):

EthernetClient client;
void setup() {
	// Open serial communications and wait for port to open:
	Serial.begin(9600);
	while (!Serial) {
	; // wait for serial port to connect. Needed for Leonardo only
	}
	// start the Ethernet connection:
	if (Ethernet.begin(mac) == 0) {
	Serial.println("Failed to configure Ethernet using DHCP");
	// no point in carrying on, so do nothing forevermore:
	// try to congifure using IP address instead of DHCP:
	Ethernet.begin(mac, ip);
	}
	// give the Ethernet shield a second to initialize:
	delay(1000);
	Serial.println("connecting...");
}
void loop(){
	// if there are incoming bytes available 
	// from the server, read them and print them:
	client.stop();
	Ethernet.begin(mac,ip);
	Ventrada = analogRead (sensor); 
	Temperatura=(500*Ventrada)/1023;
	Serial.println(Temperatura);
	dtostrf(Temperatura, 1, 2, Temp);
	Serial.println(Temp);
	String ini = "id=1&valor=";
	var = ini + Temp;
	Serial.println(var);
	// if you get a connection, report back via serial:
	if (client.connect(server, 80)) {
		Serial.println("connected");
		// Make a HTTP request:
		client.println("POST /ws/WsTemp.asmx/incluir HTTP/1.1");
		client.println("Host: localhost");
		client.println("Content-Type: application/x-www-form-urlencoded");
		client.println("Content-Length: 342");
		client.println();
		client.println(var);
	} else {
		Serial.println("connection failed");
	}
	if (client.available()) {
	char c = client.read();
	Serial.print(c);
	}
	// if the server's disconnected, stop the client:
	if (!client.connected()) {
		Serial.println();
		Serial.println("disconnecting.");
	}
	delay(20000);
}
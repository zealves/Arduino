#include <OneWire.h>
#include <SPI.h>   //+
#include <Ethernet.h>
#include <Client.h> //+
int SensorPin = 2; 

int led1 = 4;
int val = 0;
float percent;

OneWire ds(SensorPin); 


//          +
// Enter a MAC address for your controller below.
// Newer Ethernet shields have a MAC address printed on a sticker on the shield
byte mac[] = { 0x90, 0xA2, 0xDA, 0x0F, 0xE9, 0x73 };
// if you don't want to use DNS (and reduce your sketch size)
// use the numeric IP instead of the name for the server:
//IPAddress server(74,125,232,128);  // numeric IP for Google (no DNS)
//char server[] = "www.google.com";    // name address for Google (using DNS)
IPAddress server(192,168,0,1);
// Set the static IP address to use if the DHCP fails to assign
IPAddress ip(192,168,0,2);

// Initialize the Ethernet client library
// with the IP address and port of the server
// that you want to connect to (port 80 is default for HTTP):
EthernetClient client;
bool connected = false;


void setup(void) 
{
	Serial.begin(9600);
	pinMode(led1, OUTPUT);
	delay(1000);
	Ethernet.begin(mac,ip);
}


void loop(void) 
{
	if(!connected)
	{
		Serial.println("Not connected");
		if (client.connect(server,80))
		{
		  float temperat = 226;
		  float tempSensor = getTemp();
		  float humSensor = getHum();
			connected = true;
			client.print("GET /WS_ARDUINO/ws_insert_temp.php?temperature=");
			client.print(tempSensor);
			client.print("&&humidity=");
			client.print(humSensor);
			client.println("HTTP/1.1\r\n");
			Serial.println();
			client.println("Host: localhost\r\n");
			Serial.println("Host: localhost\r\n");
			client.println();
			client.println("User-Agent: Arduino\r\n");
			Serial.println("User-Agent: Arduino\r\n");
			client.println("Accept: text/html\r\n");
			Serial.println("Accept: text/html\r\n"); 
			client.println();
			Serial.println();
			delay(10000);
		}
		else
		{
			Serial.println("Cannot connect to Server");
		}
	}
	else
	{
		delay(1000);
		while (client.connected() && client.available())
		{
			char c = client.read();
			Serial.print(c);
		}
		Serial.println();
		client.stop();
		connected = false;
    }
 
	float temp = getTemp();
	float hum = getHum();
	Serial.println(temp);
	Serial.println(hum);
	Serial.println();
	delay(1000); 

 
//    +
// if there are incoming bytes available
// from the server, read them and print them:
  
  
  if(temp > 25){
    digitalWrite(led1, HIGH);   // turn the LED on (HIGH is the voltage level)
    delay(1000);   
      if(temp > 30){
      digitalWrite(led1, LOW);
      delay(100);  
    }  
  }
  else{
    digitalWrite(led1, LOW);   // turn the LED on (HIGH is the voltage level)
    delay(1000);        
  }
}


float getHum()
{
	int sensorValue = analogRead(A0); 
	percent = ((sensorValue*100.f)/1025);
	float resultHum = (100 - percent);
	return resultHum;
}


float getTemp()
{
	byte data[12];
	byte addr[8];

	if ( !ds.search(addr)) {
		//no more sensors on chain, reset search
		ds.reset_search();
		Serial.println("I m here!");
		return -1000;
	}

	if ( OneWire::crc8( addr, 7) != addr[7]) {
		Serial.println("CRC is not valid!");
		return -1000;
	}

	if ( addr[0] != 0x10 && addr[0] != 0x28) {
		Serial.print("Device is not recognized");
		return -1000;
	}

	ds.reset();
	ds.select(addr);
	ds.write(0x44,1); 

	byte present = ds.reset();
	ds.select(addr); 
	ds.write(0xBE); 

	for (int i = 0; i < 9; i++) { 
		data[i] = ds.read();
	}

	ds.reset_search();

	byte MSB = data[1];
	byte LSB = data[0];

	float TRead = (MSB << 8) | LSB;
	float Temperature = TRead / 16;


	return Temperature;
}

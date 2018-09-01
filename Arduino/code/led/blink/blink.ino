int LED = 4;

void setup() {
  // initialize digital pin 13 as an output.
  pinMode(LED, OUTPUT);
  Serial.print("OK");
}

// the loop function runs over and over again forever
void loop() {
  Serial.println("pah");
  digitalWrite(LED, HIGH);   // turn the LED on (HIGH is the voltage level)
  delay(100);              // wait for a second
  digitalWrite(LED, LOW);    // turn the LED off by making the voltage LOW
  delay(100);               // wait for a second
}

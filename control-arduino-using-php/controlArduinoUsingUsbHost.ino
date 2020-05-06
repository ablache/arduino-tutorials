/*
 * controlArduinoUsingUsbHost
 * 
 * Controll arduino through serial communications using the
 * host USB port
 */

const int red = 2;
const int green = 4;
const int blue = 6;

void setup() {
  // initialize serial:
  Serial.begin(9600);
  
  // make the pins outputs:
  pinMode(red, OUTPUT);
  pinMode(green, OUTPUT);
  pinMode(blue, OUTPUT);

  //turn all colors off
  analogWrite(red, 255);
  analogWrite(green, 255);
  analogWrite(blue, 255);
}
void loop() {
  // if the serial is available, read it:
  while (Serial.available() > 0) {
    int led = Serial.parseInt();
    int val = Serial.parseInt();

    if(Serial.read() == '\n') {
      Serial.print(led);
      Serial.println(val);

      if((led == 2 || led == 4 || led == 6) && val >= 0) {
        analogWrite(led, val); 
      }
    }
  }
}

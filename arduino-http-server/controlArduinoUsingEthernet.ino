/*
 * controlArduinoUsingEthernet
 * 
 * Controll arduino through an Ethernet shield
 * 
 */

#include <SPI.h>
#include <Ethernet.h>

//set LED pins
const int red = 11;
const int green = 12;
const int blue = 13;

//set mac address and ip
byte mac[] = { 0x09, 0xCB, 0x8F, 0xD8, 0x2C, 0x59 };
IPAddress ip(172, 20, 18, 8);

//initialize web server on port 80
EthernetServer server(80);

void setup() {
  // initialize serial:
  Serial.begin(9600);

  //initialize led pins
  pinMode(red, OUTPUT);
  pinMode(green, OUTPUT);
  pinMode(blue, OUTPUT);

  //turn the led off
  allOff();

  //load config
  Ethernet.begin(mac, ip);
  server.begin();
  Serial.print("server is at ");
  Serial.println(Ethernet.localIP());
}

void loop() {
  String str;

  //listen for incoming requests
  EthernetClient client = server.available();
  if(client) {
    Serial.println("new client");
    
    //to check the request end
    boolean currentLineIsBlank = true;
    
    while(client.connected()) {
      if(client.available()) {
        char c = client.read();

        if(str.length() < 100) {
          str += c;
        }

        if (c == '\n' && currentLineIsBlank) {
          //check if the string contains red
          if(str.indexOf("red") > 0) {
            //get the values of for the colors
            int r = str.substring(11, 14).toInt();
            int g = str.substring(21, 24).toInt();
            int b = str.substring(30, 33).toInt();

            Serial.println(r);
            Serial.println(g);
            Serial.println(b);
            //light up the led
            lightup(r, g, b);
          }
          //send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println("Connection: close");
          client.println();
          client.println("<!DOCTYPE HTML>");
          client.println("<html>");
          client.println("<body>");
          client.println("ok");
          client.println("</body>");
          client.println("</html>");
          break;
        }
        if(c == '\n') {
          //if the end is a new line
          currentLineIsBlank = true;
        } 
        else if(c != '\r') {
          //check if you've gotten a character on the current line
          currentLineIsBlank = false;
        }
      }
    }
    
    // give the web browser time to receive the data
    delay(1);
    // close the connection:
    client.stop();
    Serial.println("client disonnected");
  }
}
//function to light up
void lightup(int r, int g, int b) {
  if(valid(r) && valid(g) && valid(b)) {
    analogWrite(red, r);
    analogWrite(green, g);
    analogWrite(blue, b);
  }
  else {
    allOff();
  }
}
//function to turn led off
void allOff() {
  analogWrite(red, 255);
  analogWrite(green, 255);
  analogWrite(blue, 255);
}
//function to validate pin values
boolean valid(int val) {
  if(val >= 0 && val <= 255) {
    return true;
  }

  return false;
}

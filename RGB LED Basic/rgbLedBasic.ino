int red_pin = 2;
int green_pin = 4;
int blue_pin = 6;

void setup() {
  pinMode(red_pin, OUTPUT);
  pinMode(green_pin, OUTPUT);
  pinMode(blue_pin, OUTPUT);

  analogWrite(red_pin, 255);
  analogWrite(green_pin, 255);
  analogWrite(blue_pin, 255);
}

void loop() {
  int r = 255; int g = 255; int b = 255;

  for(int i = 0; i < 1024; i++) {
    if(i >= 0 && i < 256) {
      analogWrite(red_pin, r);
      r--;
    }
    if(i >= 256 && r < 256) {
      analogWrite(red_pin, r);
      r++;
    }
    
    if(i >= 256 && i < 512) {
      analogWrite(green_pin, g);
      g--;
    }
    if(i >= 512 && g < 256) {
      analogWrite(green_pin, g);
      g++;
    }

    if(i >= 512 && i < 768) {
      analogWrite(blue_pin, b);
      b--;
    }
    if(i >= 768 && b < 256) {
      analogWrite(blue_pin, b);
      b++;
    }

    delay(20);
  }
  
}

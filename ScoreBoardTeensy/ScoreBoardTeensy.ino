#include "Wire.h"

const int led = 13;
unsigned int usbRead[2]={0};
unsigned int number[4]={0};
unsigned int bytecount,infocount = 0;
int GPIO_B = 0x13; // Least significant digit
int GPIO_A = 0x12; // Most significant digit
int Sec = 0x23; //Common Cathode
int Min = 0x22; // Common cathode
int Home = 0x21;// Common Cathode
int Away = 0x20;// Common cathode

void setup() {
  // put your setup code here, to run once: 
  Serial.begin(9600);
  pinMode(led,OUTPUT);
  digitalWrite(led,LOW);
  Wire.begin();
  Wire.setSDA(18);
  Wire.setSCL(19);
  setoutput(Sec);
  setoutput(Min);
  setoutput(Home);
  setoutput(Away);
}

void loop() { 
  // put your main code here, to run repeatedly:
  while (Serial.available()){
    usbRead[bytecount] = Serial.read()-'0'; // Convert ASCII to integer
    bytecount++;
    if (bytecount == 2) {
      number[infocount] = usbRead[0]*10 + usbRead[1];
      infocount++;
      bytecount = 0;
      if (infocount == 4){
        infocount=0;
        Serial.flush();
        Serial.clear();
      }
    }
  }
  //Serial.print for troubleshoot only
  Serial.print("Home Score = ");
  Serial.println(number[0]);
  Serial.print("Away Score = ");
  Serial.println(number[1]);
  Serial.print("Minute = ");
  Serial.println(number[2]);
  Serial.print("Second = ");
  Serial.println(number[3]);
  displaynum(Sec,GPIO_A,number[3]%10);
  displaynum(Sec,GPIO_B,number[3]/10);
  displaynum(Min,GPIO_A,number[2]%10);
  displaynum(Min,GPIO_B,number[2]/10);
  displaynum(Away,GPIO_B,number[1]%10);
  displaynum(Away,GPIO_A,number[1]/10);
  displaynum(Home,GPIO_A,number[0]%10);
  displaynum(Home,GPIO_B,number[0]/10);
  delay(10); // make sure the time delay is matching with time.sleep in Python script
}

void setoutput(char opcode){ //Set all GPIO as output
  Wire.beginTransmission(opcode);
  Wire.write(0x00);
  Wire.write(0x00);
  Wire.endTransmission();
  Wire.beginTransmission(opcode);
  Wire.write(0x01);
  Wire.write(0x00);
  Wire.endTransmission();  
}
void turnalloff(char opcode, char addr){ //Common Cathode
  Wire.beginTransmission(opcode);
  Wire.write(addr);
  Wire.write(0x00);
  Wire.endTransmission();
}

void turnalloff1(char opcode, char addr){ //Common Anode
  Wire.beginTransmission(opcode);
  Wire.write(addr);
  Wire.write(0xFF);
  Wire.endTransmission();
}

void displaynum(char opcode, char addr, char num){ //Common Cathode
  turnalloff(opcode,addr);
  Wire.beginTransmission(opcode);
  Wire.write(addr);
  Wire.write(num2led(num));
  Wire.endTransmission();
}

void displaynum1(char opcode, char addr, char num){ //Common Anode
  turnalloff1(opcode,addr);
  Wire.beginTransmission(opcode);
  Wire.write(addr);
  Wire.write(~num2led(num));
  Wire.endTransmission();
}

char num2led(char num){ //0b DP g f e d c b a , Active High
  switch(num) {
    case 0: return 0b00111111;
    case 1: return 0b00000110;
    case 2: return 0b01011011;
    case 3: return 0b01001111;
    case 4: return 0b01100110;
    case 5: return 0b01101101;
    case 6: return 0b01111101;
    case 7: return 0b00000111;
    case 8: return 0b01111111;
    case 9: return 0b01101111;
  }
  return 0;
}

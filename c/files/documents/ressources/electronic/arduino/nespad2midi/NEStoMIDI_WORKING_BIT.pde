#include <MIDI.h>
/*
NESPAD to MIDI by Jankenpopp
*/

/* INITIALISATION */

int latch = 2; // set the latch pin
int clock = 3; // set the clock pin
int datin = 4;// set the data in pin
byte controller_data = 0;

 //midi
 int intnote;
 byte note; 

int b0 = 1;
int b1 = 1;
int b2 = 1;
int b3 = 1;
int b4 = 1;
int b5 = 1;
int b6 = 1;
int b7 = 1;

int ChannelOut = 1;
int LEDChannel = 8;

/* SETUP */
void setup() {
  pinMode(8, OUTPUT); 
    pinMode(9, OUTPUT);
      pinMode(10, OUTPUT);
        pinMode(11, OUTPUT);
 MIDI.begin(4);
  
  //Serial.begin(57600);

  //  Set MIDI baud rate:
 // Serial.begin(31250);

pinMode(latch,OUTPUT);
pinMode(clock,OUTPUT);
pinMode(datin,INPUT);

digitalWrite(latch,HIGH);
digitalWrite(clock,HIGH);
}

/* CONTROLLER READ */
void controllerRead() {
controller_data = 0;
digitalWrite(latch,LOW);
digitalWrite(clock,LOW);

digitalWrite(latch,HIGH);
delayMicroseconds(2);
digitalWrite(latch,LOW);

controller_data = digitalRead(datin);

for (int i = 1; i <= 7; i ++) {
digitalWrite(clock,HIGH);
delayMicroseconds(2);
controller_data = controller_data << 1;
controller_data = controller_data + digitalRead(datin) ; 

delayMicroseconds(4);
digitalWrite(clock,LOW);

digitalWrite(LEDChannel, HIGH);
}




}

/* PROGRAM */
void loop() {
controllerRead();


//bitRead(controller_data, 7);

    // A
    if(bitRead(controller_data, 7)==0){
      if ( b7 == 1){
        MIDI.sendNoteOn(60,127,ChannelOut);  // Send a Note (pitch 42, velo 127 on channel 1)
         b7 =0;
       }
    }
    else{ 
    if  (b7 == 0){ 
      MIDI.sendNoteOff(60,0,ChannelOut);   // Stop the note
      b7 = 1;
      }
    }
    
    // B
    if(bitRead(controller_data, 6)==0){
      if ( b6 == 1){
        MIDI.sendNoteOn(61,127,ChannelOut);  // Send a Note (pitch 42, velo 127 on channel 1)
         b6 =0;
       }
    }
    else{ 
    if  (b6 == 0){ 
      MIDI.sendNoteOff(61,0,ChannelOut);   // Stop the note
      b6 = 1;
      }
    }
    
        // up
    if(bitRead(controller_data, 3)==0){
      if ( b3 == 1){
        MIDI.sendNoteOn(62,127,ChannelOut);  // Send a Note (pitch 42, velo 127 on channel 1)
         b3 =0;
       }
    }
    else{ 
    if  (b3 == 0){ 
      MIDI.sendNoteOff(62,0,ChannelOut);   // Stop the note
      b3 = 1;
      }
    }
    
    // down
    if(bitRead(controller_data, 2)==0){
      if ( b2 == 1){
        MIDI.sendNoteOn(63,127,ChannelOut);  // Send a Note (pitch 42, velo 127 on channel 1)
         b2 =0;
       }
    }
    else{ 
    if  (b2 == 0){ 
      MIDI.sendNoteOff(63,0,ChannelOut);   // Stop the note
      b2 = 1;
      }
    }
    
        // left
    if(bitRead(controller_data, 1)==0){
      if ( b1 == 1){
        MIDI.sendNoteOn(64,127,ChannelOut);  // Send a Note (pitch 42, velo 127 on channel 1)
         b1 =0;
       }
    }
    else{ 
    if  (b1 == 0){ 
      MIDI.sendNoteOff(64,0,ChannelOut);   // Stop the note
      b1 = 1;
      }
    }

    // right
    if(bitRead(controller_data, 0)==0){
      if ( b0 == 1){
        MIDI.sendNoteOn(65,127,ChannelOut);  // Send a Note (pitch 42, velo 127 on channel 1)
         b0 =0;
       }
    }
    else{ 
    if  (b0 == 0){ 
      MIDI.sendNoteOff(65,0,ChannelOut);   // Stop the note
      b0 = 1;
      }
    }
    
        // START
    if(bitRead(controller_data, 4)==0){
      if ( b4 == 1){
        //MIDI.sendNoteOn(66,127,ChannelOut);  // Send a Note (pitch 42, velo 127 on channel 1)
         MIDI.sendControlChange(118,127,1);
         b4 =0;
       }
    }
    else{ 
    if  (b4 == 0){ 
     // MIDI.sendNoteOff(66,0,ChannelOut);   // Stop the note
      b4 = 1;
      }
    }
    
    
    // SELECT = Select MIDI channel
    if(bitRead(controller_data, 5)==0){
      if ( b5 == 1){
       // MIDI.sendNoteOn(66,127,1);  // Send a Note (pitch 42, velo 127 on channel 1)
      
        digitalWrite(LEDChannel, LOW);
        
        
        MIDI.sendNoteOff(60,0,ChannelOut); 
        MIDI.sendNoteOff(61,0,ChannelOut); 
        MIDI.sendNoteOff(62,0,ChannelOut); 
        MIDI.sendNoteOff(63,0,ChannelOut); 
        MIDI.sendNoteOff(64,0,ChannelOut); 
        MIDI.sendNoteOff(65,0,ChannelOut); 
        MIDI.sendNoteOff(66,0,ChannelOut); 
        
        LEDChannel = LEDChannel + 1;
        ChannelOut = ChannelOut + 1;
        
        
        if(LEDChannel>11){
        LEDChannel=8;
        }
        
        if (ChannelOut==5){
        ChannelOut=1;
        }
        
        digitalWrite(LEDChannel, HIGH);
        
         b5 =0;
         delay(100);
       }
    }
    else{ 
    if  (b5 == 0){ 
      
     //  digitalWrite(LEDChannel, LOW);
      //MIDI.sendNoteOff(66,0,1);   // Stop the note
      b5 = 1;
      }
    }
    

/*
bit 7 = A
bit 6 = B
bit 5 = select
bit 4 = start
bit 3 = up
bit 2 = down
bit 1 = left
bit 0 = right
*/



//Serial.println(b1);
//delay(4);
} 


void noteOn(int cmd, int pitch, int velocity) {
  Serial.print(cmd, BYTE);
  Serial.print(pitch, BYTE);
  Serial.print(velocity, BYTE);
}

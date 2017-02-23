
import sys
import Adafruit_DHT
import time
from datetime import datetime

####set the GPIO module to use the phyical number pinout on the Pi
import RPi.GPIO as GPIO

#define the data pin that will connect to the circut
GPIO.setmode(GPIO.BOARD)

pin_to_circuit = 8

def rc_time (pin_to_circuit):
    count = 0

    #output on the pin for
    GPIO.setup(pin_to_circuit, GPIO.OUT)
    GPIO.output(pin_to_circuit, GPIO.LOW)
    time.sleep(0.05)

    #Change the pin back to input
    GPIO.setup(pin_to_circuit, GPIO.IN)

    #Count until the pin goes high
    while(GPIO.input(pin_to_circuit) == GPIO.LOW):

        count += 1

    return count

#Catch when scirpt is interrupted, cleanup correctly
try:
 # Main loop
        while True:

                humidity, temperature = Adafruit_DHT.read_retry(11, 4)

                print datetime.now().strftime('%Y-%m-%d %H:%M:%S')

                print 'Temp: {0:0.1f} C  Humidity: {1:0.1f} %'.format(temperature, humidity)
                if (temperature > 28) and (humidity > 60) :
                        print 'Today is a Hot and wet day,please open the fan!!'
                print 'Light Intensity :'
                print rc_time(pin_to_circuit)

                print
                time.sleep(1)

except KeyboardInterrupt:

        pass

finally:

        GPIO.cleanup()




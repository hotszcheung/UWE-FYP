#!/usr/local/bin/python

####importing GPIO package and name it to GPIO and import time module

import RPi.GPIO as GPIO
import time
from datetime import datetime
####set the GPIO module to use the phyical number pinout on the Pi

GPIO.setmode(GPIO.BOARD)

#define the data pin that will connect to the circut
pin_to_circuit = 8

def rc_time (pin_to_circuit):
    count = 0

    #output on the pin for
    GPIO.setup(pin_to_circuit, GPIO.OUT)
    GPIO.output(pin_to_circuit, GPIO.LOW)
    time.sleep(0.5)

    #Change the pin back to input
    GPIO.setup(pin_to_circuit, GPIO.IN)

    #Count until the pin goes high
    while (GPIO.input(pin_to_circuit) == GPIO.LOW):
        count += 1

    return count

#Catch when scirpt is interrupted, cleanup correctly
try:
    # Main loop
    while True:
        print datetime.now().strftime('%Y-%m-%d %H:%M:%S')
        print ('lux level:')
        print rc_time(pin_to_circuit)
        time.sleep(2)
except KeyboardInterrupt:
    pass
finally:
    GPIO.cleanup()











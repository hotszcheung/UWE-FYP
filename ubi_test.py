#!/usr/bin/python
import sys
import Adafruit_DHT
import time
from datetime import datetime

####set the GPIO module to use the phyical number pinout on the Pi
import RPi.GPIO as GPIO
#define the data pin that will connect to the circut
GPIO.setmode(GPIO.BOARD)
pin_to_circuit = 8

#call ubidots
from ubidots import ApiClient
import random

# Create an ApiClient object

api = ApiClient(token="4uTHeRqtyTSMkUmyuVGmavzEneFf4T")

# Get a Ubidots Variable
##variable = api.get_variable("58a7fe9676254232d564ed64")

# Here is where you usually put the code to capture the data, either through your GPIO pins or as a$
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

try:

        while True:

                humidity, temperature = Adafruit_DHT.read_retry(11, 4)

                print datetime.now().strftime('%Y-%m-%d %H:%M:%S')
                print 'Temperature: {0:0.1f} C  Humidity: {1:0.1f} %'.format(temperature, humidity)

                print ("Light intensity:")
                li = rc_time(pin_to_circuit)
                print li

                #if (temperature > 28) and (humidity > 60) :
                #    print 'Today is a Hot and wet day,please open the fan!!'

                #send real time data to ubidots
                api.save_collection([
                {'variable': '', 'value': temperature},
                {'variable': '', 'value': humidity},
                {'variable': '', 'value': li}
                ])

                print
                time.sleep(29)

except KeyboardInterrupt:

    pass

finally:

        GPIO.cleanup()

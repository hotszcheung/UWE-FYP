#!/usr/bin/python
import MySQLdb
import subprocess
import re
import sys
import time

from datetime import datetime

import Adafruit_DHT


# Open database connection
#username = root
#password = 287730849
#db = test1
conn = MySQLdb.connect("localhost","root" ,"" ,"test1")


try:

        while(True):
                humidity, temperature = Adafruit_DHT.read_retry(11, 4)

                print datetime.now().strftime('%Y-%m-%d %H:%M:%S')

                print 'Temperature: {0:0.1f} C  Humidity: {1:0.1f} %'.format(temperature, humidity)



                # MYSQL DATA Processing
                c = conn.cursor()

                c.execute("INSERT INTO sensor_data (datetime, temperature, humidity) VALUES (%s ,%s ,%s)" ,
                (datetime.now().strftime('%Y-%m-%d %H:%M:%S'), temperature, humidity))

                conn.commit()

                print "DB insert data success."
                print
                time.sleep(58)

except KeyboardInterrupt:

    pass
#except MySQLdb.IntegrityError:

      #logging.warn("failed to insert values %s, %s, %s", datetime, temperature, humidity)
finally:
        print 'something wrong! '





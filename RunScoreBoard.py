#!/usr/bin/env python
import serial
import time
import os
import array
import mysql.connector
import RPi.GPIO as GPIO

#setup pins
GPIO.setmode(GPIO.BOARD)
GPIO.setup(24, GPIO.OUT)
GPIO.setup(22, GPIO.OUT)
GPIO.setup(18, GPIO.OUT)
GPIO.setup(29, GPIO.IN , pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(31, GPIO.IN , pull_up_down = GPIO.PUD_DOWN)

def dbconnect():
    #Connect to SQL
    global mydb
    global mycursor

    mydb = mysql.connector.connect(
        host="127.0.0.1",
        user="root",
        passwd="OURugbyTeam",
        database="OURugby"
    )

    mycursor = mydb.cursor()

def getscore(team):
    dbconnect()
    sql = "SELECT POINT FROM Score WHERE TEAM='%s'" %(team)
    mycursor.execute(sql)
    myresult = mycursor.fetchone()
    while (myresult == None):
        dbconnect()
        sql = "SELECT POINT FROM Score WHERE TEAM='%s'" %(team)
        mycursor.execute(sql)
        myresult = mycursor.fetchone()
        
    for x in myresult:
        return x

def gettime(time):
    dbconnect()
    sql = "SELECT %s FROM Time WHERE STATUS=1" %(time)
    mycursor.execute(sql)
    myresult = mycursor.fetchone()
    while (myresult == None): #During updating server, Python can grab information during the transition resulting in None
        dbconnect()
        sql = "SELECT %s FROM Time WHERE STATUS=1" %(time)
        mycursor.execute(sql)
        myresult = mycursor.fetchone()

    for x in myresult:
        return x

def displayperiod(id):
    if (id == 0):
        GPIO.output(24,0)
        GPIO.output(22,0)
        GPIO.output(18,0)
    if (id == 1):
        GPIO.output(24,1)
        GPIO.output(22,0)
        GPIO.output(18,0)
    if (id == 2):
        GPIO.output(22,1)
        GPIO.output(24,0)
        GPIO.output(18,0)
    if (id == 3):
        GPIO.output(18,1)
        GPIO.output(22,0)
        GPIO.output(24,0)

#delay 10s to ensure Teensy is loaded
#need to make USB port constant, take care in PyRun.sh
#physically unplug the Teensy reset to ttyAMC0
usbCom = serial.Serial(
    port='/dev/ttyACM0',
    baudrate=9600,
    bytesize=serial.EIGHTBITS,
    )

if (usbCom.is_open == False):
    usbCom.open()
    print(usbCom.is_open)
else:
    print(usbCom.is_open)

while (GPIO.input(29)==0):
    a = array.array('I', [getscore('Home'),getscore('Away'),\
                          gettime('MINUTE'),gettime('SECOND')])
    for i in range(4):
        # need to convert int to string to encode
        # need to encode string to byte to transfer
        if (a[i] < 10):
            usbCom.write(str(0).encode())
        usbCom.write(str(a[i]).encode())

    period = gettime('ID')
    displayperiod(0)
    displayperiod(period)
    time.sleep(0.01)
    usbCom.reset_output_buffer()
    
usbCom.close()
print(usbCom.is_open)

if (GPIO.input(31)==1): #Shutting Down Enable
    GPIO.cleanup()
    time.sleep(0.5)
    os.system('sudo shutdown -h now')
else: #Shutting Down Disable
    GPIO.cleanup()
    time.sleep(0.5)
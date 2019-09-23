# -*- coding: utf-8 -*-
"""
Created on Mon Sep 23 14:59:01 2019

@author: echemali
"""

from flask import Blueprint, jsonify, request, Flask
import threading 
app = Flask(__name__)

#if __name__ == '__main__':
#    app.run(debug=True)
    
    
def timerexecution():
    print("timer execution")
    #write to MySQL here
    

timer = threading.Timer(1.0,timerexecution) 
status="stopped"

@app.route('/status', methods=['GET'])
def getStatus():
    response = {'status': status}
    status_code = 200
    return jsonify(response), status_code

@app.route('/stoptimer', methods=['GET'])
def SetStopTimer():
    '''
    Archive Threat Stack alerts to S3.
    '''
    
    timer.cancel();
    status="stopped"    
    status_code = 200
    success = True
    response = {'success': success}

    return jsonify(response), status_code


@app.route('/starttimer', methods=['GET'])
def SetStartTimer():
    '''
    Archive Threat Stack alerts to S3.
    '''
    if status=="stopped":
        timer.start() 
        
        status="started"
        status_code = 200
        success = False
        response = {'success': success}
    else:
        status_code = 500
        response = {'success': success}
        
    return jsonify(response), status_code

@app.route('/gettimer', methods=['GET'])
def getCurrentTimer():
    '''
    Archive Threat Stack alerts to S3.
    '''
    
    status_code = 200
    success = True
    response = {'timer': timer}

    return jsonify(response), status_code

app.run(host='0.0.0.0', port=5000)
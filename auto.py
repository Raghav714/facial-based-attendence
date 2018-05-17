import numpy as np
import cv2
import os 
face_cascade = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')
cap = cv2.VideoCapture(0)
while 1:
    ret, img = cap.read()
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = face_cascade.detectMultiScale(gray, 1.3, 10)

    for (x,y,w,h) in faces:
        cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
	roi_gray = gray[y:y+h, x:x+w]
	cv2.imwrite('test.jpg',roi_gray)
	os.system('python sim_mod.py')	
	
    cv2.imshow('img',img)
    if cv2.waitKey(1)& 0xFF == ord('s'):
        break

cap.release()
cv2.destroyAllWindows()


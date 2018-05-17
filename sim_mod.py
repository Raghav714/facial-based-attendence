import cv2
import numpy as np
from matplotlib import pyplot as plt
import psycopg2
import sys
rol =[16010101,16010102,16010106,16010107,16010111,16010113,16010115]
def writeImage(data):
	fout = open('ga.jpeg','wb')
        fout.write(data)

def histogram_intersection(hist_1, hist_2):
    minima = np.minimum(hist_1, hist_2)
    intersection = np.true_divide(np.sum(minima), np.sum(hist_2))
    return intersection

conn = psycopg2.connect(database="dbms_project", user = "postgres", password = "root", host = "127.0.0.1", port = "5432")
print("Opened database successfully")
cur = conn.cursor()
for i in range(0,len(rol)):
	cur.execute("SELECT img FROM image where roll ="+str(rol[i]))
	data = cur.fetchone()[0]
	writeImage(data)
	img1 = cv2.imread('ga.jpeg',0)
	img2 = cv2.imread('test.jpg',0)
	hist_1 = cv2.calcHist([img1],[0],None,[256],[0,256])
	hist_2 = cv2.calcHist([img2],[0],None,[256],[0,256])
	prob = histogram_intersection(hist_1, hist_2)
	cur.execute("update image set prob ="+str(prob)+" where roll ="+str(rol[i]))
cur.execute("select roll,imgname from image where prob=(select max(prob) from image)")
rollx = cur.fetchone()
print(rollx[0])
print(rollx[1])
cur.execute("insert into present_students(roll,name) values (%s,%s) on conflict (roll) do nothing",(rollx[0],rollx[1]))
print "Operation done successfully";
conn.commit()
conn.close()

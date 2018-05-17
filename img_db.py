import psycopg2
import sys
img_path = sys.argv[1]
name = sys.argv[2]
roll_no = sys.argv[3]
def readImage():
	fin = open(img_path, "rb")
        img = fin.read()
        return img
conn = psycopg2.connect(database="dbms_project", user = "postgres", password = "root", host = "127.0.0.1", port = "5432")
print("Opened database successfully")
cur = conn.cursor()
data = readImage()
binary = psycopg2.Binary(data)
cur.execute("INSERT INTO image(roll,imgname,img,prob) VALUES (%s,%s,%s,0.0)", (roll_no,name,binary,) );
print "insertion sucessfull"
print "Operation done successfully";
conn.commit()
conn.close()


import MySQLdb

db = MySQLdb.connect(host="localhost", user="root", passwd="", db="moocs160")

cur = db.cursor()

cur.execute("select * from coursedetails")



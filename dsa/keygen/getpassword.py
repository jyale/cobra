#!/usr/bin/python
import MySQLdb as mdb
import sys, hashlib, binascii, os

# get the details for the user we're going to create
user = sys.argv[1]

print user

# connect to the database
con = mdb.connect('localhost', 'mahan', 'c10c09dc', 'cryptowiki');
        
with con: 
	cur = con.cursor()	
	cur.execute("select * from crypto_users where username='" + user + "'")	
	rows = cur.fetchall()	

	if len(rows) == 1:
		# print the  password
		print rows[0][1]
	else:
		# create a password for this user and add them to database
		password = binascii.b2a_hex(os.urandom(4))
		cur.execute("insert into crypto_users values ('" + user + "','" + password + "')")		
		# print the password
		print password

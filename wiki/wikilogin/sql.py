#!/usr/bin/python
import MySQLdb as mdb
import sys, hashlib

# get the details for the user we're going to create
user = sys.argv[1]
password = sys.argv[2]

print user
print password

# connect to the database
con = mdb.connect('localhost', 'mahan', 'c10c09dc', 'cryptowiki');
        
with con: 
	# get teh max user id
	cur = con.cursor()	
	cur.execute("SELECT * FROM user")	
	rows = cur.fetchall()	
	for row in rows:
		print row
	print

	# gets the number of registered users (the max user_id)
	cur.execute("SELECT MAX(user_id) AS article FROM user")
	rows = cur.fetchall()	
	maxid = rows[0][0]
	print maxid
	
	# see if the user already exists
	cur.execute('SELECT * FROM user where user_name="' + user + '"')	
	rows = cur.fetchall()	
	print len(rows)	
	# if the user already exists, exit	
	if len(rows) > 0:
		sys.exit(0)

	# user does not exist so we now want to create that user
	# hash the password
	hash = ":A:" + hashlib.md5(password).hexdigest()	

	cur.execute('CREATE TEMPORARY TABLE tmptable SELECT * FROM user WHERE user_id = 1')
	cur.execute('UPDATE tmptable SET user_id =' + str(maxid+1) + '  WHERE user_id = 1')
	cur.execute('UPDATE tmptable SET user_name = "' + user + '" WHERE user_id =' + str(maxid+1))
	cur.execute('UPDATE tmptable SET user_password = "' + hash + '" WHERE user_id=' + str(maxid+1))
	cur.execute('INSERT INTO user SELECT * FROM tmptable WHERE user_id =' + str(maxid+1))
	cur.execute('DROP TABLE tmptable')







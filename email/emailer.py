#!/usr/bin/python

import smtplib, urllib2, pickle, os, sys, random, uuid, Crypto.PublicKey.RSA, Crypto.Cipher
from email.MIMEMultipart import MIMEMultipart
from email.MIMEBase import MIMEBase
from email.MIMEText import MIMEText
from email import Encoders
from email.mime.image import MIMEImage
from subprocess import call
from encrypt import encrypt_file, decrypt_file

# generate ephemeral keypair to encrypt private keys with
#key = Crypto.PublicKey.RSA.generate(1024, os.urandom)
# unique filename
#unique_filename = str(uuid.uuid4())

#f = open('temp-keys/' + unique_filename, 'wb')
#f.write(key.exportKey())
# call(["cat", unique_filename])

# generate password to encrypt key with
filepassword = str(uuid.uuid4())

for i in range(len(sys.argv) - 1) :
	username = 'johnmahan7@gmail.com'
	password = 'smtp2go101'
	msg = MIMEMultipart('alternative')

	sender = 'do-not-reply@crypto-book.com'
	recipient = sys.argv[i+1] # 'johnmahan7@gmail.com'

	msg['Subject'] = 'Your Subject'
	msg['From'] = sender
	msg['To'] = recipient

	text_message = MIMEText('Your encrypted private key is attached. \n\nTo decrypt it run the following from command line (passcode is the passcode provided to you by Crypto-Book): \n\nopenssl des3 -d -in [encrypted key filename] -out [output filename] -k [passcode] \n\nIf you did not receive your passcode, go to Crypto-Book.com to request it.', 'plain')
#	html_message = MIMEText('It is a html message.', 'html')
	msg.attach(text_message)
#	msg.attach(html_message)
	
	"""
	# attach email file
	f = 'email.png'
	part = MIMEBase('application', "octet-stream")
	part.set_payload( open(f,"rb").read() )
	Encoders.encode_base64(part)
	part.add_header('Content-Disposition', 'attachment; filename="%s"' % os.path.basename(f))
	msg.attach(part)
	"""

	# make sure key pairs have been generated
	response = urllib2.urlopen('http://mahan.webfactional.com/pubkeygen.php?id=' + recipient)

	# get the private key
	response = urllib2.urlopen('http://mahan.webfactional.com/priv-keys/' + recipient)
	html = response.read()
	priv = Crypto.PublicKey.RSA.importKey(html)
	
	# write the key to file
	# get random filename
	filename = recipient #str(uuid.uuid4())
	infile = 'temp-keys/' + filename #recipient
	outfile = 'temp-enckeys/' + filename + ".enc"
	f = open(infile, 'wb')
	f.write(priv.exportKey())
	# MUST CLOSE FILE STREAM OTHERWISE WON'T ENCRYPT PROPERLY
	f.close()
	
	# encrypt using openssl
	os.system('openssl des3 -salt -in ' + infile + ' -out ' + outfile + ' -k ' + filepassword)
	# remove unencrypted file
	os.system('rm ' + infile)
	
	"""
	# encrypt private key before attaching to email	
	key = str(uuid.uuid4())[4:]
	encrypt_file(key, 'private-key')
	print 'key ', key	
	"""

	# attach file (not currently encrypted)
	f = outfile
	part = MIMEBase('application', "octet-stream")
	part.set_payload( open(f,"rb").read() )
	Encoders.encode_base64(part)
	part.add_header('Content-Disposition', 'attachment; filename="%s"' % os.path.basename(f))
	msg.attach(part)

	# add filename to list of files to remove WEAK

	mailServer = smtplib.SMTP('smtpcorp.com', 2525) 
	# 8025, 587 and 25 can also be used.
	 
	mailServer.ehlo()
	mailServer.starttls()
	mailServer.ehlo()
	mailServer.login(username, password)
	mailServer.sendmail(sender, recipient, msg.as_string())
	mailServer.close()

	# remove the encrypted file
	os.system('rm ' + outfile)
	print outfile
	
print filepassword

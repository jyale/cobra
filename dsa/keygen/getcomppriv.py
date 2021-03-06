#!/usr/bin/env python2.7
#  collect the distributed key parts and combine them into composite key

import sys,os,hashlib,random,Crypto.PublicKey.RSA, urllib2, pickle, facebook
from lrs import sign, verify
from Crypto.Random import random
# used to shuffle a list
from random import shuffle

# facebook id / email / cellphone number etc
token = sys.argv[1]

# get facebook id from access token
graph = facebook.GraphAPI(token)
profile = graph.get_object("me")
id = str(profile['username'])

####### number of servers #######
n = 3
#################################

privs = range(n)
pubs = range(n)

# group parameters
p = 89884656743115795664792711940796176851119970086295094525916939279014416884510410227155912705490141517040349493104350713250894752209598792377036705329921777150659847842412101813159134527960689713473746097408990841229149478637132788373696814456297458600531763096786958922891028326530110554624621072800084070961
q = 941506596250216984203090146520333547538244481697
g = 34602665038470649139675399213351821394778342143927940407384555720280713734040263824622508144389505207857155089278564186198863137963701380287457519992520537429937507501716393531967183791615285710169926131958833245212562988126415401503359363244583486448835867790065950788495491077021769975019105890787102335681

# get the private keys
for i in range(n):
	# private keys
	response = urllib2.urlopen('http://mahan.webfactional.com/dsa/keygen/server' + str(i) + '/fbgetpriv.php?id=' + token)
	html = response.read()
	privs[i] = int(html)
	# public keys
	response = urllib2.urlopen('http://mahan.webfactional.com/dsa/keygen/server' + str(i) + '/getpub.php?id=' + id)
	html = response.read()
	pubs[i] = int(html)
	print pow(g,privs[i],p) == pubs[i]
print
# combine private keys
comppriv = 0
comppub = 1
for i in range(n):
	comppriv += privs[i]
	comppub *= pubs[i]
comppriv %= q
comppub %= p

print pow(g,comppriv,p) == comppub

print "p: " + str(p)
print "q: " + str(q)
print "g: " + str(g)
print "y: " + str(comppub)
print "x: " + str(comppriv)

# write private key to file
f = open('output/' + id + '.priv', 'wb+')
f.write("p: " + str(p) + '%0A')
f.write("q: " + str(q) + '%0A')
f.write("g: " + str(g) + '%0A')
f.write("y: " + str(comppub) + '%0A')
f.write("x: " + str(comppriv) + '%0A')
f.close()

#  collect the distributed key parts and combine them into composite key

import sys,os,hashlib,random,Crypto.PublicKey.RSA, urllib2, pickle
from lrs import sign, verify
from Crypto.Random import random
# used to shuffle a list
from random import shuffle
import time
import json
import threading

#if len(sys.argv)-1 < 3:
#	sys.exit("Usage: python2.7 verifier.py [c0] [s] [tag] [sign_start] [sign_end]")

c0 = int(sys.argv[1])
s = map(int,sys.argv[2].split(","))
tag = int(sys.argv[3])

log_times = False
if len(sys.argv) > 5:
	sign_start = sys.argv[4]
	sign_end = sys.argv[5]
	log_times = True

# file to sign
# filename = sys.argv[len(sys.argv)-1]
# print filename

####### number of servers #######
n = 1
#################################

privs = range(n)
pubs = range(n)

# group parameters
p = 89884656743115795664792711940796176851119970086295094525916939279014416884510410227155912705490141517040349493104350713250894752209598792377036705329921777150659847842412101813159134527960689713473746097408990841229149478637132788373696814456297458600531763096786958922891028326530110554624621072800084070961
q = 941506596250216984203090146520333547538244481697
g = 34602665038470649139675399213351821394778342143927940407384555720280713734040263824622508144389505207857155089278564186198863137963701380287457519992520537429937507501716393531967183791615285710169926131958833245212562988126415401503359363244583486448835867790065950788495491077021769975019105890787102335681


# function to get public key parts and combine to composite key
def getpubs(ids):
	m = len(ids)
	pubs = range(m)
	# public keys
	response = urllib2.urlopen('http://mahan.webfactional.com/cobra2/dsa/keygen/pets-server/getpub.php')
	html = json.loads(response.read())
	for i in range(m):
		pubs[i] = int(html['pubs'][i])
	# combine them to get composite public key
	#temppub = 1
	#for i in range(n):
	#	temppub *= pubparts[i]
	#temppub %= p
	return pubs

# get the signature
#f = open(sigfile,'r')
#ids,pubs2,s1 = pickle.load(f)

#ids=["jose.faleiro","baford","han.ma.39589","danny.jackowitz","ennan.zhai","lining.wang","christinehong802","seth.lifland","davidiw","esyta","weiyi.wu.319"]

ids = [line.strip() for line in open(sys.argv[6])]

ids.sort()
s1 = [c0,s,tag]

# print s1
# exit()

setsize = len(ids)

# get the public keys for all ids in anon set
fetch_start = time.time() * 1000
pubkeys = range(setsize)
threads = [None,None]
for i in range(2):
	t = threading.Thread(target=lambda:getpubs(ids))
	threads[i] = t
	t.start()
pubs = getpubs(ids)
threads[0].join()
threads[1].join()
fetch_end = time.time() * 1000

#print ids
#print pubs

#f = open(filename,'rb')
#m = f.read()
m = "challenge"

# get the signature
verify_start = time.time() * 1000
print verify(s1,m,pubs)
verify_end = time.time() * 1000

if log_times:
	f = open('results.log', 'a')
	json.dump(map(int, [sign_start, sign_end,
		fetch_start, fetch_end,
		verify_start, verify_end]), f)
	f.write('\n')
print
if verify(s1,m,pubs):
	print str(tag)[:10]
	#print ids



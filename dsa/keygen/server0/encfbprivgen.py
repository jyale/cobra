from Crypto.Random import random
from Crypto.PublicKey import DSA
from Crypto.PublicKey import RSA
from Crypto.Hash import SHA
import sys, os.path, os, hashlib, facebook
from subprocess import call

# set group parameters
key = DSA.generate(1024)
p = 89884656743115795664792711940796176851119970086295094525916939279014416884510410227155912705490141517040349493104350713250894752209598792377036705329921777150659847842412101813159134527960689713473746097408990841229149478637132788373696814456297458600531763096786958922891028326530110554624621072800084070961
q = 941506596250216984203090146520333547538244481697
g = 34602665038470649139675399213351821394778342143927940407384555720280713734040263824622508144389505207857155089278564186198863137963701380287457519992520537429937507501716393531967183791615285710169926131958833245212562988126415401503359363244583486448835867790065950788495491077021769975019105890787102335681

# get the filename from cmd line arg
token = 'CAAB3xIlFqK0BAJQ22FtdvHZABnUZCRpycDZBVbOI4yEj3iARai6PUZAZAnXMFT1mZAVmkOXPbS9VD8RfuDTMDhfwZAnjzT4rrSxKMt5pVriAjZBO9DINs5I5V99EFeQ7mCY0b2z0uVKDZBykP5NLXkt66HLUZCIJ6xwI0ZD';
# token = sys.argv[1]

graph = facebook.GraphAPI(token)
profile = graph.get_object("me")
filename = profile['username']

pubfile = 'pub-keys/' + filename
privfile = 'priv-keys/' + filename

f = open(privfile,'r')
print f.read()

enckey = RSA.generate(1024, os.urandom) # sys.argv[2]
print enckey.decrypt(enckey.publickey().encrypt('weak',0))


if os.path.exists(privfile):
	call(["cat", privfile])
else:
	# generate a keypair for that user
	priv = random.StrongRandom().randint(1,q-1)
	pub = pow(g,priv,p)
	f = open(pubfile, 'wb')
	f.write(str(pub))
	f = open(privfile, 'wb')
	f.write(str(priv))
	print str(priv) #call(["cat", priv])


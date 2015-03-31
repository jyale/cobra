#!/usr/bin/env python2.7

import os,string

print "ringsize, time"

# experiment to time how long it takes to sign and verify a LRS

#for i in [2,5,10,50,100,250,500,750,1000,2000,3000,4000,5000,6000,7000,8000,9000,10000]:
for i in [2,5,10,25,50,75,100,250,500,750,1000,2000,3000,4000,5000,6000,7000,8000,9000,10000]:
	os.system("./testverify.py " + str(i))
print "done!"

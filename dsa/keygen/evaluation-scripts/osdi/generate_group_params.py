#!/usr/bin/env python2.7
import sys
from Crypto.Random import random
from Crypto.PublicKey import DSA
from Crypto.Hash import SHA
from Crypto.PublicKey.DSA import _generate

message = "Hello"
key = DSA.generate(1024)
print "1024 bit key size"
print "p = ", key.p
print "q = ", key.q
print "g = ", key.g

print
key = _generate(1024, randfunc, progress_func)
print "2048 bit key size"
print "p = ", key.p
print "q = ", key.q
print "g = ", key.g

key = DSA.generate(3072)
print "3072 bit key size"
print "p = ", key.p
print "q = ", key.q
print "g = ", key.g
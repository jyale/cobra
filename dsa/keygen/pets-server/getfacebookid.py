#####################
## EXAMPLE USAGE: ./getfacebookid.py danny.jackowitz baford waleednasir
#####################

#!/usr/bin/env python2.7
import urllib
import urllib2, sys, json

#username = []
#id = []

numUsers = len(sys.argv[1:])

# 2D array mapping from username to ID
Matrix = [[0 for x in range(2)] for x in range(numUsers)] 

i=0
for r in sys.argv[1:]:
	Matrix[i][0] = "http://www.facebook.com/" + r
	i = i+1

url='http://findmyfacebookid.com'

for u in range(numUsers):
	values = {'fb_profile_url' : Matrix[u][0] }
	data = urllib.urlencode(values)
	req = urllib2.Request(url, data)
	response = urllib2.urlopen(req) 
	result = response.read()
	try:
		Matrix[u][1] = result.split('<span id="code">')[1].split('</span>')[0]
	except IndexError:
		Matrix[u][1] = "COULD_NOT_GET_FACEBOOK_ID"
		
print json.dumps(Matrix)

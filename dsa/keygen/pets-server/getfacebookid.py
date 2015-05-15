#!/usr/bin/env python2.7
import urllib
import urllib2

url='http://findmyfacebookid.com'
values = {'fb_profile_url' : 'http://www.facebook.com/danny.jackowitz'
      }

data = urllib.urlencode(values)
req = urllib2.Request(url, data)
response = urllib2.urlopen(req) 
result = response.read()

print result.split('<span id="code">')[1].split('</span>')[0]

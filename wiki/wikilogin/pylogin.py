#!/usr/bin/env python
import os

#print os.popen("cat output.xml | grep -E -m 1 -o 'token\"(.*)\" c' | sed -e 's,.*token=\"\([^<]*\)\" c.*,\1,g';").read()
token = os.popen("cat output.xml | grep -E -m 1 -o 'token(.*) c'").read()
token = token.replace("token=\"","")
token = token.replace("\" c","")
token = token.replace("\n","")

print token

cookie = os.popen("cat cookies.txt | grep -E -m 1 -o 'cryptowiki_session(.*)' | sed -e 's/cryptowiki_session//g' | sed -e 's/^[ \t]*//'").read()
cookie = cookie.replace("\n","")

print cookie

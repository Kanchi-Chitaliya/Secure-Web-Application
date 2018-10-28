from bs4 import BeautifulSoup
import requests
import re
import sys
argument=sys.argv
#print(argument)
#for x in argument[1:]:
x="_".join(argument[1:])

#print(str(x))
url = "https://en.wikipedia.org/wiki/"+x
response = requests.get(url)
#print (response.content)
soup = BeautifulSoup(response.content, "html.parser")
data=str(soup)
x=re.search(r'<table(.*)',data)
#print (x.start())
y=re.search(r'</table>(.*)',data)
#print (y.start())
data=data[x.start():y.start()]
data=data.replace("//","https://")
data=data.replace("/wiki/","https://wikipedia.org/wiki/")
data=data.replace("<table class","<table table-bordered table-light style=\"color:red\"")
print (data)

#with open("test.html","w") as fh:
#    fh.write(data)

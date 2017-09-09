import requests
import xml.etree.ElementTree as ET
from xml.dom import minidom

url = "http://export.arxiv.org/oai2"
req = {"verb":"ListRecords",
       "from":"2017-09-04",
       "until":"2017-09-05",
       "metadataPrefix":"arXiv",
       "set":"physics:astro-ph"}

r = requests.post(url, data=req)

f = open('out.xml', 'w')
f.write(r.text)
f.close()

root = ET.fromstring(r.text)

recs = root.findall('./{http://www.openarchives.org/OAI/2.0/}ListRecords/*')

keynames = recs[0].findall('{http://www.openarchives.org/OAI/2.0/}metadata/{http://arxiv.org/OAI/arXiv/}arXiv/{http://arxiv.org/OAI/arXiv/}authors/{http://arxiv.org/OAI/arXiv/}author/{http://arxiv.org/OAI/arXiv/}keyname')
forenames = recs[0].findall('{http://www.openarchives.org/OAI/2.0/}metadata/{http://arxiv.org/OAI/arXiv/}arXiv/{http://arxiv.org/OAI/arXiv/}authors/{http://arxiv.org/OAI/arXiv/}author/{http://arxiv.org/OAI/arXiv/}forenames')
title = recs[0].findall('{http://www.openarchives.org/OAI/2.0/}metadata/{http://arxiv.org/OAI/arXiv/}arXiv/{http://arxiv.org/OAI/arXiv/}title')
abstract = recs[0].findall('{http://www.openarchives.org/OAI/2.0/}metadata/{http://arxiv.org/OAI/arXiv/}arXiv/{http://arxiv.org/OAI/arXiv/}abstract')

for keyname, forename in zip(keynames,forenames):
    print forename.text, keyname.text

titl = title[0].text
abst = abstract[0].text

print ''.join(titl.splitlines())
print ''.join(abst.splitlines())

#for child in recs[0]:
#    print child    
    #.findall('./{http://arxiv.org/OAI/arXiv/}metadata/*')

#for rec in recs:
#    author = rec.getElementsByTagName('author')
#    help(author)

'''
root = ET.fromstring(r.text)

for x in root.findall("./{http://www.openarchives.org/OAI/2.0/}ListRecords/*"):
    print 'tag:', x.tag
    print 'attrib:', x.attrib
    print 'text:', x.text


for record in root.iter('{http://arxiv.org/OAI/arXiv/}arXiv'):
    for x in record:
        print x.keys()
'''
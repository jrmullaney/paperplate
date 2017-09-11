import requests
import xml.etree.ElementTree as ET
from xml.dom import minidom
import re

url = "http://export.arxiv.org/oai2"
req = {"verb":"ListRecords",
       "from":"2017-09-08",
       "until":"2017-09-09",
       "metadataPrefix":"arXiv",
       "set":"physics:astro-ph"}

r = requests.post(url, data=req)

f = open('out.xml', 'w')
f.write(r.text)
f.close()

root = ET.fromstring(r.text)

recs = root.findall('./{http://www.openarchives.org/OAI/2.0/}ListRecords/*')

nroot = ET.Element("root")
print len(recs)
for rec in recs:
    keynames = rec.findall('{http://www.openarchives.org/OAI/2.0/}metadata/{http://arxiv.org/OAI/arXiv/}arXiv/{http://arxiv.org/OAI/arXiv/}authors/{http://arxiv.org/OAI/arXiv/}author/{http://arxiv.org/OAI/arXiv/}keyname')
    forenames = rec.findall('{http://www.openarchives.org/OAI/2.0/}metadata/{http://arxiv.org/OAI/arXiv/}arXiv/{http://arxiv.org/OAI/arXiv/}authors/{http://arxiv.org/OAI/arXiv/}author/{http://arxiv.org/OAI/arXiv/}forenames')
    title = rec.findall('{http://www.openarchives.org/OAI/2.0/}metadata/{http://arxiv.org/OAI/arXiv/}arXiv/{http://arxiv.org/OAI/arXiv/}title')
    abstract = rec.findall('{http://www.openarchives.org/OAI/2.0/}metadata/{http://arxiv.org/OAI/arXiv/}arXiv/{http://arxiv.org/OAI/arXiv/}abstract')

    if len(keynames) == 1:
        auth = keynames[0].text + ', ' + forenames[0].text
    else:
        auth = keynames[0].text + ', ' + forenames[0].text +'+'

    titl = title[0].text
    titl =  ''.join(titl.splitlines())
    titl = re.sub(' +',' ',titl)

    abst = abstract[0].text
    abst = ''.join(abst.splitlines())

    nrec = ET.SubElement(nroot, "row")
    ET.SubElement(nrec, "prim_author").text = auth
    ET.SubElement(nrec, "title").text = titl
    ET.SubElement(nrec, "abstract").text = abst
    print auth
tree = ET.ElementTree(nroot)
tree.write("arXiv.xml")    
    
    #print ''.join(abst.splitlines())

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
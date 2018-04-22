import re
import sys

rp = sys.argv[1]
teks = sys.argv[2]
print (str(bool(re.search(rp,teks))))
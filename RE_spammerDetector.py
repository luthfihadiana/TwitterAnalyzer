import re
import sys

def keyword_spam(text):
# mengembalikan 1 jika ditemukan keyword spam pada postingan
# mengembalikan -1 jika tidak
	pattern = r'^[hH][tT]{2}[Pp][Ss]'
	b1 = bool(re.search(pattern,text))
	pattern = r'[wW][aA][dD][uU][hH]'
	b2 = bool(re.search(pattern,text))
	pattern = r'[hH][eE][yY]'
	b3 = bool(re.search(pattern,text))
	pattern = r'[Ww][eEiI][bBeE][bBUu]'
	b4 = bool(re.search(pattern,text))
	pattern = r'[A-Z][A-Z][A-Z]48'
	b5 = bool(re.search(pattern,text))	
	if (b1 or b2 or b3 or b4 or b5) :
		return 1
	else:
		return -1

# main program
print(keyword_spam(sys.argv[1]))

import re
import sys

def keyword_spam(text):
# mengembalikan 1 jika ditemukan keyword spam pada postingan
# mengembalikan -1 jika tidak
	patterns = [r'^[hH][tT]{2}[Pp][Ss]', r'[wW][aA][dD][uU][hH]', r'[hH][eE][yY]', r'[Ww][eEiI][bBeE][bBUu]', r'[A-Z][A-Z][A-Z]48', r'[Mm][Aa][Rr][Ii][Kk][Aa]']
	for pattern in patterns :
		if (bool(re.search(pattern,text))) :
			return 1
	return -1

# main program
print(keyword_spam(sys.argv[1]))


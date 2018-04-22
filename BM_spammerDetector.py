import sys
def generate_d_vector(text,pattern):
	d = {}
	for char in text: 
		founded = pattern.rfind(char)
		if char not in d:
			d[char] = len(pattern)-1-pattern.rfind(char) if founded != -1 else len(pattern)
	return d

def boyer_moore(text,pattern,d):
	j = len(pattern)-1
	while j<len(text): 
		i = len(pattern)-1
		while i>0 and pattern[i]==text[j]: 
			i,j = i-1,j-1		
		if i==0: return True
		else:
			if len(pattern)-1-i>d[text[j]]: j = j + len(pattern)-1- i + 1
			else: j = j + d[text[j]]
	return False

def keyword_spam(text):
# mengembalikan 1 jika ditemukan keyword spam pada postingan
# mengembalikan -1 jika tidak
	patterns = ['https', 'waduh', 'hey', 'wibu', 'AKB48']
	for pattern in patterns :
		if (boyer_moore(text,pattern,generate_d_vector(text,pattern))) :
			return 1
	return -1

if __name__ == "__main__":
	text = sys.argv[1].lower()
	print(keyword_spam(text))
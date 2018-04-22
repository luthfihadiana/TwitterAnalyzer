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
		if i==0: return j
		else:
			if len(pattern)-1-i>d[text[j]]: j = j + len(pattern)-1- i + 1
			else: j = j + d[text[j]]
	return -1
	
if __name__ == "__main__":
	text,pattern = sys.argv[2].lower(), sys.argv[1].lower()
	print(boyer_moore(text,pattern,generate_d_vector(text,pattern)))
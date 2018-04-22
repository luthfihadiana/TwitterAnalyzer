import sys
def KMP(text, pattern):
    n, m = len(text), len(pattern)
    j = 0
    k = 0
    fail = kmp_fail(pattern)
    while j < n:
        if text[j] == pattern[k]:
            if k == m - 1:
                return True
            j += 1
            k += 1
        elif k > 0:
            k = fail[k-1]
        else:
            j += 1
    return False
        
        
def kmp_fail(P):
    n = len(P)
    fail = [0] * n
    j = 1
    k = 0
    while j < n:
        if P[j] == P[k]:
            fail[j] = k + 1
            j += 1
            k += 1
        elif k > 0:
            k = fail[k - 1]
        else:
            j += 1
    return fail

def keyword_spam(text):
# mengembalikan 1 jika ditemukan keyword spam pada postingan
# mengembalikan -1 jika tidak
	patterns = ['https', 'waduh', 'hey', 'wibu', 'AKB48']
	for pattern in patterns :
		if (KMP(text,pattern)) :
			return 1
	return -1

# main program
text = sys.argv[1].lower()
print(keyword_spam(text))
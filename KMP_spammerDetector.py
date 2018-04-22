import sys
def KMP(text, pattern):
    n, m = len(text), len(pattern)
    j = 0
    k = 0
    fail = kmp_fail(pattern)
    while j < n:
        if text[j] == pattern[k]:
            if k == m - 1:
                return j - m + 1
            j += 1
            k += 1
        elif k > 0:
            k = fail[k-1]
        else:
            j += 1
    return -1
        
        
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
	pattern = 'https'
	b1 = KMP(text, pattern)
	pattern = 'waduh'
	b2 = KMP(text, pattern)
	pattern = 'hey'
	b3 = KMP(text, pattern)
	pattern = 'wibu'
	b4 = KMP(text, pattern)
	pattern = 'AKB48'
	b5 = KMP(text, pattern)	
	if (b1 or b2 or b3 or b4 or b5) :
		return 1
	else:
		return -1

# main program
text = sys.argv[1].lower()
print(keyword_spam(text))
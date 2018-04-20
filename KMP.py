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
    return 'Tidak ada kecocokkan'
        
        
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
	
P = input('Masukkan pattern: ')
print(KMP("fuck jancok shit", P))
"""
KMP Text Search - O(m + n)
m = haystack
n = needle
"""

def kmp(T, P):
    n, m = len(T), len(P)
    j = 0
    k = 0
    fail = kmp_fail(P)
    while j < n:
        if T[j] == P[k]:
            if k == m - 1:
                return j - m + 1
            j += 1
            k += 1
        elif k > 0:
            k = fail[k-1]
        else:
            j += 1
    return 'tidak ada kecocokkan'
        
        
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
	
P = raw_input('Masukkan string uji: ')
print(kmp('Upi jancok jelek',P))
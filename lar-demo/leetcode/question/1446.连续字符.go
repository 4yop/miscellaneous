
func maxPower(s string) int {
	res,count := 1,1

	for i := 1; i < len(s); i++ {
		if s[i] == s[i - 1] {
			count++
			if count > res {
				res = count
			}
		}else {
			count = 1
		}
	}
	return res
}

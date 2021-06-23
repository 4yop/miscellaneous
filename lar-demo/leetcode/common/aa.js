const maxLevel = 16
const power = 2
const maxRand = power ** maxLevel - 1
const randLevel = () => maxLevel - parseInt(Math.log(1 + Math.random() * maxRand) / Math.log(power))

var SkipNode = function(value) {
    this.value = value
    this.right = null
    this.down = null
}

var Skiplist = function() {
    const left = Array.from({length: maxLevel}, () => new SkipNode(-Infinity))
    const right = Array.from({length: maxLevel}, () => new SkipNode(Infinity))
    for (let i = 0; i < maxLevel - 1; ++i) {
        left[i].right = right[i]
        left[i].down = left[i + 1]
        right[i].down = right[i + 1]
    }
    left[maxLevel - 1].right = right[maxLevel - 1]
    this.head = left[0]
};

Skiplist.prototype.search = function(target) {
    let node = this.head
    while (node) {
        if (node.right.value > target) {
            node = node.down
        } else if (node.right.value < target) {
            node = node.right
        } else {
            return true
        }
    }
    return false
};

Skiplist.prototype.add = function(num) {
    const prev = []
    let node = this.head
    while (node) {
        if (node.right.value >= num) {
            prev.push(node)
            node = node.down
        } else {
            node = node.right
        }
    }
    const arr = Array.from({length: randLevel()}, () => new SkipNode(num))
    let t = new SkipNode(NaN)
    for (let i = 0, n = arr.length, j = maxLevel - n; i < n; ++i, ++j) {
        const [a, p] = [arr[i], prev[j]]
        a.right = p.right
        p.right = a
        t.down = a
        t = a
    }
};

Skiplist.prototype.erase = function(num) {
    let node = this.head
    let ans = false
    while (node) {
        if (node.right.value > num) {
            node = node.down
        } else if (node.right.value < num) {
            node = node.right
        } else {
            ans = true
            node.right = node.right.right
            node = node.down
        }
    }
    return ans
};




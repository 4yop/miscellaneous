<?php



class Node {
    public int $key,$val,$freq;
    public function __construct(int $key,int $val,int $freq)
    {

    }
}








class LFUCache {


    /**
     * @param Integer $capacity
     */
    protected $capacity;
    //放数据
    protected $data = [];
    //放 key值 =>次数
    // key => count
    protected $countMap = [];

    /**放 次数=>[key1=>key1,key1=>key2]
     * @var array[]
     */
    protected $table = [];

    function __construct($capacity) {
        $this->capacity = $capacity;
    }

    function eq0()
    {
        return $this->capacity == 0;
    }

    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key)
    {
        if (!$this->has($key))
        {
            return -1;
        }

        unset($this->table[$this->countMap[$key]][$key]);
        $this->countMap[$key]++;
        $this->table[$this->countMap[$key]][$key] = $key;
        $this->test(__FUNCTION__,$key);
        return $this->data[$key];
    }

    function test ($func,$key='',$val='')
    {
        echo "=============\n";
        echo "容量:{$this->capacity}\n";
        echo "function:{$func},key:{$key},val:{$val}\n";
        echo "table:".json_encode($this->table)."\n";
        echo "countMap:".json_encode($this->countMap)."\n";
        echo "data:".json_encode($this->data)."\n";
        echo "\n";
    }

    function has ($key) {
        return isset($this->data[$key]);
    }

    function isFull () {
        return count($this->data) >= $this->capacity;
    }

    function remove ()
    {
        reset($this->table);
        $min = min($this->countMap);
        $key = current($this->table[$min]);
        unset($this->table[$min][$key]);
        unset($this->data[$key]);
        unset($this->countMap[$key]);
        if (empty($this->table[$min])) {
            unset($this->table[$min]);
        }
    }

    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value)
    {
        if ($this->eq0())
        {
            return;
        }
        if (!$this->has($key))
        {
            $this->add($key,$value);
        }else
        {
            $this->update($key,$value);
        }
        $this->test(__FUNCTION__,$key,$value);
    }

    function update ($key,$value)
    {
        $old_count = $this->countMap[$key];
        unset($this->table[$old_count][$key]);
        ++$this->countMap[$key];
        $this->table[$this->countMap[$key]][$key] = $key;
        $this->data[$key] = $value;
    }

    function add($key,$value)
    {
        if ($this->isFull())
        {
            $this->remove();
        }

        $this->countMap[$key] = 1;
        $this->table[1][$key] = $key;
        $this->data[$key] = $value;

    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * $obj = LFUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */
$op =["LFUCache","put","get","put","get","get"];
$par = [[1],[2,1],[2],[3,2],[2],[3]];
$yuqi = [null,null,1,null,-1,2];
/**
 * 2
 * count:[4=>4,3=>3]
 * data:[4=>1,3=>2]
 */

$res = [];
$instance = null;
foreach ($op as $k => $v)
{
    if ($k == 0){
        $res[] = new $v(...$par[$k]);
    }else
    {
        $res[] = $res[0]->$v(...$par[$k]);
    }

}
echo "结果:".json_encode($res)."\n";
echo "预期:".json_encode($yuqi)."\n";

<?php
/**
 *  万能搜索
 */
class allorder{
    public $a = [];
    public $book = [];
    public $n = 0;
    public $res = [];
    function dfs($step){

        if($step == $this->n + 1){
            $temp = '';
            for($i = 1;$i <= $this->n;$i++){
//                fwrite(STDOUT,"输入a[{$i}]:");
//                $this->a[$i] = fgets(STDIN);
                $temp .= $this->a[$i];
            }
            $this->res[] = $temp;

            return;
        }

        for($i = 1;$i <= $this->n;$i++){
            if($this->book[$i] == 0){
                $this->a[$step] = $i;
                $this->book[$i] = 1;
                $this->dfs($step + 1);
                $this->book[$i] = 0;
            }
        }

        return ;
    }

    function main(){
        fwrite(STDOUT,"最大的数（1-9）:");
        $this->n = fgets(STDIN);
        $this->dfs(1);

    }
}


$wnss = new allorder();
$wnss->main();

print_r($wnss->res);
//print_r($wnss->a);
$(function() {
    // 处理屏幕适配
    function autoRootFontSize() {
        document.documentElement.style.fontSize = Math.min(screen.width, document.documentElement.getBoundingClientRect().width) /
            750 * 32 + 'px';
        // 取screen.width和document.documentElement.getBoundingClientRect().width的最小值；除以750，乘以32；懂的起撒，就是原本是750大小的32px;如果屏幕大小变成了375px,那么字体就是16px;也就是根字体fontSize大小和屏幕大小成正比变化！是不是很简单
        // console.log(document.documentElement.style.fontSize)
    }
    window.addEventListener('resize', autoRootFontSize);
    autoRootFontSize();


})

var app = new Vue({
    el : '#main',
    data : {
        //灰太狼随机出现的位置
        arrPos : [{
            left: "2.25rem",
            top: "10.9375rem"
        },
            {
                left: "9.0625rem",
                top: "9.4375rem"
            },
            {
                left: "15.125rem",
                top: "11.625rem"
            },
            {
                left: "2.25rem",
                top: "17.75rem"
            },
            {
                left: "9.1875rem",
                top: "16.3125rem"
            },
            {
                left: "15.125rem",
                top: "18.5rem"
            },
            {
                left: "2.125rem",
                top: "27rem"
            },
            {
                left: "8.875rem",
                top: "25.4375rem"
            },
            {
                left: "15.125rem",
                top: "27.625rem"
            }
        ],
        // 将图片存进数组
        // 灰太狼，
        wolf_1 : ['image/h0.png', 'image/h1.png', 'image/h2.png', 'image/h3.png', 'image/h4.png', 'image/h5.png',
            'image/h6.png',
            'image/h7.png', 'image/h8.png', 'image/h9.png'
        ],
        // 小灰狼
        wolf_2 : ['image/x0.png', 'image/x1.png', 'image/x2.png', 'image/x3.png', 'image/x4.png', 'image/x5.png',
            'image/x6.png',
            'image/x7.png', 'image/x8.png', 'image/x9.png'
        ],
        // 跳出动画
        appearWolf : ['image/h0.png', 'image/x0.png'],

        //图片属性
        newImg : {
            display : 'none',
            width : '6.75rem',
            height : "auto",
            left : '15.125rem',
            top : '11.625rem',
            position : 'absolute',
            src : 'image/h5.png',
        },

        Htc : 0,
        Xtc : 0,
        audioNum : 0
    },
    methods : {
        // 游戏开始函数
        startGame : function () {
            $("#GameBGAudio")[0].play();
            $("#musicBtn").addClass("musicS");
            // 按钮移除开始框
            $(".startBox").hide();

            // 获取游戏执行倒计时
            timer(gemeTime);
            star(); // 第一次游戏的函数
        },

        star : function () {
            let that = this;
            var Htc = 0;
            var Xtc = 0;
            var audioNum = 0
            //=============================================================================游戏进行时
            circle = setInterval(function() {



                // //  一共9个位置，狼的随机一个位置出现
                var wfLocation = rand(0, 8);
                // // 给新建的img标签添加左边距
                that.newImg.width = "6.75rem";
                // 防止js加载时，Img出现占位白边，此处属性设置Auto自适应
                that.newImg.height = "auto";
                that.newImg.left = arrPos[wfLocation].left;
                // 给新建的img标签添加顶部边距
                that.newImg.top = arrPos[wfLocation].top;

                // 给新建的img标签属性，设置为根据自己的位置定位
                that.newImg.position = 'absolute';
                // 选择灰太狼还是小灰灰
                var X = rand(0, 1);
                // console.log(X)
                // 当X<1的时候，选择正确
                if (X == 1) {

                    Htc++;
                    // 等于1时为正确
                    X = 'h';
                } else {

                    Xtc++;
                    // 否则错误
                    X = 'x';
                }
                var y = 0;
                // 图片设置为可见
                that.newImg.display = 'block';
                var appear0 = setInterval(function() {
                    that.newImg.src = 'image/' + X + y + '.png';
                    // 当前程序没执行一次，加一
                    y++;
                    // 设置鼠标单击次数判断条件
                    var indexs = 0;
                    // 当img被点击执行函数
                    newImg.onclick = function() {
                        // 鼠标被点击条件加一
                        indexs++;
                        if (indexs > 1) {
                            // 鼠标只能点击1次 而不能无限点
                            return false;
                        }
                        // y等于第五帧动画图片
                        y = 5;
                        // 执行图片被点击的动画
                        for (var i = 0; i < 4; i++) {
                            y++;
                            // 每执行一次赋值给当前被点击的标签做动效
                            that.newImg.src = wolf_1[y];

                            if (y > 9) {
                                y--;
                            }
                        };
                        // 当点击图片是正确
                        if (X == 'h') {
                            // 添加分数
                            s += 10;
                            // 将当前的数值赋值到HTML分数中显示
                            $(".scoreNum").text(s);
                            // 播放一次音乐
                            audioNum++;
                            var audioS = '<audio class="second" id="secondAudio' + audioNum +
                                '" preload="auto" ><source src="audio/second_music.ogg" type="audio/ogg"><source src="audio/second_music.mp3" type="audio/mpeg"></audio>'
                            $("body").append(audioS);
                            $('#secondAudio' + audioNum)[0].play();
                            $(".second").each(function() {
                                if (this.paused) {
                                    this.remove();
                                }
                            });
                        } else if (X == 'x') {
                            // 反之单错了执行
                            s -= 10;
                            if (s <= 0) {
                                s = 0;
                            }
                            // 将当前错误的数值，赋值到HTML分数中显示
                            $(".scoreNum").text(s);
                            // 执行一次音乐
                            audioNum++;
                            var audioS = '<audio class="second" id="secondAudio' + audioNum +
                                '" preload="auto" ><source src="audio/no_hit.ogg" type="audio/ogg"><source src="audio/no_hit.mp3" type="audio/mpeg"></audio>'
                            $("body").append(audioS);
                            $('#secondAudio' + audioNum)[0].play();
                            $(".second").each(function() {
                                if (this.paused) {
                                    this.remove();
                                }
                            });
                        }
                    };

                    if (y > 5) {
                        clearInterval(appear0);
                        setTimeout(function() {
                            y = 5;
                            var appear1 = setInterval(function() {
                                newImg.src = 'image/' + X + y + '.png';
                                // console.log(y);
                                y--;
                                if (y < 0) {
                                    clearInterval(appear1);
                                    newImg.style.display = 'none';
                                    newImg.remove();
                                }
                            }, 50)
                        }, stay)
                    }
                }, 50);
                //
                // console.log("总弹出：" + (Htc + Xtc) + "次,大灰狼弹出" + Htc + "次,小灰狼弹出" + Xtc + "次")
            }, secs)
            s = 0;
            $(".scoreNum").text(s);
            //=============================================================================游戏结束
        },
    }
});
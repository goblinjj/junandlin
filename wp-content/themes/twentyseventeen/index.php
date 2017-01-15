<?php
exit;
if ($_GET['interface']) {
    $page = $_GET['page'] ? $_GET['page'] : 1;
    $limit = "limit " . (($page - 1)*10) . ",10";
    $conn = mysql_connect($wpdb->dbhost,$wpdb->dbuser,$wpdb->dbpassword);
    mysql_select_db($wpdb->dbname, $conn);
    mysql_query("set names 'utf8'");
    $sql = <<<sql
    SELECT post.post_title, post.post_content, post.post_modified, img.`URI` from wp_posts AS post, post.width, post.height
    LEFT JOIN `wp_yapbimage` AS img on post.id = img.`post_id`
    where post_status = 'publish' and img.`URI` is not null
    order by post.id desc
    {$limit}
sql;
    $query = mysql_query($sql);
    $data = array();
    while($row = mysql_fetch_array($query)) {
        var_dump($row);
        $data[] = array(
            'title' => $row['post_title'],
            'width' => $row['width'],
            'height' => $row['height'],
            'src' => $row['URI'],
        );
    }

    echo json_encode($data);
    exit;
}
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
<style type="text/css">
/* 标签重定义 */
body{padding:0;margin:0;background:#bcdedf;background:#FDD3E1;}
img{border:none;}
a{text-decoration:none;color:#666;}
a:hover{color:#84C2B7;}
#title{width:600px;margin:20px auto;text-align:center;}
/* 定义关键帧 */
@-webkit-keyframes shade{
    from{opacity:1;}
    15%{opacity:0.4;}
    to{opacity:1;}
}
@-moz-keyframes shade{
    from{opacity:1;}
    15%{opacity:0.4;}
    to{opacity:1;}
}
@-ms-keyframes shade{
    from{opacity:1;}
    15%{opacity:0.4;}
    to{opacity:1;}
}
@-o-keyframes shade{
    from{opacity:1;}
    15%{opacity:0.4;}
    to{opacity:1;}
}
@keyframes shade{
    from{opacity:1;}
    15%{opacity:0.4;}
    to{opacity:1;}
}

/* wrap */
#wrap{width:auto;height:auto;margin:0 auto;position:relative;}
#wrap .box{width:280px;height:auto;padding:10px;border:none;float:left;}
#wrap .box .info{width:280px;height:auto;border-radius:8px;box-shadow:0 0 11px #666;background:#FFFAFA;}
#wrap .box .info .pic{width:260px;height:auto;margin:0 auto;padding-top:10px;}
#wrap .box .info .pic:hover{
    -webkit-animation:shade 3s ease-in-out 1;
    -moz-animation:shade 3s ease-in-out 1;
    -ms-animation:shade 3s ease-in-out 1;
    -o-animation:shade 3s ease-in-out 1;
    animation:shade 3s ease-in-out 1;
}
#wrap .box .info .pic img{width:260px;border-radius:3px;}
#wrap .box .info .title{width:260px;height:40px;margin:0 auto;line-height:40px;text-align:center;color:#666;font-size:18px;font-weight:bold;overflow:hidden;}
</style>

<script type="text/javascript" src="js/jquery.js"></script>

<div id="wrap"></div><!-- .wrap -->

<script type="text/javascript">
var flag = false;
var page = 1;
window.onload = function(){
    //运行瀑布流主函数
    PBL('wrap','box');
    //设置滚动加载
    window.onscroll = function(){
        if (flag) return;
        //校验数据请求
        if(getCheck()){
            getImage();
        }
    }
}
getImage();
function lockit () {
    flag = true;
}
function unlock () {
    flag = false;
}
function getImage () {
    lockit();
    $.get(
        '/',
        {interface: '1', page: page},
        function (data) {
            for(var i in data){
                var ratio = 260 / data[i].width;console.log(data[i]);
                var height = data[i].height * ratio
                var box = $('<div class="box"> <div class="info"> <div class="pic"><img width="260px" height="'+height+'px" src="'+data[i].src+'" data-height="'+data[i].height+'" data-width="'+data[i].width+'"></div> <div class="title"><a href="">'+data[i].title+'</a></div> </div> </div>');
                $('#wrap').append(box);
            }
            PBL('wrap','box');
            page++;
            unlock();
        },
        'json'
    );
}
/**
* 瀑布流主函数
* @param  wrap  [Str] 外层元素的ID
* @param  box   [Str] 每一个box的类名
*/
function PBL(wrap,box){
    //  1.获得外层以及每一个box
    var wrap = document.getElementById(wrap);
    var boxs = $('.box');
    //  2.获得屏幕可显示的列数
    var boxW = boxs[0] ? boxs[0].offsetWidth : 260;
    var colsNum = Math.floor(document.documentElement.clientWidth/boxW);
    wrap.style.width = boxW*colsNum+'px';//为外层赋值宽度
    //  3.循环出所有的box并按照瀑布流排列
    var everyH = [];//定义一个数组存储每一列的高度
    for (var i = 0; i < boxs.length; i++) {
        if(i<colsNum){
            everyH[i] = boxs[i].offsetHeight;
        }else{
            var minH = Math.min.apply(null,everyH);//获得最小的列的高度
            var minIndex = getIndex(minH,everyH); //获得最小列的索引
            getStyle(boxs[i],minH,boxs[minIndex].offsetLeft,i);
            everyH[minIndex] += boxs[i].offsetHeight;//更新最小列的高度
        }
    }
}
/**
* 获取类元素
* @param  warp      [Obj] 外层
* @param  className [Str] 类名
*/
function getClass(wrap,className){
    var obj = wrap.getElementsByTagName('*');
    var arr = [];
    for(var i=0;i<obj.length;i++){
        if(obj[i].className == className){
            arr.push(obj[i]);
        }
    }
    return arr;
}
/**
* 获取最小列的索引
* @param  minH   [Num] 最小高度
* @param  everyH [Arr] 所有列高度的数组
*/
function getIndex(minH,everyH){
    for(index in everyH){
        if (everyH[index] == minH ) return index;
    }
}
/**
* 数据请求检验
*/
function getCheck(){
    var documentH = document.documentElement.clientHeight;
    var scrollH = document.documentElement.scrollTop || document.body.scrollTop;
    return documentH+scrollH>=getLastH() ?true:false;
}
/**
* 获得最后一个box所在列的高度
*/
function getLastH(){
    var wrap = document.getElementById('wrap');
    var boxs = getClass(wrap,'box');
    return boxs[boxs.length-1].offsetTop+boxs[boxs.length-1].offsetHeight;
}
/**
* 设置加载样式
* @param  box   [obj] 设置的Box
* @param  top   [Num] box的top值
* @param  left  [Num] box的left值
* @param  index [Num] box的第几个
*/
var getStartNum = 0;//设置请求加载的条数的位置
function getStyle(box,top,left,index){
    if (getStartNum>=index) return;
    $(box).css({
        'position':'absolute',
        'top':top,
        "left":left,
        "opacity":"0"
    });
    $(box).stop().animate({
        "opacity":"1"
    },999);
    getStartNum = index;//更新请求数据的条数位置
}

</script>
<?php get_footer();

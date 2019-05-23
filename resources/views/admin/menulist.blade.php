<html>
<head>
    <meta charset="UTF-8">
    <title>菜单列表</title>
    <link rel="stylesheet" href="{{url('/css/weui.css')}}">
</head>
<body>
@foreach($menu as $value)
    @if($value['pid']==0)
        <div class="weui-cell menu" menuid="{{$value['m_id']}}">
            <div class="weui-cell__bd">
                <p>一级菜单</p>
            </div>
            <div class="weui-cell__bd">{{$value['name']}}</div>
            <div class="weui-cell__bd" style="margin-right: 30%">{{$value['type']}}</div>
            <div class="weui-cell__ft sub_menu">
                <a href="/admin/upmenu/{{$value['m_id']}}" class="weui-btn weui-btn_mini weui-btn_primary">修改</a>

                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_warn" id="forbidden" mid="{{$value['m_id']}}">禁用</a>
            </div>

        </div>
    @endif
@endforeach
<input type="submit" class="weui-btn weui-btn_primary" id="sub" value="发布">
</body>
</html>
<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $(".menu").each(function () {
            var menuid = $(this).attr('menuid');
            var that = $(this);
            $.ajax({
                url: '/admin/getmenu/' + menuid,
                success: function (res) {
                    var str = '';
                    // for(var i in res){
                    //     str += '<div class="weui-cell" style="margin-left: 10%"><div class="weui-cell_bd"><p>二级菜单</p></div><div class="weui-cell_ft">'+res[i]['name']+'</div><div calss="weui_ft">'+res[i]['type']+'</div></div>';
                    // }
                    for (var i in res) {
                        str += '<div class="weui-cell" style="margin-left: 10%">' +
                            '<div class="weui-cell__bd"><p>二级菜单</p></div><div class="weui-cell__ft">' + res[i]['name'] + '</div>' +
                            '<div class="weui-cell__ft" style="margin-right: 30%">' + res[i]['type'] + '</div>' +
                            '<div class="weui-cell__ft"><a href="/admin/upmenu/' + res[i]['m_id'] + '" class="weui-btn weui-btn_mini weui-btn_primary">修改</a>' +
                            '<a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_warn" id="forbidden" mid="' + res[i]['m_id'] + '">禁用</a></div></div>';
                    }
                    // console.log(str);
                    that.after(str);
                }
            })

        })
        $(document).on('click',"#forbidden",function () {
            var re=confirm('确认删除吗，删除后关于这个菜单的所有内容将消失');
            if(re){
                var id=$(this).attr('mid');
                $.ajax({
                    url:'/admin/forbidden/'+id,
                    success:function (res) {
                        // var info=eval("("+res+")");
                        alert(res.msg);
                        history.go(0);
                    }
                })
            }else{
                history.go(0);
            }
        })
        $("#sub").click(function(){
            location.href="{{url('admin/releaseMenu')}}";
        })
    })





</script>

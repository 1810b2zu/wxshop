<link rel="stylesheet" href="{{url('css/weui.css')}}"/>
<form action="{{url('admin/menuAdd')}}" method="post">
    {{csrf_field()}}
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">菜单名称</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="name" placeholder="请输入标签名称"/>
            </div>
        </div>
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">选择类型</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="type" id="type">
                    <option value="0">请选择</option>
                    <option value="click">click</option>
                    <option value="view">view</option>
                </select>
            </div>
        </div>
        <div class="weui-cell Key" style="display: none" id="Key">
            <div class="weui-cell__hd"><label class="weui-label">菜单Key值</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="key" placeholder="请输入Key"/>
            </div>
        </div>
        <div class="weui-cell" id="url" style="display: none">
            <div class="weui-cell__hd"><label class="weui-label">链接地址</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="url" placeholder="请输入链接地址"/>
            </div>
        </div>
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">选择父菜单</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="pid">
                    @if(count($res)<3)
                        <option value="0">一级分类</option>
                    @else

                    @endif
                    @foreach($res as $v)
                        <option value="{{$v['m_id']}}">{{$v['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <br>
    {{--< a href=" "  id="dd"></ a>--}}
    <input type="submit" class="weui-btn weui-btn_primary" id="but" value="添加">
</form>
<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
<script>
    $(function(){
        $("#type").change(function(){
            var type=$(this).val();
            if(type=='click'){
                $("#Key").show();
                $("#url").hide();
            }else if(type=='view'){
                $("#url").show();
                $("#Key").hide();
            }else{
                $("#Key").hide();
                $("#url").hide();
            }
        })
        $(document).on('click',"#but",function(){
            var name=$("input[name='name']").val();
            var key=$("input[name='key']").val();
            var url=$("input[name='url']").val();
            var type=$("select[name='type']").val();
            var pid=$("input[name='pid']").val();
            if(name==''){
                alert('菜单名称不能为空!');
                return false;
            }
            if(type==0||type=='请选择'){
                alert('请选择类型!');
                return false;
            }
            if(type=='click'){
                if(key==''){
                    alert('key值不能为空!');
                    return false;
                }
            }else if(type == 'view'){
                if(url==''){
                    alert('url不能为空!');
                    return false;
                }
            }

            if(pid==''){
                alert('请选择父菜单!');
                return false;
            }
            {{--$.ajax({--}}
            {{--url:"{{url('/admin/addmenu')}}",--}}
            {{--data:{name:name,key:key,type:type,pid:pid,_token:'{{csrf_token()}}'},--}}
            {{--success:function(res){--}}
            {{--console.log(res);--}}
            {{--}--}}
            {{--})--}}
            $('form').submit();
        })
    })
</script>
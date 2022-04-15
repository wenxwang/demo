<form action="/index/submitAdd" method="post">
    姓名： <input type="text" name="name" id="">
    <br />

    性别：
    <label for="male">男</label>
    <input type="radio" name="gender" id="male" value=1 checked>
    <label for="female">女</label>
    <input type="radio" name="gender" id="female" value=0>
    <br />

    <input type="submit" value="提交">
    <input type="button" value="返回" onclick="javascript:history.back(-1);">
</form>
<form action="index/index" method="get">
    <input type="text" value="<?php echo $keyword ?>" name=keyword placeholder="用户ID">
    <input type="submit" value="搜索">
</form>

<p><a href="/index/add">新增</a></p>

<table>
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>性别</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?php echo $item['id'] ?></td>
            <td><?php echo $item['name'] ?></td>
            <td><?php echo $item['gender'] ?></td>
            <td><?php echo $item['create_at'] ?></td>
            <td>
                <a href="/Index/update/<?php echo $item['id'] ?>">修改</a>
                <a href="/Index/delete/<?php echo $item['id'] ?>">删除</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>
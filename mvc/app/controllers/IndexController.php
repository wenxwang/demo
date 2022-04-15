<?php
namespace app\controllers;

use mvc\base\Controller;
use app\models\UserModel;

class IndexController extends Controller
{
    public function index()
    {
        $keyword = $_GET['keyword'] ?? 1;

        $model = (new UserModel)->search($keyword);
        foreach ($model as $k => $v) {
            $model[$k]['gender'] = $v['gender'] == 0 ? '男' : '女';
        }
        $this->assign('title', '用户列表');
        $this->assign('keyword', $keyword);
        $this->assign('items', $model);
        $this->render();
    }

    // 查看单条记录详情
    public function detail($id)
    {
        // 通过?占位符传入$id参数
        $item = (new UserModel())->where('id = ?', $id)->fetch();
        $this->assign('title', '条目详情');
        $this->assign('item', $item);
        $this->render();
    }

    // 添加记录，测试框架DB记录创建（Create）
    public function add()
    {
        // $data['item_name'] = $_POST['value'];
        // $count = (new UserModel)->add($data);
        $this->assign('title', '新增用户');
        // $this->assign('count', $count);
        $this->render();
    }

    // 添加记录，测试框架DB记录创建（Create）
    public function submitAdd()
    {
        $data = $_POST;
        $count = (new UserModel)->add($data);
        echo '添加成功!';
        // $this->assign('title', '新增用户结果');
        // $this->assign('count', $count);
        // $this->render();
    }

    // 删除记录，测试框架DB记录删除（Delete）
    public function delete($id = null)
    {
        echo $id;
        $count = (new UserModel)->delete($id);
        // $this->assign('title', '删除成功');
        // $this->assign('count', $count);
        // $this->render();
    }
}
<?php

namespace app\controller;

class Comment
{
    public function read($id, $blog_id)
    {
        return 'Comment id:' . $id . '，Blog id:' . $blog_id;
    }

    public function edit($id, $blog_id)
    {
        return 'Comment id:' . $id . '，Blog id:' . $blog_id;
    }
}